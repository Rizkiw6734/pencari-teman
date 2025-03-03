@extends('layouts.user')
@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; background-color: #F0F3F9;
            padding: 20px; margin-left: 260px; position: relative; min-height: 100vh;">
        <div class="container-fluid">
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <i class="fa-solid fa-arrow-left" style="margin-right: 15px; cursor: pointer;"
                    onclick="window.location.href='{{ route('user.pengaturan') }}'"></i>
                <span style="font-size: 20px; font-weight: 600; color:#000000;">Notifikasi Anda</span>
            </div>
            <div style="height: 1px; background-color: #ddd; margin: 2px 0; margin-bottom: 20px;"></div>
            <style>
                div::-webkit-scrollbar {
                    display: none;
                }
            </style>
            <div id="chat-container" style="height: 500px; overflow-y: scroll;">
                <p style="font-size: 15px; color:#000000; font-weight: 600; margin-bottom: 10px;">Hari ini</p>

                <div class="notifikasi" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="d-flex align-items-center p-2 rounded shadow-sm w-100 px-3 mb-3"
                        style="background-color: #D1E0FF;">
                        <img src="/assets/img/team-2.jpg" alt="Profile" class="rounded-circle me-3" width="40"
                            height="40">
                        <div class="flex-grow-1">
                            <p class="mb-0" style="color: #000000; font-size: 14px;">Peringatan : Laporan Aktivitas Tidak
                                Wajar</p>
                            <small class="d-block text-muted">10 menit lalu</small>
                        </div>
                        <small style="color: #000000;">14 Januari 2025</small>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Laporan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="filter: invert(1);"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                        <div class="card-body">
                                            <p style="font-size: 13px; margin-bottom: 0px;">Untuk User1</p>
                                            <p style="font-size: 13px;">Kami ingin menginformasikan bahwa akun Anda telah
                                                dilaporkan oleh pengguna lain karena terdeteksi mengirim pesan dalam jumlah
                                                besar dalam waktu singkat. Aktivitas ini dikategorikan sebagai spam dan
                                                dapat mengganggu pengalaman pengguna lain di platform kami.
                                                Kami menghargai partisipasi Anda di komunitas ini dan ingin memastikan bahwa
                                                setiap pengguna memiliki pengalaman yang nyaman dan aman. Jika laporan ini
                                                terbukti valid, akun Anda mungkin akan dikenakan pembatasan sementara atau
                                                tindakan lebih lanjut sesuai dengan pedoman komunitas kami.</p>

                                            <p style="font-size: 13px; margin-bottom: 0px;">📌 Apa yang bisa Anda lakukan?
                                            </p>
                                            <ul style="font-size: 13px;">
                                                <li>Jika laporan ini terjadi karena kesalahan, Anda dapat mengajukan banding
                                                    melalui pusat bantuan kami.</li>
                                                <li>Harap menggunakan fitur pesan dengan bijak dan menghindari pengiriman
                                                    pesan berulang dalam waktu singkat.</li>
                                                <li>Pastikan Anda membaca dan memahami pedoman komunitas kami untuk
                                                    menghindari pelanggaran di masa mendatang.</li>
                                            </ul>

                                            <p style="font-size: 13px;">Terima kasih atas perhatian dan kerja samanya</p>
                                            <p style="font-size: 13px; margin-top: -20px;">Team Pencari Teman</p>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                            style="margin-bottom: -5px; margin-top: -40px;">
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAjukan"
                                                style="font-size: 14px; padding: 10px 30px; background-color: #528BFF; color: white;">Ajukan
                                                Banding</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalAjukan" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                <div class="card-body">
                                    <form id="ajukanform" action="#" method="POST" enctype="multipart/form-data">
                                        <div class="mb-4">
                                            <label for="alasan_banding" class="form-label" style="font-size: 15px;">Pinalti</label>
                                            <select class="form-select" aria-label="Default select example" style="width: 100%; max-width: 800px; border: 0px solid #ffffff; box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25)">
                                                <option value="">-- Pilih Pinalti --</option>
                                                <option value="">Suspend</option>
                                                <option value="">Banned</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="alasan_banding" class="form-label" style="font-size: 15px;">Alasan Banding</label>
                                            <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Masukkan Alasan Anda" style="border: 0px solid #ffffff; box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25)"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                    style="margin-bottom: -5px; margin-top: -40px;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAjukan"
                                        style="font-size: 14px; padding: 10px 30px; background-color: #528BFF; color: white;">Ajukan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div id="all-activities" style="display: none;">
                    <div style="height: 2px; background-color: #7575754D; margin: 20px 0;"></div>
                    <p style="font-size: 15px; color:#000000; font-weight: 600; margin-bottom: 10px;">Bulan Ini</p>
                    <div class="notifikasi">
                        <div class="d-flex align-items-center p-2 rounded shadow-sm w-100 px-3 mb-3"
                            style="background-color: #D1E0FF;">
                            <img src="/assets/img/team-2.jpg" alt="Profile" class="rounded-circle me-3" width="40"
                                height="40">
                            <div class="flex-grow-1">
                                <p class="mb-0" style="color: #000000; font-size: 14px;">Peringatan : Laporan Aktivitas
                                    Tidak Wajar</p>
                                <small class="d-block text-muted">10 menit lalu</small>
                            </div>
                            <small style="color: #000000;">13 Januari 2025</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <button id="show-all-btn" class="btn btn-primary"
                        style="background-color: #528BFF; color: white; border: none; padding: 10px;">
                        Tampilkan Semua <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('show-all-btn').addEventListener('click', function() {
            document.getElementById('all-activities').style.display = 'block';
            this.style.display = 'none';
        });
    </script>
@endsection
