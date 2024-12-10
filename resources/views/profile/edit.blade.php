@extends('layouts.app')
@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid">
        <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute z-index-2">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
                </ol>
                <h6 class="text-white font-weight-bolder ms-2">Profile</h6>
                </nav>
            </div>
        </nav>
        
        <div class="page-header min-height-250 border-radius-lg mt-4 d-flex flex-column justify-content-end" style="background-image: url('assets/img/curved-images/curved14.jpg'); background-size: cover; background-position: center;">
            <div class="w-100 position-relative p-3">
                <div class="d-flex justify-content-between align-items-end">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl position-relative me-3">
                            <img src="/assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                        <div>
                            <h5 class="mb-1 text-white font-weight-bolder">
                            Alec Thompson
                            </h5>
                            <p class="mb-0 text-white text-sm">
                            CEO / Co-Founder
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-6">
                                <!-- Update Profile Information -->
                                @include('profile.partials.update-profile-information-form')
                            </div>
            
                            <div class="card-body py-6">
                                <!-- Update Password -->
                                @include('profile.partials.update-password-form')
                            </div>
            
                            <div class="card-body py-6">
                                <!-- Delete Account -->
                                <div class="bg-red-50 rounded-lg shadow-sm border border-gray-300">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                  <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                      <div class="copyright text-center text-sm text-muted">
                        <p>Copyright &copy; <i class="fa fa-heart"></i> by around.you
                            <script>
                            document.write(new Date().getFullYear())
                            </script>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection