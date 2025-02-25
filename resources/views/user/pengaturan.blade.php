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
                <a href="{{ route('blokiran') }}" style="font-size: 17px; font-weight: 500; color: #528BFF;">Kontak
                    Diblokir</a>
                <p style="font-size: 12px; font-style: italic;">{{ $jumlahBlokir }} Pengguna Diblokir</p>

                <a href="{{ route('user.logs') }}" style="font-size: 17px; font-weight: 500; color: #528BFF;">Aktivitas
                    Anda</a>
                <p style="font-size: 12px; font-style: italic;">Aktivitas anda dapat dilihat disini</p>

                <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"
                    style="font-size: 17px; font-weight: 500; color: #528BFF;">Rating Aplikasi</a>
                <p style="font-size: 12px; font-style: italic;">Kami ingin tahu bagaimana pendapatmu tentang aplikasi ini
                </p>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="border: none;">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Beri Ulasan</h1>
                            </div>
                            <div class="modal-body">
                                <div class="card" style="box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25);">
                                    <div class="card-body">
                                        <form id="ratingform" action="#" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3 d-flex flex-column">
                                                <label for="rating" class="form-label fw-bold text-start"
                                                    style="font-size: 17px; margin-bottom : -10px;">Rating</label>
                                                <!-- Rating Bintang -->
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

                                                <!-- Input Ulasan -->
                                                <label for="ulasan" class="form-label fw-bold text-start"
                                                    style="font-size: 17px; margin-bottom: -15px;">Ulasan</label>
                                                <textarea class="form-control mt-3" id="ulasan" name="ulasan" rows="3" placeholder="Masukkan ulasan Anda"
                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 1px 1px rgba(82, 139, 255, 0.25)">
                            </textarea>
                                                <small class="text-end">0/200</small>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                        style="margin-bottom: -5px; margin-top: -20px;">
                                        <button type="button" class="btn"
                                            style="font-size: 14px; padding: 10px 30px; background-color: #528BFF; color: white;">Kirim</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
