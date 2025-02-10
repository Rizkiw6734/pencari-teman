@extends('layouts.user')

@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative; z-index: 10;">

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold" id="judulTeman">Teman di Sekitar</h3>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" id="btnDisekitar" type="button"
                        style="background-color: #84ADFF; font-size: 13px;">Teman Disekitar</button>
                    <button class="btn btn-secondary" id="btnByKota" type="button"
                        style="background-color: #6C757D; font-size: 13px;">Teman Berdasarkan Kota</button>
                </div>
            </div>

            <div id="filterByKota" class="mt-3" style="display: none;">
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
    $('.nav-link').on('click', function() {
        localStorage.removeItem('selectedProvinsi');
        localStorage.removeItem('selectedKota');
    });

    loadProvinsi();

    const lastFilter = localStorage.getItem('lastFilter');
    if (lastFilter === 'kota') {
        $('#filterByKota').show();
        $('#judulTeman').text('Teman di Kota');
        restoreDropdownSelection();
    } else {
        getPenggunaTerdekat();
        $('#filterByKota').hide();
        $('#judulTeman').text('Teman di Sekitar');
    }

    $('#btnDisekitar').on('click', function() {
        $('#filterByKota').hide();
        $('#judulTeman').text('Teman di Sekitar');
        getPenggunaTerdekat();
        localStorage.setItem('lastFilter', 'disekitar');
        clearDropdown();
    });

    $('#btnByKota').on('click', function() {
        $('#filterByKota').show();
        $('#judulTeman').text('Teman di Kota');
        $('#userList').empty();
        localStorage.setItem('lastFilter', 'kota');
        restoreDropdownSelection();
    });

    $('#provinsi').on('change', function() {
        let provinsiId = $(this).val();
        localStorage.setItem('selectedProvinsi', provinsiId);
        if (provinsiId) {
            loadKota(provinsiId);
        } else {
            clearDropdown();
        }
    });

    $('#kota').on('change', function() {
        let kotaId = $(this).val();
        localStorage.setItem('selectedKota', kotaId);
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
                    restoreDropdownSelection();
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
                    const selectedKota = localStorage.getItem('selectedKota');
                    if (selectedKota) {
                        $('#kota').val(selectedKota);
                    }
                }
            }
        });
    }

    function getPenggunaTerdekat() {
        fetch('/jelajahi/terdekat')
            .then(response => response.json())
            .then(data => renderUserList(data, 'Pengguna terdekat tidak ditemukan.'))
            .catch(error => console.error('Gagal mendapatkan pengguna terdekat:', error));
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
            const distanceOrLocation = user.distance
                ? `${user.distance.toFixed(1)} km`
                : (user.kabupatens && user.kabupatens.name ? user.kabupatens.name : 'Lokasi tidak tersedia');

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


    function restoreDropdownSelection() {
        const selectedProvinsi = localStorage.getItem('selectedProvinsi');
        const selectedKota = localStorage.getItem('selectedKota');

        if (performance.navigation.type === 1) {  // Mengecek apakah halaman di-refresh
            clearDropdown();
        } else {
            if (selectedProvinsi) {
                $('#provinsi').val(selectedProvinsi).trigger('change');
                setTimeout(() => {
                    if (selectedKota) {
                        $('#kota').val(selectedKota);
                    }
                }, 300);
            }
        }
    }

    function clearDropdown() {
        $('#provinsi').val('');
        $('#kota').empty().append('<option value="">Pilih Kota</option>');
        localStorage.removeItem('selectedProvinsi');
        localStorage.removeItem('selectedKota');
    }
});


    </script>
@endsection
