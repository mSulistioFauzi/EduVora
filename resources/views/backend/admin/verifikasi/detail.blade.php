@extends('backend.v_layouts.app')

@section('title', 'Detail Verifikasi Akun')

@section('judul_halaman', 'Detail Verifikasi Akun')
@section('deskripsi_halaman', 'Periksa informasi dan dokumen pendaftar sebelum menentukan status akun.')

@section('content')

    <div class="row g-4">

        {{-- Informasi akun --}}
        <div class="col-12">
            <div class="card border-light shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <h5 class="card-title mb-1">Informasi Akun</h5>
                        <p class="text-muted mb-0">Informasi dasar pengguna yang mendaftar.</p>
                    </div>

                    <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Lengkap</label>
                        <input type="text" class="form-control-custom" value="{{ $akun->name }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Email</label>
                        <input type="text" class="form-control-custom" value="{{ $akun->email }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Peran</label>
                        <input type="text" class="form-control-custom" value="{{ ucfirst($akun->peran) }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Tanggal Pendaftaran</label>
                        <input type="text" class="form-control-custom"
                            value="{{ $akun->created_at->format('d-m-Y H:i') }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profil relawan --}}
        @if ($akun->peran === 'relawan')
            @php $profil = $akun->profilRelawan; @endphp

            <div class="col-12">
                <div class="card border-light shadow-sm p-4">
                    <h5 class="card-title mb-4">Informasi Profil Relawan</h5>

                    @if ($profil)
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Jenis Kelamin</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->jenis_kelamin }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Tanggal Lahir</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->tanggal_lahir }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Pendidikan Terakhir</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->pendidikan_terakhir }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Instansi Pendidikan</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->instansi_pendidikan }}"
                                    readonly>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Alamat</label>
                                <textarea class="form-control-custom" rows="2" readonly>{{ $profil->alamat }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Pengalaman Mengajar</label>
                                <textarea class="form-control-custom" rows="3" readonly>{{ $profil->pengalaman_mengajar }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Deskripsi Diri</label>
                                <textarea class="form-control-custom" rows="3" readonly>{{ $profil->deskripsi_diri }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Keahlian Mata Pelajaran</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse ($profil->keahlian as $keahlian)
                                        <span class="badge bg-success">
                                            {{ $keahlian->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                        </span>
                                    @empty
                                        <span class="text-muted">Belum ada keahlian.</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Dokumen Identitas</label>
                                @if ($profil->dokumen_identitas)
                                    <a href="{{ Storage::url($profil->dokumen_identitas) }}" target="_blank"
                                        class="btn btn-outline-primary d-block">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Lihat Dokumen Identitas
                                    </a>
                                @else
                                    <p class="text-muted">Belum diunggah.</p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Dokumen Pendidikan</label>
                                @if ($profil->dokumen_pendidikan)
                                    <a href="{{ Storage::url($profil->dokumen_pendidikan) }}" target="_blank"
                                        class="btn btn-outline-primary d-block">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Lihat Dokumen Pendidikan
                                    </a>
                                @else
                                    <p class="text-muted">Belum diunggah.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Profil relawan belum dilengkapi.
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Profil mitra --}}
        @if ($akun->peran === 'mitra')
            @php $profil = $akun->profilMitra; @endphp

            <div class="col-12">
                <div class="card border-light shadow-sm p-4">
                    <h5 class="card-title mb-4">Informasi Profil Mitra</h5>

                    @if ($profil)
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Nama Organisasi</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->nama_organisasi }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Jabatan</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->jabatan }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Nomor Telepon</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->nomor_telepon }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Desa</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->desa }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Kecamatan</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->kecamatan }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Kabupaten</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->kabupaten }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Provinsi</label>
                                <input type="text" class="form-control-custom" value="{{ $profil->provinsi }}"
                                    readonly>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Alamat Wilayah</label>
                                <textarea class="form-control-custom" rows="2" readonly>{{ $profil->alamat_wilayah }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Dokumen Pendukung</label>
                                @if ($profil->dokumen_pendukung)
                                    <a href="{{ Storage::url($profil->dokumen_pendukung) }}" target="_blank"
                                        class="btn btn-outline-primary d-block">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Lihat Dokumen Pendukung
                                    </a>
                                @else
                                    <p class="text-muted">Belum diunggah.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Profil mitra belum dilengkapi.
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Form verifikasi --}}
        <div class="col-12">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-2">Keputusan Verifikasi</h5>
                <p class="text-muted mb-4">
                    Tentukan status akun berdasarkan hasil pemeriksaan informasi dan dokumen.
                </p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.verifikasi.perbarui', $akun->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="status_akun" class="form-label-custom">
                            Status Akun
                        </label>

                        <select name="status_akun" id="status_akun" class="form-select-custom" required>
                            <option value="terverifikasi" {{ $akun->status_akun === 'terverifikasi' ? 'selected' : '' }}>
                                Terverifikasi
                            </option>

                            <option value="perlu_perbaikan"
                                {{ $akun->status_akun === 'perlu_perbaikan' ? 'selected' : '' }}>
                                Perlu Perbaikan
                            </option>

                            <option value="ditolak" {{ $akun->status_akun === 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Simpan Keputusan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
