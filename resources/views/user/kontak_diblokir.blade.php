@extends('layouts.user')
@section('content')
<style>
    div::-webkit-scrollbar {
        display: none;
    }
</style>
<div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative;">
        <div class="container-fluid">
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <i class="fa-solid fa-arrow-left" style="margin-right: 15px;"></i>
                <span style="font-size: 20px; font-weight: 600; color:#000000;">Pengguna diblokir</span>
            </div>
            <div style="height: 1px; background-color: #ddd; margin: 2px 0; margin-bottom: 20px;"></div>
            <p style="font-size: 13px; margin-top: -10px; color:#000000;">Pengguna</p>
            <div id="chat-container" style="height: 520px; overflow-y: scroll; solid #ccc;">
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/assets/img/pp.jpg" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    <span style="font-size: 16px; font-weight: 600; color:#000000;">Christ</span>
                </div>
            </div>
        </div>
</div>
@endsection
