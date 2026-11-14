@extends('backend.v_layouts.app')

@section('title', 'Detail Pengajuan')
@section('judul_halaman', 'Detail Pengajuan Bantuan')
@section('deskripsi_halaman', 'Periksa informasi pengajuan dan tentukan keputusan admin.')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-12 col-lg-7">
            <div class="card border-light shadow-sm p-4">
                <h5 class="mb-4">Informasi Pengajuan</h5>

                <div class="mb-3">
                    <label class="form-label-custom">Judul Pengajuan</label>
                    <p>{{ $pengajuan->judul_pengajuan }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Nama Mitra</label>
                    <p>{{ $pengajuan->profilMitra->user->name ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Deskripsi Kondisi</label>
                    <p>{{ $pengajuan->deskripsi_kondisi }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Jumlah Anak</label>
                    <p>{{ $pengajuan->jumlah_anak }} anak</p>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Jenjang Pendidikan</label>
                    <p>{{ $pengajuan->jenjang_pendidikan }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Fasilitas Tersedia</label>
                    <p>{{ $pengajuan->fasilitas_tersedia ?: '-' }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Waktu yang Diharapkan</label>
                    <p>{{ $pengajuan->waktu_yang_diharapkan ?: '-' }}</p>
                </div>

                @if ($pengajuan->foto_pendukung)
                    <div class="mb-3">
                        <label class="form-label-custom">Foto Pendukung</label>
                        <p>
                            <a href="{{ asset('storage/' . $pengajuan->foto_pendukung) }}" target="_blank">
                                Lihat Foto Pendukung
                            </a>
                        </p>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label-custom">Status Saat Ini</label>
                    <p>{{ ucfirst($pengajuan->status_pengajuan) }}</p>
                </div>

                <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-light">
                    Kembali
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card border-light shadow-sm p-4">
                <h5 class="mb-4">Keputusan Admin</h5>

                <form action="{{ route('admin.pengajuan.perbarui', $pengajuan->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-custom">Status Pengajuan</label>
                        <select name="status_pengajuan" class="form-select form-select-custom" required>
                            <option value="disetujui" {{ $pengajuan->status_pengajuan == 'disetujui' ? 'selected' : '' }}>
                                Terima Pengajuan
                            </option>
                            <option value="ditolak" {{ $pengajuan->status_pengajuan == 'ditolak' ? 'selected' : '' }}>
                                Tolak Pengajuan
                            </option>
                        </select>
                        @error('status_pengajuan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Catatan Admin</label>
                        <textarea name="catatan_admin" class="form-control form-control-custom" rows="5"
                            placeholder="Tuliskan alasan atau catatan untuk Mitra...">{{ old('catatan_admin', $pengajuan->catatan_admin) }}</textarea>
                        @error('catatan_admin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Simpan Keputusan
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
