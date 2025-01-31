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
                                        <div style="display: inline-block; text-align: center; margin-right: 16px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
                                        </div>
                                        <div style="display: inline-block; text-align: center; margin-right: 15px;">
                                            <img src="/assets/img/team-2.jpg" alt="Foto"
                                                style="width: 55px; height: 55px; object-fit: cover; border-radius: 80%; solid #ddd;">
                                            <p>ira</p>
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
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px;">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time" style="font-size: 12px; color: #888;">18:52</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px;">
                                                    <span class="icon" style="margin-right: 5px; color: #888;">✔✔</span>
                                                    Yaudah, aku lanjut dulu ya.
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time" style="font-size: 12px; color: #888;">14:24</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px;">
                                                    <span class="icon"
                                                        style="margin-right: 5px; color: #528BFF;">✔✔</span> Yaudah, aku
                                                    lanjut dulu ya.
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time"
                                                        style="font-size: 12px; color: #888;">07:30</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px; display: flex; align_items:center; justify-content: space-between;">
                                                    <span class="icon" style="margin-right: -12px; color: #888;"></span>
                                                    Yaudah, aku lanjut dulu ya.
                                                    <span class="notification-badge"
                                                        style="margin-left: auto; background-color: #528BFF; color: white; font-size: 12px; border-radius: 50%; width: 25px; height: 25px; display: flex; justify-content: center; align-items: center; font-weight: bold;">
                                                        8
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time"
                                                        style="font-size: 12px; color: #888;">06:55</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px;">
                                                    <span class="icon" style="margin-right: 5px; color: #888;">✔✔</span>
                                                    Yaudah, aku lanjut dulu ya.
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time"
                                                        style="font-size: 12px; color: #888;">Kemarin</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px;">
                                                    <span class="icon"
                                                        style="margin-right: 5px; color: #528BFF;">✔✔</span> Yaudah, aku
                                                    lanjut dulu ya.
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time"
                                                        style="font-size: 12px; color: #888;">Kemarin</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px;">
                                                    <span class="icon" style="margin-right: 5px; color: #888;">✔✔</span>
                                                    Yaudah, aku lanjut dulu ya.
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time"
                                                        style="font-size: 12px; color: #888;">20/01/25</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px;">
                                                    <span class="icon" style="margin-right: -3px; color: #888;">✔</span>
                                                    Yaudah, aku lanjut dulu ya.
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                        <div class="chat-item"
                                            style="display: flex; align-items: flex-start; background-color: #F0F3F9; padding: 10px; margin-bottom: 10px; margin-top: 5px; margin-">
                                            <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                            <div class="chat-content" style="flex: 1;">
                                                <div class="chat-header"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span class="name"
                                                        style="font-weight: bold; font-size: 16px;">Eira</span>
                                                    <span class="time"
                                                        style="font-size: 12px; color: #888;">02/01/25</span>
                                                </div>
                                                <div class="chat-message"
                                                    style="font-size: 14px; color: #555; margin-top: 5px; display: flex; align_items:center; justify-content: space-between;">
                                                    <span class="icon" style="margin-right: -12px;"></span> Yaudah, aku
                                                    lanjut dulu ya.
                                                    <span class="notification-badge"
                                                        style="margin-left: auto; background-color: #528BFF; color: white; font-size: 12px; border-radius: 50%; width: 25px; height: 25px; display: flex; justify-content: center; align-items: center; font-weight: bold;">
                                                        1
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                                    <div class="chat-content" style="flex: 1;">
                                                        <div
                                                            class="chat-header d-flex justify-content-between align-items-center">
                                                            <span class="name"
                                                                style="font-weight: bold; font-size: 15px;">Eira</span>
                                                        </div>
                                                        <div class="notification-content"
                                                            style="font-size: 14px; color: #555; margin-top: 5px;">
                                                            <span class="icon"
                                                                style="margin-right: -18px; margin-top: -9px; color: #888;"></span>Online
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Chat Body -->
                                            <div class="chat-body flex-grow-1 p-3"
                                                style="overflow-y: auto; background-color: #FFFFFF;">
                                                <!-- Chat Kiri -->
                                                <div class="chat-item d-flex align-items-start mb-3">
                                                    <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                        class="rounded-circle me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 50%; background-color: #F0F3F9; border-radius: 15px 15px 15px 0;">
                                                        <span style="font-size: 13px; color: #000000;">Hei, jadi besok
                                                            ketemu, kan?</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Chat Kanan -->
                                                <div class="chat-item d-flex align-items-end justify-content-end mb-3">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 60%; background-color: #9FB7FF; border-radius: 15px 15px 15px 15px;">
                                                        <span style="font-size: 13px; color: #000000;">Sip, siap bawa! Jam
                                                            10 pagi di tempat biasa, kan? 😊</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                    <img src="/assets/img/team-2.jpg" alt="Avatar"
                                                        class="rounded-circle ms-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>

                                                <div class="chat-item d-flex align-items-end justify-content-end mb-3">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 60%; background-color: #9FB7FF; border-radius: 15px 15px 0 15px;">
                                                        <span style="font-size: 13px; color: #000000;">Sip, siap bawa! Jam
                                                            10 pagi di tempat biasa, kan? 😊</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                    <img src="/assets/img/team-2.jpg" alt="Avatar"
                                                        class="rounded-circle ms-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                                <div class="chat-item d-flex align-items-end justify-content-end mb-3">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 60%; background-color: #9FB7FF; border-radius: 15px 15px 0 15px;">
                                                        <span style="font-size: 13px; color: #000000;">Sip, siap bawa! Jam
                                                            10 pagi di tempat biasa, kan? 😊</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                    <img src="/assets/img/team-2.jpg" alt="Avatar"
                                                        class="rounded-circle ms-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>

                                                <div class="chat-item d-flex align-items-start mb-3">
                                                    <img src="/assets/img/team-1.jpg" alt="Avatar"
                                                        class="rounded-circle me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 50%; background-color: #F0F3F9; border-radius: 15px 15px 15px 0;">
                                                        <span style="font-size: 13px; color: #000000;">Okee, sampai ketemu besokk yaa</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="chat-item d-flex align-items-end justify-content-end mb-3">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 60%; background-color: #9FB7FF; border-radius: 15px 15px 0 15px;">
                                                        <span style="font-size: 13px; color: #000000;">Sip, siap bawa! Jam
                                                            10 pagi di tempat biasa, kan? 😊</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                    <img src="/assets/img/team-2.jpg" alt="Avatar"
                                                        class="rounded-circle ms-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>

                                                <div class="chat-item d-flex align-items-end justify-content-end mb-3">
                                                    <div class="chat-content text p-2 rounded"
                                                        style="max-width: 60%; background-color: #9FB7FF; border-radius: 15px 15px 0 15px;">
                                                        <span style="font-size: 13px; color: #000000;">Sip, siap bawa! Jam
                                                            10 pagi di tempat biasa, kan? 😊</span>
                                                        <div class="text-end text-black-50" style="font-size: 10px;">09:31
                                                        </div>
                                                    </div>
                                                    <img src="/assets/img/team-2.jpg" alt="Avatar"
                                                        class="rounded-circle ms-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                            </div>

                                            <!-- Chat Footer -->
                                            <div class="chat-footer p-2 d-flex align-items-center"
                                                style="background-color: #F0F3F9; border-top: 1px solid #ddd;">
                                                <img src="/assets/img/team-2.jpg" alt="Avatar"
                                                    class="rounded-circle me-3"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                <div
                                                    style="display: flex; align-items: center; border: 1px solid #EFF3F4; border-radius:10px; padding: 5px 10px; width: 100%; background-color: #f9f9f9;">
                                                    <span style="color: #757575; font-size: 16px; cursor: default;">
                                                        <i class="fa fa-smile ms-1"
                                                            style="font-size: 15px; stroke-width: 2px;"></i>
                                                        <i class="fa fa-paperclip ms-1" style="font-size: 15px"></i>
                                                    </span>
                                                    <input type="text" placeholder="Mulai chat baru"
                                                        style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 2px 15px;">
                                                    <span style="color: #757575; font-size: 16px; cursor: default;">
                                                        <i class="fa fa-paper-plane ms-1" style="font-size: 15px"></i>
                                                    </span>
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
        </div>
    </div>
@endsection
