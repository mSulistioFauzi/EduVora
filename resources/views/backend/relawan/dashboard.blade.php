
@extends('backend.v_layouts.app')

@section('title', 'Dashboard Relawan')

@section('judul_halaman', 'Dashboard Relawan')

@section('deskripsi_halaman', 'Temukan kesempatan untuk berkontribusi dalam pendidikan.')

@section('content')

<div class="card">
    <div class="card-body">
        <h5>Selamat Datang, {{ auth()->user()->name }}!</h5>
        <p class="mb-0">
            Temukan program mengajar dan berkontribusi
            dalam meningkatkan akses pendidikan.
        </p>
    </div>
</div>

@endsection
