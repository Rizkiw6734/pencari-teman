<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\notifikasi;
use App\Models\NotifLaporan;
use App\Models\Laporan;
use App\Models\Pinalti;

class ChatController extends Controller
{
    // Menampilkan chat terbaru antara dua user di sidebar
    public function index()
    {
        $userId = Auth::id();

        // Ambil data dari tabel notifikasi
        $notifications = Notifikasi::with('laporan.pelapor2')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // Ambil data dari tabel notif_laporan
        $notifLaporan = NotifLaporan::where('user_id', $userId)
            ->latest()
            ->get();

        // Gabungkan kedua koleksi dengan merge
        $mergedNotifications = $notifications->merge($notifLaporan)->sortByDesc('created_at')->values();

        $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($userId) {
            $query->where('reported_id', $userId)->whereIn('jenis_hukuman', ['peringatan']);
        })->get();

        // return response()->json([
        //     'user_id' => $userId,
        //     'notifications' => $mergedNotifications
        // ]);

        return view('user.home', compact('userId', 'notifications', 'pinaltis'));
    }


// Fungsi untuk mengambil notifikasi
public function notif()
{
    // Ambil notifikasi dari tabel notifikasi
    $notifikasis = notifikasi::where('user_id', auth()->id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($notifikasi) {
            $laporan = Laporan::find($notifikasi->laporan_id);

            if (!$laporan) {
                $notifikasi->foto_profil = null;
                return $notifikasi;
            }

            if ($notifikasi->user_id == auth()->id()) {
                $notifikasi->foto_profil = auth()->user()->foto_profil;
            } else {
                $pelapor = User::find($laporan->user_id);
                $notifikasi->foto_profil = $pelapor ? $pelapor->foto_profil : null;
            }

            return $notifikasi;
        });

    // Ambil notifikasi dari tabel notif_laporan
    $notifikasiPeringatan = NotifLaporan::where('user_id', auth()->id())
        ->where('is_read', false)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($notifikasi) {
            $notifikasi->foto_profil;

            return $notifikasi;
        });

    // Gabungkan kedua koleksi notifikasi
    $semuaNotifikasi = $notifikasis->merge($notifikasiPeringatan);

    // Urutkan berdasarkan created_at setelah digabungkan
    $semuaNotifikasi = $semuaNotifikasi->sortByDesc('created_at')->take(10)->values();

    return response()->json($semuaNotifikasi);
}



