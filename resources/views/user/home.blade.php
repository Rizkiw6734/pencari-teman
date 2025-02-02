@extends('layouts.user')
@section('content')
    <div class="main-content position-fixed max-height-vh-100 h-100" style="position: relative; top:-40px">
        <div class="container-fluid">
            <!-- Konten Utama -->
            <div style="max-width: auto; margin: 0 auto; margin-top: 37px;">
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-4" style="background-color: #F0F3F9; margin-left: -20px;">
                            <div class="mb-3">
                                <div>
                                    <div class="mb-3 mt-3 d-flex justify-content-between align-items-center">
                                        <h5 class="font-weight-bold">Sedang Aktif</h5>
                                    </div>
                                    <!-- Sedang Aktif -->
                                    <style>
                                        div::-webkit-scrollbar {
                                            display: none;
                                        }
                                    </style>
                                    <div style="overflow-x: auto; white-space: nowrap; padding: 2px;">
                                        <div class="active-users"
                                            style="display: inline-block; text-align: center; margin-right: 16px;">

                                        </div>
                                    </div>
                                    <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                    <div class="mb-1 mt-3 d-flex justify-content-between align-items-center">
                                        <h5 class="font-weight-bold">Pesan</h5>
                                    </div>

                                    <!-- Search Bar -->
                                    <div
                                        style="display: flex; align-items: center; border: 1px solid #EFF3F4; border-radius:20px; padding: 5px 10px; width: 100%; background-color: #f9f9f9;">
                                        <span style="color: #757575; font-size: 16px; cursor: default;">
                                            <i class="fa fa-search ms-1" style="font-size: 15px"></i>
                                        </span>
                                        <input type="text" placeholder="Mulai chat baru"
                                            style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 5px;">
                                    </div>

                                    <!-- Chat -->
                                    <div style="height: 300px; overflow-y: scroll; solid #ccc;">
                                        <!-- Chat Dikirim dan sudah dibaca -->
                                        @php
                                            $userId = auth()->user()->id;
                                        @endphp

                                        @foreach ($latestChats as $chat)
                                            @php
                                                // Tentukan ID dan profil partner chat
                                                $chatPartnerId =
                                                    $chat->pengirim_id === $userId
                                                        ? $chat->penerima_id
                                                        : $chat->pengirim_id;
                                                $chatPartner =
                                                    $chat->pengirim_id === $userId ? $chat->penerima : $chat->pengirim;

                                                // Tentukan ikon status pesan
                                                $statusIcon = '';
                                                if ($chat->status === 'sent_and_read') {
                                                    $statusIcon = '<i class="fas fa-check-double text-primary"></i>'; // Centang 2 biru
                                                } elseif ($chat->status === 'sent_and_unread') {
                                                    $statusIcon = '<i class="fas fa-check text-secondary"></i>'; // Centang 1 abu-abu
                                                } elseif ($chat->status === 'received') {
                                                    $statusIcon = '<i class="fas fa-check-double text-secondary"></i>'; // Centang 2 abu-abu
                                                }
                                            @endphp

                                            <div class="chat-item" onclick="selectChat(this, {{ $chatPartnerId }})"
                                                data-user-id="{{ $chatPartnerId }}"
                                                style="display: flex; align-items: center; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; border-radius: 8px; cursor: pointer; transition: background 0.3s;">

                                                {{-- Gambar profil --}}
                                                <img src="{{ asset('assets/img/team-1.jpg') }}" alt="Avatar"
                                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">

                                                <div class="chat-content" style="flex: 1;">
                                                    <div class="chat-header"
                                                        style="display: flex; justify-content: space-between; align-items: center;">
                                                        <span class="name" style="font-weight: bold; font-size: 16px;">
                                                            {{ $chatPartner->name }}
                                                        </span>
                                                        <span class="time" style="font-size: 12px; color: #888;">
                                                            {{-- {{ $chat->created_at->format('H:i') }} --}}
                                                        </span>
                                                    </div>

                                                    {{-- Preview pesan terakhir dan status --}}
                                                    <div class="chat-message"
                                                        style="font-size: 14px; color: #555; margin-top: 5px;">
                                                        {!! Str::limit($chat->konten, 30) !!} {!! $statusIcon !!}
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Garis pemisah antar chat --}}
                                            <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="mb-3" style="position: relative; margin-left: -12px; margin-right: -45px;">
                                <div class="col-md-12">
                                    <div>
                                        <div class="chat-container d-flex flex-column"
                                            style="height: 100vh; overflow: hidden;">
                                            <!-- Chat Header -->
                                            <div class="chat-header p-1 d-flex align-items-center"
                                                style="background-color: #F0F3F9; border-bottom: 0px solid #ddd;">
                                                <!-- Avatar dan Info -->
                                                <div class="chat-item d-flex align-items-center" style="flex: 1;">
                                                    <img src="{{ asset('assets/img/team-1.jpg') }}" alt="Avatar"
                                                        style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                                    <div class="chat-content"
                                                        style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                                        <div class="chat-header"
                                                            style="display: flex; flex-direction: column; align-items: flex-start;">
                                                            <span class="name" id="chat-name"
                                                                style="font-weight: bold; font-size: 15px;">Loading...</span>
                                                            <div class="notification-content d-flex align-items-center"
                                                                id="chat-status"
                                                                style="font-size: 14px; color: #555; margin-top: 5px;">
                                                                <span class="icon"
                                                                    style="margin-right: 5px; color: #888;"></span>Loading...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Chat Body -->
                                            <div class="chat-body flex-grow-1 p-3"
                                                style="overflow-y: auto; background-color: #FFFFFF;">
                                                <!-- Pesan akan dimuat di sini -->
                                            </div>
                                            <!-- Chat Footer -->
                                            <div class="chat-footer p-2 d-flex align-items-center"
                                                style="background-color: #F0F3F9; border-top: 1px solid #ddd;">

                                                <!-- Avatar -->
                                                <img src="/assets/img/team-2.jpg" alt="Avatar" class="rounded-circle me-3"
                                                    style="width: 40px; height: 40px; object-fit: cover;">

                                                <!-- Chat Input -->
                                                <div class="d-flex align-items-center flex-grow-1"
                                                    style="border: 1px solid #EFF3F4; border-radius: 10px; padding: 5px 10px; background-color: #f9f9f9;">

                                                    <!-- Emoji & Attachment -->
                                                    <span style="color: #757575; font-size: 16px; cursor: pointer;">
                                                        <i class="fa fa-smile ms-1" style="font-size: 15px;"></i>
                                                        <i class="fa fa-paperclip ms-2" style="font-size: 15px;"></i>
                                                    </span>

                                                    <!-- Input Chat -->
                                                    <input type="text" id="chat-input" placeholder="Mulai chat baru"
                                                        style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 2px 15px;">

                                                    <!-- Tombol Kirim -->
                                                    <span id="send-message"
                                                        style="color: #757575; font-size: 16px; cursor: pointer;">
                                                        <i class="fa fa-paper-plane ms-1" style="font-size: 15px;"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <input type="hidden" id="penerima-id" value="">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @auth
        // Menyertakan token API dari session jika user login
        const userToken = "{{ auth()->user()->createToken('PencariTeman')->plainTextToken }}";
        console.log('User sedang login:', userToken);
        @else
            const userToken = null; // Jika user belum login, tidak ada token
            console.log('User belum login');
        @endauth
        if (!userToken) {
            console.log('Token tidak ditemukan');
            alert('Anda perlu login terlebih dahulu untuk memperbarui lokasi.');
        } else if (!navigator.geolocation) {
            console.error('Geolocation tidak didukung oleh browser Anda.');
            alert('Peramban Anda tidak mendukung fitur geolokasi.');
        } else {
            // Mengambil lokasi pengguna secara otomatis menggunakan geolocation
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    console.log('Lokasi diperoleh:', latitude, longitude);

                    // Ambil CSRF token dari meta tag
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Kirim data latitude dan longitude ke API untuk diperbarui di backend
                    fetch('/update-location', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${userToken}`, // pastikan token yang valid ada di sini
                                'X-CSRF-TOKEN': csrfToken // Tambahkan CSRF token di sini
                            },
                            body: JSON.stringify({
                                latitude,
                                longitude
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Lokasi berhasil diperbarui:', data);

                        })
                        .catch(error => {
                            console.error('Error saat mengupdate lokasi:', error);
                            alert('Terjadi kesalahan saat memperbarui lokasi: ' + error.message);
                        });
                },
                function(error) {
                    console.error('Gagal mendapatkan lokasi:', error);

                    let errorMessage = '';
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = 'Akses lokasi ditolak oleh pengguna.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = 'Informasi lokasi tidak tersedia.';
                            break;
                        case error.TIMEOUT:
                            errorMessage = 'Permintaan lokasi timeout.';
                            break;
                        case error.UNKNOWN_ERROR:
                            errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
                            break;
                    }

                    alert(errorMessage);

                    // Gunakan lokasi default jika gagal mendapatkan lokasi
                    const defaultLatitude = -6.2088; // Jakarta
                    const defaultLongitude = 106.8456;

                    // Ambil CSRF token dari meta tag
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('/update-location', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${userToken}`,
                                'X-CSRF-TOKEN': csrfToken // Tambahkan CSRF token di sini
                            },
                            body: JSON.stringify({
                                latitude: defaultLatitude,
                                longitude: defaultLongitude
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Menggunakan lokasi default:', data);
                            alert('Menggunakan lokasi default karena tidak dapat memperoleh lokasi.');
                        })
                        .catch(error => {
                            console.error('Gagal mengirim lokasi default:', error);
                            alert('Terjadi kesalahan saat mengirim lokasi default: ' + error.message);
                        });
                }
            );
        }

        document.addEventListener("DOMContentLoaded", function() {
            function loadActiveUsers() {
                fetch('/active-users')
                    .then(response => response.json())
                    .then(data => {
                        let userContainer = document.querySelector('.active-users');
                        if (!userContainer) return;

                        userContainer.innerHTML = '';

                        data.forEach(user => {
                            userContainer.innerHTML += `
                        <div style="display: inline-block; text-align: center; margin-right: 16px;">
                             <img src="${user.foto_profil ? '/storage/' + user.foto_profil : '/images/marie.jpg'}" alt="Foto Profil"
                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                            <p>${user.name}</p>
                        </div>
                    `;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Panggil setiap 5 detik untuk update real-time
            setInterval(loadActiveUsers, 5000);
            loadActiveUsers();
        });

        // Fetch chat messages from API
        fetch('/chats')
            .then(response => response.json())
            .then(data => {
                // Clear the previous chat list
                document.getElementById('chat-container').innerHTML = '';

                // Render chat ke tampilan
                data.forEach(chat => {
                    let statusIcon = '';
                    if (chat.status === 'sent_and_read') {
                        statusIcon = '✔✔'; // Ditandai sebagai dibaca
                    } else if (chat.status === 'sent_and_unread') {
                        statusIcon = '✔'; // Ditandai sebagai belum dibaca
                    } else {
                        statusIcon = ''; // Status diterima
                    }

                    // Mengubah format waktu agar lebih mudah dibaca
                    const time = new Date(chat.created_at);
                    const formattedTime = time.getHours().toString().padStart(2, '0') + ':' + time.getMinutes()
                        .toString().padStart(2, '0');

                    // Menampilkan chat ke dalam tampilan HTML
                    const chatMessage = `
                <div class="chat-item" style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px;">
                    <img src="/assets/img/team-1.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                    <div class="chat-content" style="flex: 1;">
                        <div class="chat-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="name" style="font-weight: bold; font-size: 16px;">${chat.pengirim.name}</span>
                            <span class="time" style="font-size: 12px; color: #888;">${formattedTime}</span>
                        </div>
                        <div class="chat-message" style="font-size: 14px; color: #555; margin-top: 5px;">
                            <span style="color: #888;">${statusIcon}</span>
                            ${chat.konten}
                        </div>
                    </div>
                </div>`;

                    // Append the new chat message to the container
                    document.getElementById('chat-container').innerHTML += chatMessage;
                });
            })
            .catch(error => {
                console.error('Error fetching chat data:', error);
            });

        // Fungsi untuk memilih chat dan memperbarui status header
        function selectChat(element, penerimaId) {
    // Update warna latar belakang sidebar yang dipilih
    document.querySelectorAll('.chat-item').forEach(item => {
        item.style.backgroundColor = '#F0F3F9'; // Reset background color semua item
    });
    element.style.backgroundColor = '#D6EAF8'; // Ganti warna sidebar yang dipilih

    // Ambil ID pengguna yang sedang login
    var userId = {{ Auth::id() }}; // Pastikan ID pengguna yang sedang login dimasukkan dengan benar di blade template

    // Update input hidden penerima-id dengan ID penerima yang dipilih
    $("#penerima-id").val(penerimaId);

    // Debugging: Pastikan penerimaId sudah terupdate
    console.log("ID Penerima yang dipilih:", penerimaId);

    // Lakukan AJAX untuk mengambil data pengguna dan update status di header chat
    updateUserStatus(penerimaId);

    // Memuat pesan untuk percakapan dengan penerima yang dipilih
    loadMessages(userId, penerimaId);
}


        // Fungsi untuk mengupdate status pengguna di header chat
        function updateUserStatus(userId) {
            $.ajax({
                url: "/user/status/" + userId,
                type: "GET",
                success: function(response) {
                    // Update informasi di header chat
                    $("#chat-name").text(response.name);
                    $("#chat-avatar").attr("src", response.avatar);

                    if (response.is_online) {
                        $("#chat-status").html('<span class="icon" style="color: #28a745;"></span> Online');
                    } else {
                        $("#chat-status").html('<span class="icon" style="color: #888;"></span> Offline');
                    }
                },
                error: function() {
                    console.log("Gagal mengambil data user.");
                }
            });
        }

        // Fungsi untuk memuat pesan berdasarkan ID pengguna dan penerima
        function loadMessages(userId, penerimaId) {
            $.ajax({
                url: '/messages/' + userId + '/' + penerimaId, // Pastikan URL ini sesuai dengan route Anda
                type: 'GET',
                success: function(response) {
                    console.log("Response:", response); // Cek respons server
                    if (response.status === 'success') {
                        let chats = response.data; // Mengubah 'messages' menjadi 'chats'
                        let chatBody = $('.chat-body'); // Menargetkan elemen dengan class 'chat-body'

                        // Kosongkan chat body sebelumnya
                        chatBody.empty();

                        // Iterasi chat dan tampilkan ke chat body
                        chats.forEach(function(chat) {
                            let isSender = chat.pengirim_id ===
                            userId; // Bandingkan dengan ID pengguna yang sedang login
                            let chatElement = `
                        <div class="chat-item ${isSender ? 'd-flex align-items-end justify-content-end' : 'd-flex align-items-start'} mb-3">
                            ${isSender ? `
                                    <div class="chat-content text p-2 rounded" style="max-width: 60%; background-color: #9FB7FF; border-radius: 15px 15px 15px 15px;">
                                        <span style="font-size: 13px; color: #000000;">${chat.konten}</span>
                                        <div class="text-end text-black-50" style="font-size: 10px;">${formatDate(chat.created_at)}</div>
                                    </div>
                                    <img src="/assets/img/team-2.jpg" alt="Avatar" class="rounded-circle ms-3" style="width: 50px; height: 50px; object-fit: cover;">
                                ` : `
                                    <img src="/assets/img/team-1.jpg" alt="Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div class="chat-content text p-2 rounded" style="max-width: 50%; background-color: #F0F3F9; border-radius: 15px 15px 15px 0;">
                                        <span style="font-size: 13px; color: #000000;">${chat.konten}</span>
                                        <div class="text-end text-black-50" style="font-size: 10px;">${formatDate(chat.created_at)}</div>
                                    </div>
                                `}
                        </div>
                    `;
                            chatBody.append(chatElement); // Menambahkan chat ke chat body
                        });
                    }
                },
                error: function(error) {
                    console.log("Error:", error); // Debugging: Cek jika ada error dalam AJAX request
                }
            });
        }

        // Fungsi untuk memformat tanggal
        function formatDate(dateString) {
            const options = {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            };
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', options);
        }

        $(document).ready(function() {
    // Event listener saat user dipilih dari daftar pengguna
    $('.user-list-item').click(function() {
        let selectedId = $(this).data('id'); // Ambil ID dari data-id user yang diklik
        $("#penerima-id").val(selectedId); // Simpan ID ke input hidden
        console.log("ID Penerima Terpilih:", selectedId);
    });

    // Event listener untuk tombol kirim pesan
    $('#send-message').click(function() {
        sendMessage();
    });

    function sendMessage() {
        let message = $('#chat-input').val().trim();
        if (message === '') return; // Jangan kirim jika pesan kosong

        var penerimaId = $("#penerima-id").val(); // Ambil penerima ID yang benar
        console.log("Penerima ID yang dikirim:", penerimaId);

        if (!penerimaId) {
            console.error("Penerima ID tidak ditemukan.");
            return;
        }

        $.ajax({
            url: '/send-message',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                konten: message,
                penerima_id: penerimaId, // Kirim ID penerima yang sudah diperbarui
            },
            success: function(response) {
                console.log("Pesan terkirim:", response);
                $('#chat-input').val(''); // Reset input setelah pesan terkirim
                loadMessages({{ Auth::id() }}, penerimaId); // Muat pesan setelah pengiriman
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan:", error);
                console.error(xhr.responseText);
            }
        });
    }
});



    </script>
@endsection
