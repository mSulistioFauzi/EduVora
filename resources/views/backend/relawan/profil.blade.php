
@extends('backend.v_layouts.app')

@section('title', 'Profil Relawan | EduRelawan')
@section('judul_halaman', 'Profil Relawan')
@section('deskripsi_halaman', 'Lengkapi informasi diri dan keahlian mengajar Anda.')

@section('content')

<div class="row">
    <div class="col-12">

        {{-- Pesan berhasil --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Pesan validasi --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data Anda:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('relawan.profil.simpan') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            {{-- Informasi Pribadi --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-1">Informasi Pribadi</h5>
                    <small class="text-muted">
                        Lengkapi informasi dasar mengenai diri Anda.
                    </small>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ auth()->user()->name }}"
                                   readonly>
                            <small class="text-muted">
                                Nama mengikuti akun yang digunakan.
                            </small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   class="form-control"
                                   value="{{ auth()->user()->email }}"
                                   readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Laki-laki"
                                    @selected(old('jenis_kelamin', $profil->jenis_kelamin ?? '') == 'Laki-laki')>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    @selected(old('jenis_kelamin', $profil->jenis_kelamin ?? '') == 'Perempuan')>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                   name="tanggal_lahir"
                                   class="form-control"
                                   value="{{ old('tanggal_lahir', $profil->tanggal_lahir ?? '') }}">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Masukkan alamat lengkap">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Pendidikan dan Pengalaman --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-1">Pendidikan dan Pengalaman</h5>
                    <small class="text-muted">
                        Informasi latar belakang pendidikan dan pengalaman Anda.
                    </small>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text"
                                   name="pendidikan_terakhir"
                                   class="form-control"
                                   placeholder="Contoh: S1 Pendidikan"
                                   value="{{ old('pendidikan_terakhir', $profil->pendidikan_terakhir ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Instansi Pendidikan</label>
                            <input type="text"
                                   name="instansi_pendidikan"
                                   class="form-control"
                                   placeholder="Nama sekolah atau universitas"
                                   value="{{ old('instansi_pendidikan', $profil->instansi_pendidikan ?? '') }}">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Pengalaman Mengajar</label>
                            <textarea name="pengalaman_mengajar"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Ceritakan pengalaman mengajar Anda">{{ old('pengalaman_mengajar', $profil->pengalaman_mengajar ?? '') }}</textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi Diri</label>
                            <textarea name="deskripsi_diri"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Ceritakan tentang diri dan motivasi Anda menjadi relawan">{{ old('deskripsi_diri', $profil->deskripsi_diri ?? '') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Keahlian --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-1">Keahlian Mengajar</h5>
                    <small class="text-muted">
                        Pilih mata pelajaran yang dapat Anda ajarkan.
                    </small>
                </div>

                <div class="card-body">

                    @if($mataPelajaran->count() > 0)
                        <div class="row">
                            @foreach($mataPelajaran as $mapel)
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="mata_pelajaran_ids[]"
                                               value="{{ $mapel->id }}"
                                               id="mapel_{{ $mapel->id }}"
                                               @checked(in_array($mapel->id, old('mata_pelajaran_ids', $keahlianTerpilih)))>

                                        <label class="form-check-label"
                                               for="mapel_{{ $mapel->id }}">
                                            {{ $mapel->nama_mata_pelajaran }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Belum ada mata pelajaran yang tersedia.
                        </div>
                    @endif

                </div>
            </div>

            {{-- Dokumen --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-1">Dokumen Pendukung</h5>
                    <small class="text-muted">
                        Unggah dokumen identitas dan pendidikan jika tersedia.
                    </small>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Dokumen Identitas</label>
                        <input type="file"
                               name="dokumen_identitas"
                               class="form-control"
                               accept=".pdf,.jpg,.jpeg,.png">

                        <small class="text-muted">
                            Format PDF, JPG, JPEG, atau PNG. Maksimal 2 MB.
                        </small>

                        @if($profil && $profil->dokumen_identitas)
                            <div class="mt-2">
                                <a href="{{ asset('storage/'.$profil->dokumen_identitas) }}"
                                   target="_blank">
                                    Lihat dokumen identitas sebelumnya
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dokumen Pendidikan</label>
                        <input type="file"
                               name="dokumen_pendidikan"
                               class="form-control"
                               accept=".pdf,.jpg,.jpeg,.png">

                        <small class="text-muted">
                            Format PDF, JPG, JPEG, atau PNG. Maksimal 2 MB.
                        </small>

                        @if($profil && $profil->dokumen_pendidikan)
                            <div class="mt-2">
                                <a href="{{ asset('storage/'.$profil->dokumen_pendidikan) }}"
                                   target="_blank">
                                    Lihat dokumen pendidikan sebelumnya
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
