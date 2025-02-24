@extends('layouts.user')
@section('content')
<div class="main-content"
     style="max-width: 1200px; margin: 0 auto; background-color: #F0F3F9;
            padding: 20px; margin-left: 260px; position: relative; min-height: 100vh;">
    <div class="container-fluid">
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <i class="fa-solid fa-arrow-left" style="margin-right: 15px; cursor: pointer;"
               onclick="window.location.href='{{ route('user.pengaturan') }}'"></i>
            <span style="font-size: 20px; font-weight: 600; color:#000000;">Aktivitas Anda</span>
        </div>
        <div style="height: 1px; background-color: #ddd; margin: 2px 0; margin-bottom: 20px;"></div>
        <style>
            div::-webkit-scrollbar {
                display: none;
            }
        </style>
        <div id="chat-container" style="height: 500px; overflow-y: scroll;">
            <p style="font-size: 15px; color:#000000; font-weight: 600; margin-bottom: 10px;">Hari ini</p>
            @foreach($logsToday as $log)
                <div class="activity">
                    <div class="d-flex align-items-center p-1 rounded shadow-sm w-100 px-3 mb-3" style="background-color: #D1E0FF;">
                        <img src="/assets/img/team-3.jpg" alt="Profile" class="rounded-circle me-3" width="40" height="40">
                        <div class="flex-grow-1">
                            <p class="mb-0" style="color: #000000;">{{ $log->aktivitas }}</p>
                            <small class="d-block text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </div>
                        <small style="color: #000000;">{{ $log->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            @endforeach

            <div id="all-activities" style="display: none;">
                <div style="height: 2px; background-color: #7575754D; margin: 20px 0;"></div>
                <p style="font-size: 15px; color:#000000; font-weight: 600; margin-bottom: 10px;">Bulan Ini</p>
                @foreach($logsThisMonth as $log)
                    <div class="activity">
                        <div class="d-flex align-items-center p-1 rounded shadow-sm w-100 px-3 mb-3" style="background-color: #D1E0FF;">
                            <img src="/assets/img/team-3.jpg" alt="Profile" class="rounded-circle me-3" width="40" height="40">
                            <div class="flex-grow-1">
                                <p class="mb-0" style="color: #000000;">{{ $log->aktivitas }}</p>
                                <small class="d-block text-muted">{{ $log->created_at->diffForHumans() }}</small>
                            </div>
                            <small style="color: #000000;">{{ $log->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <button id="show-all-btn" class="btn btn-primary" style="background-color: #528BFF; color: white; border: none; padding: 10px;">
                    Tampilkan Semua <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('show-all-btn').addEventListener('click', function() {
        document.getElementById('all-activities').style.display = 'block';
        this.style.display = 'none';
    });
</script>
@endsection
