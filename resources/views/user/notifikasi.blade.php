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
                <p style="font-size: 15px; color:#000000; font-weight: 600; margin-bottom: 10px;">Hari Ini</p>

                @foreach ($todayNotifications as $notification)
                    <div class="notifikasi" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $notification->id }}">
                        <div class="d-flex align-items-center p-2 rounded shadow-sm w-100 px-3 mb-3"
                            style="background-color: #D1E0FF;">
                            <img src="{{ $notification->user->foto_profil ? asset('storage/' . $notification->user->foto_profil) : asset('images/marie.jpg') }}"
                                alt="Profile" class="rounded-circle me-3" width="40" height="40">
                            <div class="flex-grow-1">
                                @if (isset($notification->type))
                                    <!-- Notifikasi dari NotifLaporan -->
                                    <p class="mb-0" style="color: #000000; font-size: 14px;">
                                        @if ($notification->type == 'peringatan')
                                            {{ $notification->judul }}
                                        @elseif ($notification->type == 'suspend')
                                            {{ $notification->judul }}
                                        @elseif ($notification->type == 'banned')
                                            {{ $notification->judul }}
                                        @endif
                                    </p>
                                @else
                                    <!-- Notifikasi dari tabel notifikasi -->
                                    <p class="mb-0" style="color: #000000; font-size: 14px;">{{ $notification->judul }}
                                    </p>
                                @endif
                                <small class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <small style="color: #000000;">{{ $notification->created_at->format('d M Y') }}</small>
                        </div>
                    </div>

                    <!-- Modal untuk NotifLaporan -->
                    <div class="modal fade" id="exampleModal{{ $notification->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Notifikasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="filter: invert(1);"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                        <div class="card-body">
                                            @if ($notification->laporan)
                                                @if ($notification->laporan->pelapor->id == auth()->id())
                                                    <!-- Pesan untuk Pelapor -->
                                                    @if ($notification->laporan->status == 'ditolak')
                                                        <p style="font-size: 13px; margin-bottom: 0px;"><b>Status: Laporan
                                                                Ditolak</b></p>
                                                        <div class="alert alert-danger" style="font-size: 13px;">
                                                            Laporan Anda telah ditolak oleh admin karena tidak memenuhi
                                                            kriteria yang ditetapkan. Silakan periksa kembali dan ajukan
                                                            laporan yang sesuai.
                                                        </div>
                                                    @else
                                                        <p style="font-size: 13px; margin-bottom: 0px;"><b>Status: Laporan
                                                                Terkirim</b></p>
                                                        <p style="font-size: 13px;">
                                                            Laporan Anda telah berhasil dikirim. Kami akan segera meninjau
                                                            laporan ini dan memberikan pemberitahuan lebih lanjut.
                                                        </p>
                                                    @endif
                                                @else
                                                    <!-- Pesan untuk Terlapor -->
                                                    <p style="font-size: 13px; margin-bottom: 0px;">
                                                        <b>{{ $notification->judul }}</b>
                                                    </p>
                                                    <p style="font-size: 13px;">
                                                        {{ $notification->pesan }}
                                                    </p>
                                                @endif
                                            @endif

                                            <!-- Notifikasi dari notif_laporan -->
                                            @if (isset($notification->type))
                                                <p style="font-size: 13px; margin-bottom: 0px;">
                                                    <b>Status: {{ ucfirst($notification->type) }}</b>
                                                </p>

                                                @if ($notification->type == 'peringatan')
                                                    <div class="alert alert-warning" style="font-size: 13px;">
                                                        ⚠️ <b>Peringatan!</b> Anda telah menerima peringatan karena
                                                        pelanggaran terhadap kebijakan komunitas kami. Harap patuhi aturan
                                                        agar tidak terkena tindakan lebih lanjut.
                                                    </div>

                                                    <p style="font-size: 13px; color: red;">
                                                        📌 <b>Peringatan Akun</b>
                                                    </p>
                                                    <ul style="font-size: 13px;">
                                                        <li>Karena laporan dari {{ $notification->laporan->pelapor->name }} terbukti valid, akun Anda mungkin akan
                                                            dikenakan <b>pembatasan sementara</b> atau <b>tindakan lebih
                                                                lanjut</b>.</li>
                                                        <li>Jika Anda merasa laporan ini terjadi karena kesalahan, Anda
                                                            dapat mengajukan <b>banding</b> melalui pusat bantuan kami.</li>
                                                        <li>Kami menyarankan Anda untuk membaca kembali <b>pedoman
                                                                komunitas</b> agar terhindar dari potensi pelanggaran di
                                                            masa mendatang.</li>
                                                    </ul>

                                                    <p style="font-size: 13px;">
                                                        Kami akan memberikan pemberitahuan lebih lanjut setelah laporan ini
                                                        ditinjau.
                                                    </p>
                                                    <p style="font-size: 13px; margin-top: -20px;"> <b>Team Pencari
                                                            Teman</b> </p>
                                                @elseif($notification->type == 'suspend')
                                                    <div class="alert alert-danger" style="font-size: 13px;">
                                                        ⏸️ <b>Akun Ditangguhkan</b>
                                                        Akun Anda telah ditangguhkan sementara karena pelanggaran serius.
                                                        Jika Anda merasa ini adalah kesalahan, Anda dapat mengajukan
                                                        banding.
                                                    </div>
                                                @elseif($notification->type == 'banned')
                                                    <div class="alert alert-danger" style="font-size: 13px;">
                                                        ❌ <b>Akun Diblokir Permanen</b>
                                                        Akun Anda telah diblokir secara permanen karena pelanggaran berat
                                                        terhadap aturan komunitas. Jika ini terjadi karena kesalahan, Anda
                                                        dapat mengajukan banding dalam waktu 7 hari.
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                            style="margin-bottom: -5px; margin-top: -40px;">
                                            @if (in_array($notification->type ?? '', ['peringatan', 'suspend', 'banned']))
                                                <!-- Tombol Ajukan Banding untuk Peringatan, Suspend, Banned -->
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalAjukan"
                                                    style="font-size: 14px; padding: 10px 30px; background-color: #528BFF; color: white;">Ajukan
                                                    Banding</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Bagian "Bulan Ini" (sama seperti di atas) -->
                <div id="all-activities">
                    <div style="height: 2px; background-color: #7575754D; margin: 20px 0;"></div>
                    <p style="font-size: 15px; color:#000000; font-weight: 600; margin-bottom: 10px;">Bulan Ini</p>

                    @foreach ($thisMonthNotifications as $notification)
                        <div class="notifikasi" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $notification->id }}">
                            <div class="d-flex align-items-center p-2 rounded shadow-sm w-100 px-3 mb-3"
                                style="background-color: #D1E0FF;">
                                <img src="{{ $notification->user->foto_profil ? asset('storage/' . $notification->user->foto_profil) : asset('images/marie.jpg') }}"
                                    alt="Profile" class="rounded-circle me-3" width="40" height="40">
                                <div class="flex-grow-1">
                                    @if (isset($notification->type))
                                        <!-- Notifikasi dari NotifLaporan -->
                                        <p class="mb-0" style="color: #000000; font-size: 14px;">
                                            @if ($notification->type == 'peringatan')
                                                {{ $notification->judul }}
                                            @elseif ($notification->type == 'suspend')
                                                {{ $notification->judul }}
                                            @elseif ($notification->type == 'banned')
                                                {{ $notification->judul }}
                                            @endif
                                        </p>
                                    @else
                                        <!-- Notifikasi dari tabel notifikasi -->
                                        <p class="mb-0" style="color: #000000; font-size: 14px;">
                                            {{ $notification->judul }}
                                        </p>
                                    @endif
                                    <small
                                        class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                <small style="color: #000000;">{{ $notification->created_at->format('d M Y') }}</small>
                            </div>
                        </div>

                        <!-- Modal untuk NotifLaporan -->
                        <div class="modal fade" id="exampleModal{{ $notification->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Notifikasi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" style="filter: invert(1);"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                            <div class="card-body">
                                                @if ($notification->laporan)
                                                    @if ($notification->laporan->pelapor->id == auth()->id())
                                                        <!-- Pesan untuk Pelapor -->
                                                        @if ($notification->laporan->status == 'ditolak')
                                                            <p style="font-size: 13px; margin-bottom: 0px;"><b>Status:
                                                                    Laporan
                                                                    Ditolak</b></p>
                                                            <div class="alert alert-danger" style="font-size: 13px;">
                                                                Laporan Anda telah ditolak oleh admin karena tidak memenuhi
                                                                kriteria yang ditetapkan. Silakan periksa kembali dan ajukan
                                                                laporan yang sesuai.
                                                            </div>
                                                        @else
                                                            <p style="font-size: 13px; margin-bottom: 0px;"><b>Status:
                                                                    Laporan
                                                                    Terkirim</b></p>
                                                            <p style="font-size: 13px;">
                                                                Laporan Anda telah berhasil dikirim. Kami akan segera
                                                                meninjau
                                                                laporan ini dan memberikan pemberitahuan lebih lanjut.
                                                            </p>
                                                        @endif
                                                    @else
                                                        <!-- Pesan untuk Terlapor -->
                                                        <p style="font-size: 13px; margin-bottom: 0px;">
                                                            <b>{{ $notification->judul }}</b>
                                                        </p>
                                                        <p style="font-size: 13px;">
                                                            {{ $notification->pesan }}
                                                        </p>
                                                    @endif
                                                @endif

                                                <!-- Notifikasi dari notif_laporan -->
                                                @if (isset($notification->type))
                                                    <p style="font-size: 13px; margin-bottom: 0px;">
                                                        <b>Status: {{ ucfirst($notification->type) }}</b>
                                                    </p>

                                                    @if ($notification->type == 'peringatan')
                                                        <div class="alert alert-warning" style="font-size: 13px;">
                                                            ⚠️ <b>Peringatan!</b> Anda telah menerima peringatan karena
                                                            pelanggaran terhadap kebijakan komunitas kami. Harap patuhi
                                                            aturan
                                                            agar tidak terkena tindakan lebih lanjut.
                                                        </div>

                                                        <p style="font-size: 13px; color: red;">
                                                            📌 <b>Peringatan Akun</b>
                                                        </p>
                                                        <ul style="font-size: 13px;">
                                                            <li>Karena laporan ini <b>terbukti valid</b>, akun Anda mungkin
                                                                akan
                                                                dikenakan <b>pembatasan sementara</b> atau <b>tindakan lebih
                                                                    lanjut</b>.</li>
                                                            <li>Jika Anda merasa laporan ini terjadi karena kesalahan, Anda
                                                                dapat mengajukan <b>banding</b> melalui pusat bantuan kami.
                                                            </li>
                                                            <li>Kami menyarankan Anda untuk membaca kembali <b>pedoman
                                                                    komunitas</b> agar terhindar dari potensi pelanggaran di
                                                                masa mendatang.</li>
                                                        </ul>

                                                        <p style="font-size: 13px;">
                                                            Kami akan memberikan pemberitahuan lebih lanjut setelah laporan
                                                            ini
                                                            ditinjau.
                                                        </p>
                                                        <p style="font-size: 13px; margin-top: -20px;"> <b>Team Pencari
                                                                Teman</b> </p>
                                                    @elseif($notification->type == 'suspend')
                                                        <div class="alert alert-danger" style="font-size: 13px;">
                                                            ⏸️ <b>Akun Ditangguhkan</b>
                                                            Akun Anda telah ditangguhkan sementara karena pelanggaran
                                                            serius.
                                                            Jika Anda merasa ini adalah kesalahan, Anda dapat mengajukan
                                                            banding.
                                                        </div>
                                                    @elseif($notification->type == 'banned')
                                                        <div class="alert alert-danger" style="font-size: 13px;">
                                                            ❌ <b>Akun Diblokir Permanen</b>
                                                            Akun Anda telah diblokir secara permanen karena pelanggaran
                                                            berat
                                                            terhadap aturan komunitas. Jika ini terjadi karena kesalahan,
                                                            Anda
                                                            dapat mengajukan banding dalam waktu 7 hari.
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                                style="margin-bottom: -5px; margin-top: -40px;">
                                                @if (in_array($notification->type ?? '', ['peringatan', 'suspend', 'banned']))

                                                    @php
                                                        // Debugging: Dump variables to see what's available
                                                        $relatedPinalti = null;

                                                        // If this is a notification with a laporan
                                                        if (isset($notification->laporan) && $notification->laporan) {
                                                            // Try to find pinalti directly from the laporan relation
                                                            $relatedPinalti = $notification->laporan->pinalti;

                                                            // If that doesn't work, try finding it from the pinaltis collection
                                                            if (!$relatedPinalti && isset($pinaltis)) {
                                                                $relatedPinalti = $pinaltis->where('laporan_id', $notification->laporan->id)->first();
                                                            }
                                                        }

                                                        // If this is a NotifLaporan, try another approach (adapt based on your actual models)
                                                        if (!$relatedPinalti && isset($notification->id) && get_class($notification) === 'App\Models\NotifLaporan') {
                                                            // If you have a relation from NotifLaporan to Pinalti or can find it another way
                                                            // Example: $relatedPinalti = Pinalti::where('notification_id', $notification->id)->first();
                                                        }

                                                        $pinaltiId = $relatedPinalti ? $relatedPinalti->id : 'not-found';
                                                    @endphp

                                                    <!-- Tombol Ajukan Banding dengan ID yang lebih jelas -->
                                                    <button type="button" class="btn btn-primary banding-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalAjukan"
                                                        data-pinalti-id="{{ $pinaltiId }}"
                                                        onclick="setPinaltiId('{{ $pinaltiId }}')">
                                                        Ajukan Banding
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                        style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <button id="show-all-btn" class="btn btn-primary"
                        style="background-color: #528BFF; color: white; border: none; padding: 10px;">
                        Tampilkan Semua <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </div>


            <!-- Modal Banding peringatan  -->
            <div class="modal fade @if ($errors->any()) show @endif" id="exampleModalAjukan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Aju Banding</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                <div class="card-body">
                                    <form action="{{ route('banding.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="pinalti_id" name="pinalti_id" value="">
                                        <div class="mb-4">
                                            <label for="alasan_banding" class="form-label" style="font-size: 15px;">Alasan Banding</label>
                                            <textarea class="form-control" id="alasan_banding" name="alasan_banding" rows="3"
                                                placeholder="Masukkan Alasan Anda"
                                                style="border: 0px solid #ffffff; box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25)">{{ old('alasan_banding') }}</textarea>
                                            @error('alasan_banding')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between border-0 mx-2 mt-3"
                                            style="margin-bottom: -5px; margin-top: -40px;">
                                            <button type="submit" class="btn" style="font-size: 14px; padding: 10px 30px; background-color: #528BFF; color: white;">Ajukan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
    //buat aju banding
    let currentPinaltiId = null;
    function setPinaltiId(id) {
        console.log("setPinaltiId function called with:", id);
        currentPinaltiId = id;

        // Set the hidden input
        const pinaltiInput = document.getElementById('pinalti_id');
        if (pinaltiInput) {
            pinaltiInput.value = id;
            console.log("Set pinalti_id input to:", id);
        }

        // Update debug jan di otak atik
        const debugDisplay = document.getElementById('debug-display');
        if (debugDisplay) {
            debugDisplay.innerHTML = "Pinalti ID: " + id;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        console.log("DOM fully loaded");

        document.querySelectorAll(".banding-button").forEach(button => {
            console.log("Found banding button with data-pinalti-id:", button.getAttribute("data-pinalti-id"));

            button.addEventListener("click", function(event) {
                const pinaltiId = this.getAttribute("data-pinalti-id");
                console.log("Button clicked with pinalti ID:", pinaltiId);
                setPinaltiId(pinaltiId);
            });
        });

        const bandingModal = document.getElementById('exampleModalAjukan');
        if (bandingModal) {
            bandingModal.addEventListener('show.bs.modal', function(event) {
                console.log("Modal opening, current pinaltiId:", currentPinaltiId);

                const button = event.relatedTarget;
                if (button) {
                    const pinaltiId = button.getAttribute('data-pinalti-id');
                    console.log("Button triggered modal with ID:", pinaltiId);
                    setPinaltiId(pinaltiId);
                } else if (currentPinaltiId) {
                    console.log("Using stored pinaltiId:", currentPinaltiId);
                    setPinaltiId(currentPinaltiId);
                }
            });
        }

        const bandingForm = document.getElementById('bandingForm');
        if (bandingForm) {
            bandingForm.addEventListener('submit', function(event) {
                const pinaltiInput = document.getElementById('pinalti_id');
                console.log("Form submitting with pinalti_id:", pinaltiInput.value);

                if (!pinaltiInput.value || pinaltiInput.value === 'not-found') {
                    event.preventDefault();
                    alert("Error: Tidak dapat menemukan ID pinalti. Silakan coba lagi.");
                    console.error("Form submission blocked - missing pinalti_id");
                }
            });
        }
    });
</script>


>>>>>>> 58679dec152eae7ba50e3166586ef6ef4223fad8

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('exampleModalAjukan'));
            myModal.show();

            // Menampilkan alert error dengan SweetAlert
            Swal.fire({
                title: 'Error!',
                html: `
                    <ul style="text-align: left; color: red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session("error") }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>




            <script>
                document.getElementById('show-all-btn').addEventListener('click', function() {
                    document.getElementById('all-activities').style.display = 'block';
                    this.style.display = 'none';
                });
            </script>
        @endsection


        {{-- <div class="card-body">
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
</div> --}}
