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
                <a href="{{ route('blokiran') }}" style="font-size: 17px; font-weight: 500; color: #528BFF;">Kontak Diblokir</a>
                <p style="font-size: 12px; font-style: italic;">{{ $jumlahBlokir }} Pengguna Diblokir</p>

                <a href="{{ route('user.logs') }}" style="font-size: 17px; font-weight: 500; color: #528BFF;">Aktivitas Anda</a>
                <p style="font-size: 12px; font-style: italic;">Aktivitas anda dapat dilihat disini</p>

                <a href="#" style="font-size: 17px; font-weight: 500; color: #528BFF;">Rating Aplikasi</a>
                <p style="font-size: 12px; font-style: italic;">Kami ingin tahu bagaimana pendapatmu tentang aplikasi ini</p>
            </div>
        </div>
    </div>
@endsection
