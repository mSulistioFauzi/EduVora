@extends('backend.v_layouts.app')

@section('title', 'Detail Program Mengajar')

@section('judul_halaman', 'Detail Program Mengajar')
@section('deskripsi_halaman', 'Informasi lengkap mengenai program mengajar yang tersedia.')

@section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-success-subtle text-success">
                        Program Dibuka
                    </span>

                    <span class="badge bg-light text-dark">
                        {{ $program->jenjang_pendidikan }}
                    </span>
                </div>

                <h4 class="fw-bold mb-3">
                    {{ $program->nama_program }}
                </h4>

                <p class="text-muted mb-4">
                    {{ $program->deskripsi_program ?? 'Belum ada deskripsi program.' }}
                </p>

                <hr>

                <h6 class="fw-bold mb-3">Informasi Program</h6>

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Mata Pelajaran</small>
                        <div class="fw-semibold">
                            {{ $program->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Jenjang Pendidikan</small>
                        <div class="fw-semibold">
                            {{ $program->jenjang_pendidikan }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Lokasi Mengajar</small>
                        <div class="fw-semibold">
                            {{ $program->lokasi }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Kuota Relawan</small>
                        <div class="fw-semibold">
                            {{ $program->kuota_relawan }} orang
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Tanggal Mulai</small>
                        <div class="fw-semibold">
                            {{ $program->tanggal_mulai->format('d F Y') }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Tanggal Selesai</small>
                        <div class="fw-semibold">
                            {{ $program->tanggal_selesai ? $program->tanggal_selesai->format('d F Y') : 'Belum ditentukan' }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Jam Mulai</small>
                        <div class="fw-semibold">
                            {{ $program->jam_mulai ? \Carbon\Carbon::parse($program->jam_mulai)->format('H:i') : '-' }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted">Jam Selesai</small>
                        <div class="fw-semibold">
                            {{ $program->jam_selesai ? \Carbon\Carbon::parse($program->jam_selesai)->format('H:i') : '-' }}
                        </div>
                    </div>

                </div>

                <hr>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('relawan.program.index') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-light shadow-sm p-4">

                <div class="text-center mb-3">
                    <i class="bi bi-book text-success" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold mt-2">Informasi Pendaftaran</h5>
                </div>

                <p class="text-muted text-center">
                    Apabila tertarik mengikuti program ini, Anda dapat mendaftar sebagai relawan.
                </p>

                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Fitur pendaftaran relawan akan tersedia pada tahap berikutnya.
                </div>

            </div>
        </div>

    </div>

@endsection
