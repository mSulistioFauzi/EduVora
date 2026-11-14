
@extends('backend.v_layouts.app')

@section('title', 'Dashboard Admin')

@section('judul_halaman', 'Dashboard Admin')

@section('deskripsi_halaman', 'Ringkasan aktivitas EduRelawan.')

@section('content')

<div class="row g-4">

    <div class="col-md-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Total Relawan</p>
                    <h3>0</h3>
                </div>
                <i class="bi bi-people fs-2"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Total Mitra</p>
                    <h3>0</h3>
                </div>
                <i class="bi bi-building fs-2"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Pengajuan Bantuan</p>
                    <h3>0</h3>
                </div>
                <i class="bi bi-file-earmark-text fs-2"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Program Mengajar</p>
                    <h3>0</h3>
                </div>
                <i class="bi bi-book fs-2"></i>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-body">
        <h5>Selamat Datang, {{ auth()->user()->name }}!</h5>
        <p class="mb-0">
            Anda login sebagai Admin EduRelawan.
        </p>
    </div>
</div>

@endsection
