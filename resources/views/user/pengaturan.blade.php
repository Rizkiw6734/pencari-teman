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
                <a href="{{ route('blokiran') }}" class="text-black" style="font-size: 17px; font-weight: 500;">Kontak Diblokir</a>
                <p style="font-size: 12px; font-style: italic;">{{ $jumlahBlokir }} Pengguna Diblokir</p>

                <a href="{{ route('user.logs') }}" class="text-black" style="font-size: 17px; font-weight: 500; ">Aktivitas Anda</a>
                <p style="font-size: 12px; font-style: italic;">Aktivitas anda dapat dilihat disini</p>
            </div>
        </div>
    </div>
@endsection
