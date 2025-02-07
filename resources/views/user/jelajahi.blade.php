@extends('layouts.user')
@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative; z-index: 10;">

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">Teman di Sekitar</h3>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" id="btnDisekitar" type="button"
                        style="background-color: #84ADFF; font-size: 13px;">Disekitar</button>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle text-dark" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" id="dropdownKota"
                            style="background-color: white; border: 1px solid #C9C1FF; box-shadow:none;">
                            Kota
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownKota">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="userList" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mt-3">
                <!-- Data pengguna akan dimuat di sini -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load pengguna terdekat saat halaman pertama kali dimuat
            getPenggunaTerdekat();
        });

        document.getElementById('btnDisekitar').addEventListener('click', function() {
            getPenggunaTerdekat();
        });

        function getPenggunaTerdekat() {
            fetch('/jelajahi/terdekat')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert('Tidak ada pengguna terdekat.');
                    } else {
                        renderUserList(data);
                    }
                })
                .catch(error => {
                    console.error('Gagal mendapatkan pengguna terdekat:', error);
                });
        }

        function renderUserList(users) {
            const userList = document.getElementById('userList');
            userList.innerHTML = ''; // Hapus konten sebelumnya

            users.forEach(user => {
                const userCard = `
                    <div class="col">
                        <div class="card position-relative overflow-hidden border-0 shadow-sm" style="height: 300px">
                            <img src="${user.avatar || '{{ asset('assets/img/jelajahi.jpg') }}'}" class="card-img-top" alt="..."
                                style="object-fit: cover; height: 100%; width: 100%; z-index: 0;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <i class="fa-solid fa-user-plus text-white p-2 rounded-circle"></i>
                            </div>
                            <div class="card-img-overlay d-flex flex-column justify-content-end text-white p-3 rounded-bottom"
                                style="background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">${user.name}</h5>
                                        <p class="card-text" style="font-size: 12px;">
    <i class="fa-solid fa-location-dot"></i> ${user.distance.toFixed(1)} km
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
                `;
                userList.innerHTML += userCard;
            });
        }
    </script>
@endsection
