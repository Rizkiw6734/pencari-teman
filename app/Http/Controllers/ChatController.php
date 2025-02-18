<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    // Menampilkan chat terbaru antara dua user di sidebar
    public function index(Request $request)
{
    $userId = Auth::id();


    // Ambil chat terbaru dengan unread_count
    $latestChats = DB::table('chat as c')
        ->select(
            'c.id',
            'c.pengirim_id',
            'c.penerima_id',
            'c.konten',
            'c.status',
            'c.is_seen',
            'c.created_at',
            DB::raw("(
                SELECT COUNT(*)
                FROM chat
                WHERE penerima_id = $userId
                  AND is_seen = 0
                  AND LEAST(pengirim_id, penerima_id) = LEAST(c.pengirim_id, c.penerima_id)
                  AND GREATEST(pengirim_id, penerima_id) = GREATEST(c.pengirim_id, c.penerima_id)
            ) as unread_count")
        )
        ->join(DB::raw("(
            SELECT
                LEAST(pengirim_id, penerima_id) AS user1,
                GREATEST(pengirim_id, penerima_id) AS user2,
                MAX(id) AS latest_chat_id
            FROM chat
            GROUP BY user1, user2
        ) as latest_chats"), function ($join) {
            $join->on(DB::raw('LEAST(c.pengirim_id, c.penerima_id)'), '=', 'latest_chats.user1')
                 ->on(DB::raw('GREATEST(c.pengirim_id, c.penerima_id)'), '=', 'latest_chats.user2')
                 ->on('c.id', '=', 'latest_chats.latest_chat_id');
        })
        ->where(function ($query) use ($userId) {
            $query->where('c.pengirim_id', $userId)
                  ->orWhere('c.penerima_id', $userId);
        })
        ->orderBy('c.created_at', 'DESC')
        ->get();

    $userIds = $latestChats->pluck('pengirim_id')->merge($latestChats->pluck('penerima_id'))->unique();
    $users = User::whereIn('id', $userIds)->get()->keyBy('id');

    foreach ($latestChats as $chat) {
        $chat->pengirim = $users->get($chat->pengirim_id);
        $chat->penerima = $users->get($chat->penerima_id);
        $chat->created_at = \Carbon\Carbon::parse($chat->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i');

        $chat->pengirim->foto_profil = !empty($chat->pengirim->foto_profil)
            ? url('storage/' . $chat->pengirim->foto_profil)
            : asset('images/marie.jpg');

        $chat->penerima->foto_profil = !empty($chat->penerima->foto_profil)
            ? url('storage/' . $chat->penerima->foto_profil)
            : asset('images/marie.jpg');

        // Update status menjadi "received" jika penerima sedang online, tapi belum membuka chat
        if ($chat->penerima_id == $userId && $chat->status === 'sent_and_unread') {
            $isOnline = $users->get($chat->penerima_id)->is_online ?? false;
            if ($isOnline) {
                // Perbarui semua pesan yang belum dibaca dari pengirim ini
                DB::table('chat')
                    ->where('pengirim_id', $chat->pengirim_id) // Pesan dari pengirim ini
                    ->where('penerima_id', $userId) // Pesan untuk user yang sedang login
                    ->where('status', 'sent_and_unread') // Hanya pesan dengan status ini
                    ->update(['status' => 'received']); // Perbarui status

                // Perbarui status chat terbaru yang ditampilkan
                $chat->status = 'received';
            }
        }

        // Update status menjadi "sent_and_read" jika chat benar-benar dibuka
        if ($chat->penerima_id == $userId && $chat->status === 'received') {
            $isChatOpened = $request->input('is_seen') ?? false; // Pastikan ini dikirim dari frontend
            if ($isChatOpened) {
                DB::table('chat')->where('id', $chat->id)->update(['status' => 'sent_and_read', 'is_seen' => true]);
                $chat->status = 'sent_and_read';
                $chat->is_seen = true;
            }
        }
    }

    if ($request->ajax()) {
        return response()->json(['latestChats' => $latestChats, 'userId' => $userId], 200);
    }

    return view('user.home', compact('latestChats', 'userId',));
}


