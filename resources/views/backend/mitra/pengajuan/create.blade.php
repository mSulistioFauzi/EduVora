@extends('backend.v_layouts.app')

@section('title', 'Buat Pengajuan Bantuan')

@section('judul_halaman', 'Buat Pengajuan Bantuan')
@section('deskripsi_halaman', 'Sampaikan kebutuhan pendidikan yang ada di wilayah atau organisasi Anda.')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card border-light shadow-sm p-4">

                <div class="mb-4">
                    <h5 class="card-title mb-1">Formulir Pengajuan Bantuan</h5>
                    <p class="text-muted mb-0">
                        Isi informasi sesuai kondisi pendidikan yang sebenarnya.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali formulir Anda:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mitra.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-custom">Judul Pengajuan</label>
                        <input type="text" name="judul_pengajuan" class="form-control-custom"
                            value="{{ old('judul_pengajuan') }}" placeholder="Contoh: Kebutuhan Relawan Pengajar Matematika"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Deskripsi Kondisi Pendidikan</label>
                        <textarea name="deskripsi_kondisi" class="form-control-custom" rows="5"
                            placeholder="Jelaskan kondisi pendidikan dan bantuan yang dibutuhkan..." required>{{ old('deskripsi_kondisi') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Jumlah Anak</label>
                            <input type="number" name="jumlah_anak" class="form-control-custom" min="1"
                                value="{{ old('jumlah_anak') }}" placeholder="Jumlah anak yang membutuhkan bantuan"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan" class="form-select-custom" required>
                                <option value="">Pilih Jenjang Pendidikan</option>
                                @foreach (['PAUD', 'SD', 'SMP', 'SMA/SMK', 'Lainnya'] as $jenjang)
                                    <option value="{{ $jenjang }}"
                                        {{ old('jenjang_pendidikan') == $jenjang ? 'selected' : '' }}>
                                        {{ $jenjang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Fasilitas yang Tersedia</label>
                        <textarea name="fasilitas_tersedia" class="form-control-custom" rows="3"
                            placeholder="Contoh: Ruang kelas, papan tulis, meja, dan kursi">{{ old('fasilitas_tersedia') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Waktu yang Diharapkan</label>
                        <input type="text" name="waktu_yang_diharapkan" class="form-control-custom"
                            value="{{ old('waktu_yang_diharapkan') }}" placeholder="Contoh: Senin dan Rabu, pukul 13.00">
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Foto Pendukung</label>
                        <input type="file" name="foto_pendukung" class="form-control-custom" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">
                            Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                        </small>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('mitra.pengajuan.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-send me-1"></i>
                            Kirim Pengajuan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
