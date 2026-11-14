
@extends('backend.v_layouts.app')

@section('title', 'Dashboard Mitra')

@section('judul_halaman', 'Dashboard Mitra')

@section('deskripsi_halaman', 'Kelola kebutuhan dan bantuan pendidikan.')

@section('content')

<div class="card">
    <div class="card-body">
        <h5>Selamat Datang, {{ auth()->user()->name }}!</h5>
        <p class="mb-0">
            Ajukan kebutuhan bantuan pendidikan dan pantau
            perkembangan program melalui EduRelawan.
        </p>
    </div>
</div>

@endsection