// return response()->json([
        //     'latestChats' => $latestChats,
        //     'userId' => $userId
        // ], 200);



    // Menyimpan pesan baru
    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'konten' => 'required|string'
        ]);

        $chat = Chat::create([
            'pengirim_id' => Auth::id(),
            'penerima_id' => $request->penerima_id,
            'konten' => $request->konten,
            'status' => 'sent'
        ]);

        return response()->json([
            'message' => 'Pesan berhasil dikirim',
            'chat' => $chat
        ]);
    }


    public function updateStatus(Request $request)
{
    $userId = auth()->id(); // ID user yang sedang login
    $penerimaId = $request->input('penerimaId');

    if (!$userId || !$penerimaId) {
        return response()->json(['message' => 'Invalid data received'], 400);
    }

    // Cek apakah is_seen dikirim dalam request dan konversi ke boolean
    $isChatOpened = $request->has('is_seen') ? $request->boolean('is_seen') : false;

    if ($isChatOpened) {
        // Hitung jumlah pesan yang belum dibaca sebelum di-update
        $unreadCount = Chat::where('pengirim_id', $penerimaId)
                          ->where('penerima_id', $userId)
                          ->where('status', 'received')
                          ->where('is_seen', false)
                          ->count();

        // Update status semua pesan yang belum dibaca
        $updatedCount = Chat::where('pengirim_id', $penerimaId)
        ->where('penerima_id', $userId)
        ->where('status', 'received')
        ->update([
            'status' => 'sent_and_read',
            'is_seen' => true,
            'updated_at' => now()
        ]);

    Log::info("Jumlah pesan yang diperbarui: $updatedCount");

        return response()->json([
            'message' => 'Status updated successfully',
            'updated_count' => $updatedCount,
            'unread_count' => $unreadCount
        ], 200);
    }

    return response()->json(['message' => 'is_seen is not true'], 400);
}




public function getUserStatus($id)
{
    // Temukan pengguna berdasarkan ID
    $user = User::find($id);

    // Jika pengguna tidak ditemukan
    if (!$user) {
        return response()->json(['status' => 'User tidak ditemukan'], 404);
    }

    // Pastikan hanya pengguna selain admin yang bisa mengakses status ini
    if (Auth::user()->hasRole('Admin')) {
        return response()->json(['status' => 'Tidak dapat menampilkan status untuk Admin'], 403);
    }

    // Pastikan foto profile menggunakan path yang benar
    $fotoProfile = $user->foto_profil
        ? url('storage/' . $user->foto_profil)
        : asset('/images/marie.jpg');

    // Kirimkan data yang dibutuhkan ke tampilan
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'foto_profil' => $fotoProfile,
        'is_online' => (bool) $user->is_online,
        'created_at' => $user->created_at->format('Y-m-d H:i:s'),
    ]);
}


