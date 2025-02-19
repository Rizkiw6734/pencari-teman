@extends('layouts.user')

@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative; z-index: 10;">

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold" id="judulTeman">Teman di Kota</h3>
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 10px; border: 1px solid #EFF3F4; border-radius:20px; padding: 5px 10px; width: 100%; background-color: #f9f9f9;">
                <span style="color: #757575; font-size: 16px; cursor: default;">
                    <i class="fa fa-search ms-1" style="font-size: 15px"></i>
                </span>
                <input type="text" id="searchInput" placeholder="Cari teman seru disekitar anda" style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 5px;">
            </div>

            <div id="filterByKota" class="mt-3">
                <div class="dropdown d-flex">
                    <select id="provinsi" class="form-select me-2" style="width: 150px;">
                        <option value="">Pilih Provinsi</option>
                    </select>
                    <select id="kota" class="form-select" style="width: 150px;">
                        <option value="">Pilih Kota</option>
                    </select>
                </div>
            </div>

            <div id="userList" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mt-3">
                <!-- Data pengguna akan dimuat di sini -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            loadProvinsi();

            $('#provinsi').on('change', function() {
                let provinsiId = $(this).val();
                if (provinsiId) {
                    loadKota(provinsiId);
                } else {
                    $('#kota').empty().append('<option value="">Pilih Kota</option>');
                }
            });

            $('#kota').on('change', function() {
                let kotaId = $(this).val();
                if (kotaId) {
                    getPenggunaByKota(kotaId);
                }
            });

            function loadProvinsi() {
                $.ajax({
                    url: '/jelajahi/provinsi',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#provinsi').empty().append('<option value="">Pilih Provinsi</option>');
                            $.each(response.data, function(key, provinsi) {
                                $('#provinsi').append('<option value="' + provinsi.id + '">' + provinsi.name + '</option>');
                            });
                        }
                    }
                });
            }

            function loadKota(provinsiId) {
                $.ajax({
                    url: '/jelajahi/provinsi/' + provinsiId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#kota').empty().append('<option value="">Pilih Kota</option>');
                        if (response.status === 'success') {
                            $.each(response.data, function(key, kota) {
                                $('#kota').append('<option value="' + kota.id + '">' + kota.name + '</option>');
                            });
                        }
                    }
                });
            }

            function getPenggunaByKota(kabupaten_id) {
                $.ajax({
                    url: '/jelajahi/pengguna-by-kota/' + kabupaten_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        renderUserList(response.data, 'Tidak ada pengguna di kota ini.');
                    },
                    error: function(xhr) {
                        console.error('Gagal mendapatkan pengguna berdasarkan kota:', xhr.responseText);
                    }
                });
            }

            function renderUserList(users, emptyMessage) {
                const userList = $('#userList');
                userList.empty();

                if (users.length === 0) {
                    userList.append('<p class="text-center">' + emptyMessage + '</p>');
                } else {
                    users.forEach(user => {
                        console.log(user); // 🔍 Cek seluruh data user
    console.log(user.kabupatens); // 🔍 Cek apakah relasi ada

    const distanceOrLocation = (user.kabupatens && user.kabupatens.name)
        ? user.kabupatens.name
        : 'Lokasi tidak tersedia';
                        const imageUrl = user.foto_profil ? `/storage/${user.foto_profil}` : '/images/marie.jpg';

                        const userCard = `
                            <div class="col">
                                <div class="card position-relative overflow-hidden border-0 shadow-sm" style="height: 300px">
                                    <img src="${imageUrl}" class="card-img-top" alt="Foto Profile" style="object-fit: cover; height: 100%; width: 100%; z-index: 0;">
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <i class="fa-solid fa-user-plus text-white p-2 rounded-circle"></i>
                                    </div>
                                    <div class="card-img-overlay d-flex flex-column justify-content-end text-white p-3 rounded-bottom" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="card-title mb-1">
                                                    <a href="/profile/${user.id}" class="text-white text-decoration-none">${user.name}</a>
                                                </h5>
                                                <p class="card-text" style="font-size: 12px;">
                                                    <i class="fa-solid fa-location-dot"></i> ${distanceOrLocation}
                                                </p>
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 m-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(217, 217, 217, 0.5); border-radius: 50%;">
                                                <i class="fa-regular fa-comment-dots" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        userList.append(userCard);
                    });
                }
            }
        });
    </script>
@endsection
