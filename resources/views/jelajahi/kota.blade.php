@extends('layouts.user')
@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative; z-index: 10;  min-height: 100vh;">

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">Teman di Kota</h3>
            </div>
            <div style="display: flex; align-items: center; margin-bottom: 10px; border: 1px solid #EFF3F4; border-radius:20px; padding: 5px 10px; width: 100%; background-color: #f9f9f9;">
                <span style="color: #757575; font-size: 16px; cursor: default;">
                    <i class="fa fa-search ms-1" style="font-size: 15px"></i>
                </span>
                <input type="text" id="searchInput" placeholder="Cari teman seru di kota anda"
                    style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 5px;">
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mt-0" id="friendList">
                @foreach($penggunaLain as $pengguna)
                    <div class="col friend-card">
                        <div class="card position-relative overflow-hidden border-0 shadow-sm" style="height: 300px">
                            <img src="{{ $pengguna->foto_profil ? asset('storage/' . $pengguna->foto_profil) : asset('images/marie.jpg') }}" class="card-img-top" alt="Foto Profile"
                                style="object-fit: cover; height: 100%; width: 100%; z-index: 0;">

                                <div class="position-absolute top-0 end-0 m-2"
                                style="z-index: 2000; pointer-events: auto;">
                               <i class="fa-solid fa-user-plus text-white p-2 rounded-circle follow-btn"
                                  style="cursor: pointer;"
                                  data-id="{{ $pengguna->id }}"
                                  data-name="{{ $pengguna->name }}"
                                  onclick="followUser(this.dataset.id, this.dataset.name)">
                               </i>
                           </div>


                            <div class="card-img-overlay d-flex flex-column justify-content-end text-white p-3 rounded-bottom"
                                style="background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1 friend-name"> <a href="{{ route('profile.show', ['id' => $pengguna->id]) }}" class="text-white text-decoration-none">
                                            {{ $pengguna->name }}
                                        </a></h5>
                                        <p class="card-text" style="font-size: 12px;">
                                            <i class="fa-solid fa-location-dot"></i> {{ $pengguna->distance }} km
                                        </p>
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 m-3 d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px; background: rgba(217, 217, 217, 0.5); border-radius: 50%;">
                                        <i class="fa-regular fa-comment-dots" style="font-size: 25px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const friendCards = document.querySelectorAll('.friend-card');

            friendCards.forEach(card => {
                const friendName = card.querySelector('.friend-name').textContent.toLowerCase();
                if (friendName.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        function followUser(userId, userName) {
            fetch(`/follow/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: `Berhasil mengikuti ${userName}.`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                setTimeout(() => {
                    location.reload(); // Refresh halaman setelah notifikasi selesai
                }, 1600);
            });
        }
    </script>
@endsection
