@extends('layouts.user')
@section('content')

<style>
    div::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="main-content"
        style="max-width: 1200px; margin: 0 auto; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative;">
    <div class="container-fluid">
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <i class="fa-solid fa-arrow-left" style="margin-right: 15px; cursor: pointer;" onclick="goBack()"></i>
            <span style="font-size: 20px; font-weight: 600; color:#000000;">Pengguna Diblokir</span>
        </div>
        <div style="height: 1px; background-color: #ddd; margin: 2px 0; margin-bottom: 20px;"></div>
        <p style="font-size: 13px; margin-top: -10px; color:#000000;">Daftar Pengguna yang Anda Blokir</p>
        <div id="chat-container" style="height: 520px; overflow-y: auto; solid #ccc;">
            @forelse($blokirans as $blokiran)
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="{{ $blokiran->blockedUser->foto_profil ? asset('storage/' . $blokiran->blockedUser->foto_profil) : asset('images/marie.jpg') }}"
                         alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">
                        {{ $blokiran->blockedUser->name }}
                    </span>
                    <button class="btn btn-sm btn-danger ms-auto" data-bs-toggle="modal"
                            data-bs-target="#unblokirModal-{{ $blokiran->blockedUser->id }}"
                            data-id="{{ $blokiran->blockedUser->id }}">
                        <i class="fa-solid fa-unlock"></i> Buka Blokir
                    </button>
                </div>

                <!-- Modal untuk masing-masing user -->
                <div class="modal fade" id="unblokirModal-{{ $blokiran->blockedUser->id }}"
                     tabindex="-1" aria-labelledby="unblokirModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0 text-center w-100 mb-0">
                                <h1 class="modal-title fs-3 mx-auto">Buka Blokir Pengguna</h1>
                            </div>
                            <div class="modal-body text-black text-center fs-5 mx-auto mt-0">
                                <img src="/assets/img/unblokir.png" alt="" class="d-block mx-auto">
                                Apakah Anda yakin ingin membuka<br>
                                blokir pengguna?
                            </div>
                            <div class="modal-footer d-flex justify-content-between border-0 mx-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        style="background-color: #000000; color: white; font-size: 14px; padding: 10px 30px;">Batal</button>
                                <button type="button" class="btn btn-primary btn-buka-blokir"
                                        data-id="{{ $blokiran->blockedUser->id }}"
                                        style="background-color: #ffffff; color: rgb(0, 0, 0); font-size: 14px; padding: 10px 30px; border:#000000 solid 1px;">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <p style="text-align: center; color: gray;">Tidak ada pengguna yang diblokir.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function goBack() {
        window.location.href = document.referrer || '/';
    }

    // Event untuk semua tombol "Ya" di modal
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-buka-blokir").forEach(button => {
            button.addEventListener("click", async function () {
                let userId = this.getAttribute("data-id");

                try {
                    const response = await fetch(`/buka-blokir/${userId}`, {
                        method: "DELETE", // Gunakan DELETE karena sesuai dengan aksi "hapus blokir"
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            "Content-Type": "application/json",
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || "Terjadi kesalahan saat membuka blokir.");
                    }

                    // SweetAlert setelah blokir dibuka
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Pengguna telah dibuka blokirnya!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Reload halaman setelah SweetAlert
                    });

                } catch (error) {
                    console.error("Error:", error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.message,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });

</script>
@endsection
