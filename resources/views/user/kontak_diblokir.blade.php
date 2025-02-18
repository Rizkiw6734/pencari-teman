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
     alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">
                        {{ $blokiran->blockedUser->name }}
                    </span>
                    <button class="btn btn-sm btn-danger ms-auto" onclick="bukaBlokir({{ $blokiran->blockedUser->id }})">
                        <i class="fa-solid fa-unlock"></i> Buka Blokir
                    </button>
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


    function bukaBlokir(userId) {
    fetch(`/buka-blokir/${userId}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json",
        }
    })
    .then(response => response.json())
    .then(data => {
        // SweetAlert setelah blokir dibuka
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Pengguna telah dibuka blokirnya!',
            confirmButtonText: 'OK'
        }).then(() => {
            // Reload halaman setelah SweetAlert
            location.reload();
        });
    })
    .catch(error => console.error("Error:", error));
}

</script>
@endsection
