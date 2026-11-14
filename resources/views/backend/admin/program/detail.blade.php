@extends('backend.v_layouts.app')

@section('title', 'Detail Program')
@section('judul_halaman', 'Detail Program Mengajar')
@section('deskripsi_halaman', 'Informasi lengkap program mengajar.')

@section('content')

    <div class="card border-light shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Informasi Program</h5>

            <a href="{{ route('admin.program.index') }}" class="btn btn-light">
                Kembali
            </a>
        </div>

        <div class="row g-4">

            <div class="col-md-6">
                <label class="form-label-custom">Nama Program</label>
                <p>{{ $program->nama_program }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Mata Pelajaran</label>
                <p>{{ $program->mataPelajaran->nama_mata_pelajaran ?? '-' }}</p>
            </div>

            <div class="col-12">
                <label class="form-label-custom">Deskripsi Program</label>
                <p>{{ $program->deskripsi_program ?: '-' }}</p>
            </div>

            <div class="col-12">
                <label class="form-label-custom">Lokasi</label>
                <p>{{ $program->lokasi }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Jenjang Pendidikan</label>
                <p>{{ $program->jenjang_pendidikan }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Kuota Relawan</label>
                <p>{{ $program->kuota_relawan }} orang</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Tanggal Mulai</label>
                <p>{{ $program->tanggal_mulai->format('d/m/Y') }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Tanggal Selesai</label>
                <p>{{ $program->tanggal_selesai?->format('d/m/Y') ?? '-' }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Jam Mulai</label>
                <p>{{ $program->jam_mulai ?: '-' }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Jam Selesai</label>
                <p>{{ $program->jam_selesai ?: '-' }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Status Program</label>
                <p>{{ ucfirst($program->status_program) }}</p>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Admin Pembuat</label>
                <p>{{ $program->admin->name ?? '-' }}</p>
            </div>

            <div class="col-12">
                <label class="form-label-custom">Pengajuan Bantuan</label>
                <p>{{ $program->pengajuan->judul_pengajuan ?? 'Program mandiri' }}</p>
            </div>

        </div>
    </div>

@endsection
