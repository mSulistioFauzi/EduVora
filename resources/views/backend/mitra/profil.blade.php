@extends('backend.v_layouts.app')

@section('title', 'Profil Mitra | EduRelawan')
@section('judul_halaman', 'Profil Mitra')
@section('deskripsi_halaman', 'Lengkapi informasi organisasi dan wilayah mitra.')

@section('content')

    <div class="row">
        <div class="col-12">

            {{-- Pesan berhasil --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Pesan validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data Anda:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mitra.profil.simpan') }}" method="POST" enctype="multipart/form-data">

                @csrf

                {{-- Informasi Organisasi --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-1">Informasi Organisasi</h5>
                        <small class="text-muted">
                            Masukkan informasi organisasi atau lembaga Anda.
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Organisasi</label>
                                <input type="text" name="nama_organisasi" class="form-control"
                                    placeholder="Nama organisasi atau lembaga"
                                    value="{{ old('nama_organisasi', $profil->nama_organisasi ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Penanggung Jawab</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control"
                                    placeholder="Contoh: Ketua Yayasan" value="{{ old('jabatan', $profil->jabatan ?? '') }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="nomor_telepon" class="form-control"
                                    placeholder="Masukkan nomor telepon"
                                    value="{{ old('nomor_telepon', $profil->nomor_telepon ?? '') }}" required>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Alamat Wilayah --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-1">Alamat dan Wilayah</h5>
                        <small class="text-muted">
                            Masukkan lokasi organisasi atau wilayah yang membutuhkan bantuan.
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_wilayah" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat_wilayah', $profil->alamat_wilayah ?? '') }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Desa / Kelurahan</label>
                                <input type="text" name="desa" class="form-control"
                                    value="{{ old('desa', $profil->desa ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control"
                                    value="{{ old('kecamatan', $profil->kecamatan ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" class="form-control"
                                    value="{{ old('kabupaten', $profil->kabupaten ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control"
                                    value="{{ old('provinsi', $profil->provinsi ?? '') }}" required>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Dokumen Pendukung --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-1">Dokumen Pendukung</h5>
                        <small class="text-muted">
                            Unggah dokumen pendukung organisasi jika tersedia.
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Dokumen Organisasi</label>
                            <input type="file" name="dokumen_pendukung" class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png">

                            <small class="text-muted">
                                Format PDF, JPG, JPEG, atau PNG. Maksimal 2 MB.
                            </small>

                            @if ($profil && $profil->dokumen_pendukung)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $profil->dokumen_pendukung) }}" target="_blank">
                                        Lihat dokumen pendukung sebelumnya
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="d-flex justify-content-end mb-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Profil
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
