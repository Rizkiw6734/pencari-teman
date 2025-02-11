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
                'c.id', 'c.pengirim_id', 'c.penerima_id', 'c.konten', 'c.status', 'c.is_seen', 'c.created_at',
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
        }

        if ($request->ajax()) {
            return response()->json(['latestChats' => $latestChats, 'userId' => $userId], 200);
        }

        // return response()->json([
        //     'latestChats' => $latestChats,
        //     'userId' => $userId
        // ], 200);


        return view('user.home', compact('latestChats', 'userId'));
    }





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

    // Mengubah status chat menjadi "dibaca"
    public function updateStatus(Request $request)
{
    $userId = auth()->id(); // ID user yang sedang login
    $penerimaId = $request->input('penerimaId');

    if (!$userId || !$penerimaId) {
        return response()->json(['message' => 'Invalid data received'], 400);
    }

    // Hitung jumlah pesan yang belum dibaca sebelum di-update
    $unreadCount = Chat::where('pengirim_id', $penerimaId)
                      ->where('penerima_id', $userId)
                      ->where('status', 'sent_and_unread')
                      ->where('is_seen', 0)
                      ->count();

    // Update status semua pesan yang belum dibaca
    $updated = Chat::where('pengirim_id', $penerimaId)
                  ->where('penerima_id', $userId)
                  ->where('status', 'sent_and_unread')
                  ->where('is_seen', 0)
                  ->update([
                      'status' => 'sent_and_read',
                      'is_seen' => 1,
                      'updated_at' => now()
                  ]);

    return response()->json([
        'message' => 'Status updated successfully',
        'updated_count' => $updated,
        'unread_count' => $unreadCount
    ], 200);
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
            return $query->where('created_at', '>', $lastTimestamp);
        })
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($chat) {
            return [
                'id' => $chat->id,
                'pengirim_id' => $chat->pengirim_id,
                'penerima_id' => $chat->penerima_id,
                'konten' => $chat->konten,
                'created_at' => $chat->created_at,
                'pengirim_foto' => $chat->pengirim && $chat->pengirim->foto_profil
                    ? url(Storage::url($chat->pengirim->foto_profil))
                    : asset('/images/marie.jpg'),
                'penerima_foto' => $chat->penerima && $chat->penerima->foto_profil
                    ? url(Storage::url($chat->penerima->foto_profil))
                    : asset('/images/marie.jpg'),
            ];
        });

    return response()->json([
        'status' => 'success',
        'message' => 'Pesan berhasil diambil',
        'data' => $messages
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
    \Log::info('Data yang diterima:', $validated);

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






}
