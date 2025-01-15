@extends('layouts.app')

@section('title', 'Ajukan Banding')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1 class="my-4">Ajukan Banding</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('banding.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="pinalti_id" class="form-label">Pinalti</label>
                                <select name="pinalti_id" id="pinalti_id" class="form-select">
                                    <option value="">-- Pilih Pinalti --</option>
                                    @foreach ($pinaltis as $pinalti)
                                        <option value="{{ $pinalti->id }}">{{ $pinalti->jenis_hukuman ?? 'Tidak ada alasan' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="alasan_banding" class="form-label">Alasan Banding</label>
                                <textarea name="alasan_banding" id="alasan_banding" rows="4" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                            <a href="{{ route('banding.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