public function latestChatsJson(Request $request)
{
    $userId = Auth::id();

    // Ambil daftar pengguna yang diblokir oleh userId
    $blockedUsers = DB::table('blokir')
        ->where('users_id', $userId)
        ->pluck('blocked_user_id')
        ->toArray();

    // Ambil daftar pengguna yang memblokir userId
    $usersWhoBlockedMe = DB::table('blokir')
        ->where('blocked_user_id', $userId)
        ->pluck('users_id')
        ->toArray();

    // Gabungkan daftar blokir (baik yang diblokir maupun yang memblokir)
    $blockedList = array_merge($blockedUsers, $usersWhoBlockedMe);

    $latestChats = DB::table('chat as c')
        ->select(
            'c.id', 'c.pengirim_id', 'c.penerima_id', 'c.konten',
            'c.status', 'c.is_seen', 'c.created_at',
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
            SELECT LEAST(pengirim_id, penerima_id) AS user1,
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

    // Ambil daftar user terkait chat
    $userIds = $latestChats->pluck('pengirim_id')->merge($latestChats->pluck('penerima_id'))->unique();
    $users = User::whereIn('id', $userIds)->get()->keyBy('id');

    foreach ($latestChats as $chat) {
        $chat->pengirim = $users->get($chat->pengirim_id);
        $chat->penerima = $users->get($chat->penerima_id);
        $chat->created_at = \Carbon\Carbon::parse($chat->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i');

        // Cek jika pengguna diblokir, kosongkan isi chat
        if (in_array($chat->pengirim_id, $blockedList) || in_array($chat->penerima_id, $blockedList)) {
            $chat->konten = null;
            $chat->status = null;
            $chat->unread_count = null;
        }

        // Cek profil foto
        $chat->pengirim->foto_profil = !empty($chat->pengirim->foto_profil)
            ? url('storage/' . $chat->pengirim->foto_profil)
            : asset('images/marie.jpg');

        $chat->penerima->foto_profil = !empty($chat->penerima->foto_profil)
            ? url('storage/' . $chat->penerima->foto_profil)
            : asset('images/marie.jpg');

        // Update status jika pesan diterima tapi belum dibaca
        if ($chat->penerima_id == $userId && $chat->status === 'sent_and_unread') {
            $isOnline = $users->get($chat->pengirim_id)->is_online ?? false;
            if ($isOnline) {
                $updated = DB::table('chat')
                    ->where('pengirim_id', $chat->pengirim_id)
                    ->where('penerima_id', $userId)
                    ->where('status', 'sent_and_unread')
                    ->update(['status' => 'received']);

                if ($updated) {
                    $chat->status = 'received';
                } else {
                    Log::info("Update status gagal untuk chat ID: " . $chat->id);
                }
            }
        }

        // Update jika chat sudah dibaca
        if ($chat->penerima_id == $userId && $chat->status === 'received') {
            $isChatOpened = $request->input('is_seen') ?? false;
            if ($isChatOpened) {
                DB::table('chat')->where('id', $chat->id)->update(['status' => 'sent_and_read', 'is_seen' => true]);
                $chat->status = 'sent_and_read';
                $chat->is_seen = true;
            }
        }
    }

    return response()->json(['latestChats' => $latestChats, 'userId' => $userId], 200);
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

    // Ambil daftar pengguna yang diblokir oleh userId
    $userId = Auth::id();
    $blockedUsers = DB::table('blokir')
        ->where('users_id', $userId)
        ->pluck('blocked_user_id')
        ->toArray();

    $usersWhoBlockedMe = DB::table('blokir')
        ->where('blocked_user_id', $userId)
        ->pluck('users_id')
        ->toArray();

    // Gabungkan daftar blokir
    $blockedList = array_merge($blockedUsers, $usersWhoBlockedMe);

    // Pastikan foto profil menggunakan path yang benar
    $fotoProfile = $user->foto_profil
        ? url('storage/' . $user->foto_profil)
        : asset('/images/marie.jpg');

    // Jika pengguna terblokir, sembunyikan status online
    $isOnline = in_array($user->id, $blockedList) ? null : (bool) $user->is_online;

    // Kirimkan data yang dibutuhkan ke tampilan
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'foto_profil' => $fotoProfile,
        'is_online' => $isOnline,
        'created_at' => $user->created_at->format('Y-m-d H:i:s'),
    ]);
}


public function getMessages(Request $request, $userId, $penerimaId)
{
    $user = User::with(['blokiran', 'diblokir'])->find($userId);
    $penerima = User::with(['blokiran', 'diblokir'])->find($penerimaId);

    if (!$user || !$penerima) {
        return response()->json(['status' => 'error', 'message' => 'Pengguna atau penerima tidak ditemukan'], 404);
    }

    // Cek apakah pengguna memblokir atau diblokir
    $userBlocked = $user->blokiran->where('blocked_user_id', $penerimaId)->isNotEmpty();
    $penerimaBlocked = $penerima->blokiran->where('blocked_user_id', $userId)->isNotEmpty();
    $isBlocked = $userBlocked || $penerimaBlocked;

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
                'formatted_date' => $createdAt->translatedFormat('l, d F Y'),
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
        'message' => $isBlocked
            ? 'Chat berhasil diambil, tetapi salah satu pengguna sedang diblokir.'
            : 'Pesan berhasil diambil',
        'is_blocked' => $isBlocked,
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

    $pengirimId = Auth::id();
    $penerimaId = $validated['penerima_id'];

    // Ambil data pengguna dan penerima beserta relasi blokir
    $pengirim = User::with(['blokiran', 'diblokir'])->find($pengirimId);
    $penerima = User::with(['blokiran', 'diblokir'])->find($penerimaId);

    if (!$pengirim || !$penerima) {
        return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.'], 404);
    }

    // Cek apakah pengirim memblokir penerima atau sebaliknya
    $pengirimMemblokir = $pengirim->blokiran->where('blocked_user_id', $penerimaId)->isNotEmpty();
    $penerimaMemblokir = $penerima->blokiran->where('blocked_user_id', $pengirimId)->isNotEmpty();

    if ($pengirimMemblokir || $penerimaMemblokir) {
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim tetapi tidak dapat diterima oleh pengguna karena pemblokiran.',
        ]);
    }

    // Simpan pesan ke database
    $message = new Chat();
    $message->konten = $validated['konten'];
    $message->pengirim_id = $pengirimId;
    $message->penerima_id = $penerimaId;
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
