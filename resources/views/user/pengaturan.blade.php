@extends('layouts.user')
@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative; min-height: 100vh;">
        <div class="container-fluid">
            <div>
                <header class="mt-3">
                    <h2 style="font-size: 32px;">
                        {{ __('Pengaturan') }}
                    </h2>
                    <div style="height: 2px; background-color: #75757580; margin: 2px 0; margin-bottom: 20px;"></div>
                </header>
                <a href="{{ route('blokiran') }}" style="font-size: 18px; font-weight: 500; color: #528BFF; text-decoration: underline;">Pengguna diblokir</a>
                <p style="font-size: 12px; font-style: italic; color: #666;">{{ $jumlahBlokir }} Pengguna diblokir</p>

                <span style="font-size: 18px; font-weight: 600; color: #000;">Aktivitas & Notifikasi</span>
                <p style="font-size: 12px; font-style: italic; color: #666;">Aktifitas & Notifikasi anda dapat dilihat disini</p>

                <a href="{{ route('user.logs') }}" style="font-size: 14px; font-weight: 500; color: #528BFF; text-decoration: underline;">Aktifitas Anda</a><br>
                <a href="{{ route('notifikasi.index')}}" style="font-size: 14px; font-weight: 500; color: #528BFF; text-decoration: underline;">Notifikasi Anda</a>

                <br><br>
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#" style="font-size: 18px; font-weight: 500; color: #528BFF; text-decoration: underline;">Rating Aplikasi</a>
                <p style="font-size: 12px; font-style: italic; color: #666;">Kami ingin tahu bagaimana pendapatmu tentang aplikasi ini</p>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="border: none;">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Beri Ulasan</h1>
                            </div>
                            <div class="modal-body">
                                <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                    <div class="card-body">
                                        <form id="ratingform" action="{{ route('rating.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3 d-flex flex-column">
                                                <label for="rating" class="form-label fw-bold text-start" style="font-size: 17px; margin-bottom: -10px;">Rating</label>
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5">
                                                    <label for="star5" title="Sangat Baik">&#9733;</label>
                                                    <input type="radio" id="star4" name="rating" value="4">
                                                    <label for="star4" title="Baik">&#9733;</label>
                                                    <input type="radio" id="star3" name="rating" value="3">
                                                    <label for="star3" title="Cukup">&#9733;</label>
                                                    <input type="radio" id="star2" name="rating" value="2">
                                                    <label for="star2" title="Kurang">&#9733;</label>
                                                    <input type="radio" id="star1" name="rating" value="1">
                                                    <label for="star1" title="Sangat Buruk">&#9733;</label>
                                                </div>
                                            </div>

                                            <div class="mb-3 d-flex flex-column">
                                                <label for="ulasan" class="form-label fw-bold text-start" style="font-size: 18px;">Ulasan</label>
                                                <textarea class="form-control" id="ulasan" name="ulasan" rows="3" placeholder="Masukkan ulasan Anda" style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)"></textarea>
                                                <small class="text-end">0/200</small>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between border-0 mx-2" style="margin-bottom: -5px; margin-top: -20px;">
                                                <button type="submit" class="btn" id="submitRating" style="font-size: 14px; padding: 10px 30px; background-color: #528BFF; color: white;">Kirim</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('ratingform').addEventListener('submit', function(event) {
                        event.preventDefault();
                        let form = this;

                        fetch(form.action, {
                            method: form.method,
                            body: new FormData(form),
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Rating berhasil dikirim!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                    });

                    document.getElementById('exampleModal').addEventListener('hidden.bs.modal', function () {
                        document.getElementById('ratingform').reset();
                    });
                </script>


            </div>
        </div>
    </div>

    <style>
        /* Styling rating bintang */
        .rating {
            direction: rtl;
            display: flex;
            justify-content: end;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 32px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }

        .rating input:checked~label {
            color: #1C55E0;
        }
    </style>
@endsection
