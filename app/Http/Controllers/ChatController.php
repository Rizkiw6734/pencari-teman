<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChatController extends Controller
{
    // Menampilkan chat terbaru antara dua user di sidebar
    public function index()
    {
        $userId = Auth::id();

        $latestChats = DB::table('chat as c')
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

        foreach ($latestChats as $chat) {
            $chat->pengirim = User::find($chat->pengirim_id);
            $chat->penerima = User::find($chat->penerima_id);
        }

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
    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:sent_and_read,sent_and_unread,received'
        ]);

        $chat = Chat::findOrFail($id);
        $chat->update(['status' => $request->status]);

        return response()->json(['message' => 'Status chat berhasil diperbarui']);
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

    // Kirimkan data yang dibutuhkan ke tampilan
    return response()->json([
        'name' => $user->name,
        'avatar' => $user->avatar ?? '/assets/img/default-avatar.jpg',
        'is_online' => $user->is_online
    ]);

    }

    public function getMessages(Request $request, $userId, $penerimaId)
    {
        if (!User::where('id', $penerimaId)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Penerima tidak ditemukan'], 404);
        }

        $lastTimestamp = $request->input('last_timestamp');

        $messages = Chat::where(function ($query) use ($userId, $penerimaId) {
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
            ->get();

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
