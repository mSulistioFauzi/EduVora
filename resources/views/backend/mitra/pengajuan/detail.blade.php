@extends('backend.v_layouts.app')

@section('title', 'Detail Pengajuan')

@section('judul_halaman', 'Detail Pengajuan Bantuan')
@section('deskripsi_halaman', 'Informasi lengkap pengajuan bantuan pendidikan.')

@section('content')

    <div class="card border-light shadow-sm p-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h5 class="card-title mb-0">Informasi Pengajuan</h5>

            <a href="{{ route('mitra.pengajuan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label-custom">Judul Pengajuan</label>
                <input class="form-control-custom" value="{{ $pengajuan->judul_pengajuan }}" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Jumlah Anak</label>
                <input class="form-control-custom" value="{{ $pengajuan->jumlah_anak }} anak" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Jenjang Pendidikan</label>
                <input class="form-control-custom" value="{{ $pengajuan->jenjang_pendidikan }}" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Waktu yang Diharapkan</label>
                <input class="form-control-custom" value="{{ $pengajuan->waktu_yang_diharapkan ?? '-' }}" readonly>
            </div>

            <div class="col-12">
                <label class="form-label-custom">Deskripsi Kondisi</label>
                <textarea class="form-control-custom" rows="4" readonly>{{ $pengajuan->deskripsi_kondisi }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label-custom">Fasilitas yang Tersedia</label>
                <textarea class="form-control-custom" rows="3" readonly>{{ $pengajuan->fasilitas_tersedia ?? '-' }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Status Pengajuan</label>
                <div>
                    @if ($pengajuan->status_pengajuan === 'disetujui')
                        <span class="badge-table success">Disetujui</span>
                    @elseif ($pengajuan->status_pengajuan === 'ditolak')
                        <span class="badge-table failed">Ditolak</span>
                    @else
                        <span class="badge-table pending">Menunggu</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Tanggal Pengajuan</label>
                <input class="form-control-custom" value="{{ $pengajuan->created_at->format('d-m-Y H:i') }}" readonly>
            </div>

            <div class="col-12">
                <label class="form-label-custom">Catatan Admin</label>
                <textarea class="form-control-custom" rows="3" readonly>{{ $pengajuan->catatan_admin ?? 'Belum ada catatan dari admin.' }}</textarea>
            </div>

            @if ($pengajuan->foto_pendukung)
                <div class="col-12">
                    <label class="form-label-custom">Foto Pendukung</label>
                    <div>
                        <a href="{{ Storage::url($pengajuan->foto_pendukung) }}" target="_blank"
                            class="btn btn-outline-primary">
                            <i class="bi bi-image me-1"></i>
                            Lihat Foto Pendukung
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