public function getMessages(Request $request, $userId, $penerimaId)
{
    if (!User::where('id', $penerimaId)->exists()) {
        return response()->json(['status' => 'error', 'message' => 'Penerima tidak ditemukan'], 404);
    }

    $lastTimestamp = $request->input('last_timestamp');

    $messages = Chat::with(['pengirim', 'penerima'])
        ->where(function ($query) use ($userId, $penerimaId) {
            $query->where('pengirim_id', $userId)
                  ->where('penerima_id', $penerimaId);
        })
        ->orWhere(function ($query) use ($userId, $penerimaId) {
            $query->where('pengirim_id', $penerimaId)
                  ->where('penerima_id', $userId);
        })
        ->when($lastTimestamp, function ($query) use ($lastTimestamp) {
            return $query->where('created_at', '>=', $lastTimestamp);
        })
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($chat) {
            $createdAt = $chat->created_at->copy()->timezone('Asia/Jakarta');

            return [
                'id' => $chat->id,
                'pengirim_id' => $chat->pengirim_id,
                'penerima_id' => $chat->penerima_id,
                'konten' => $chat->konten,
                'created_at' => $createdAt->format('Y-m-d H:i:s'),
                'formatted_date' => $createdAt->translatedFormat('l, d F Y'), // Format tanggal agar tetap muncul
                'pengirim_foto' => $chat->pengirim && $chat->pengirim->foto_profil
                    ? url(Storage::url($chat->pengirim->foto_profil))
                    : asset('/images/marie.jpg'),
                'penerima_foto' => $chat->penerima && $chat->penerima->foto_profil
                    ? url(Storage::url($chat->penerima->foto_profil))
                    : asset('/images/marie.jpg'),
                'status' => $chat->status,
            ];
        });

    return response()->json([
        'status' => 'success',
        'message' => 'Pesan berhasil diambil',
        'data' => $messages,
    ]);
}



    public function sendMessage(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'konten' => 'required|string',
        'penerima_id' => 'required|integer|exists:users,id',
    ]);

    // Debug: Cek data yang diterima
    Log::info('Data yang diterima:', $validated);

    // Simpan pesan
    $message = new Chat();
    $message->konten = $validated['konten'];
    $message->pengirim_id = Auth::id();  // Pengirim ID
    $message->penerima_id = $validated['penerima_id'];
    $message->save();

    return response()->json([
        'success' => true,
        'message' => 'Pesan berhasil dikirim!',
    ]);
}

// PR
public function getStatus($userId, $penerimaId)
{
    try {
        Log::info("Fetching chat status for user {$userId} and recipient {$penerimaId}");

        $chats = Chat::with(['penerima:id,is_online'])
            ->where(function ($query) use ($userId, $penerimaId) {
                $query->where('pengirim_id', $userId)
                      ->where('penerima_id', $penerimaId);
            })
            ->orWhere(function ($query) use ($userId, $penerimaId) {
                $query->where('pengirim_id', $penerimaId)
                      ->where('penerima_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get(['id', 'pengirim_id', 'penerima_id', 'status']);

        if ($chats->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No chats found',
                'data' => []
            ]);
        }

        // Log semua pesan sebelum update
        Log::info("Chats before update:", $chats->toArray());

        // Update semua pesan 'received' menjadi 'sent_and_read'
        $updatedCount = Chat::where('pengirim_id', $penerimaId)
            ->where('penerima_id', $userId)
            ->where('status', 'received')
            ->update([
                'status' => 'sent_and_read',
                'is_seen' => true,
                'updated_at' => now()
            ]);

        Log::info("Updated 'received' -> 'sent_and_read' count: {$updatedCount}");

        // Cek apakah ada penerima yang sedang online di seluruh daftar chat
        $isOnline = $chats->where('penerima_id', $userId)->pluck('penerima.is_online')->filter()->isNotEmpty();
        Log::info("Is recipient online? " . ($isOnline ? 'Yes' : 'No'));

        $updatedReceived = 0;

        if ($isOnline) {
            // **Pastikan semua pesan 'sent_and_unread' berubah menjadi 'received'**
            $updatedReceived = Chat::where('pengirim_id', $penerimaId)
                ->where('penerima_id', $userId)
                ->where('status', 'sent_and_unread')
                ->update([
                    'status' => 'received',
                    'updated_at' => now()
                ]);

            Log::info("Updated 'sent_and_unread' -> 'received' count: {$updatedReceived}");
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully',
            'updatedCount' => $updatedCount,
            'isOnline' => $isOnline,
            'updatedReceived' => $updatedReceived,
            'data' => $chats
        ]);
    } catch (\Exception $e) {
        Log::error("Error in getStatus: " . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong. Please try again.',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
