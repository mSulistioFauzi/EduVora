@extends('backend.v_layouts.app')

@section('title', 'Tambah Program')
@section('judul_halaman', 'Tambah Program Mengajar')
@section('deskripsi_halaman', 'Buat program mengajar berdasarkan kebutuhan pendidikan.')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-light shadow-sm p-4">

        <form action="{{ route('admin.program.store') }}" method="POST">
            @csrf

            <h5 class="mb-4">Informasi Program</h5>

            <div class="mb-3">
                <label class="form-label-custom">Pengajuan Bantuan</label>

                <select name="pengajuan_id" id="pengajuan_id" class="form-select form-select-custom">
                    <option value="">Program tanpa pengajuan bantuan</option>

                    @foreach ($pengajuan as $item)
                        <option value="{{ $item->id }}" data-judul="{{ $item->judul_pengajuan }}"
                            data-deskripsi="{{ $item->deskripsi_kondisi }}" data-jenjang="{{ $item->jenjang_pendidikan }}"
                            @selected(old('pengajuan_id') == $item->id)>
                            {{ $item->judul_pengajuan }}
                        </option>
                    @endforeach
                </select>

                <small class="text-muted">
                    Pilih pengajuan yang telah disetujui jika program berasal dari pengajuan Mitra.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Nama Program</label>
                <input type="text" name="nama_program" id="nama_program" class="form-control form-control-custom"
                    value="{{ old('nama_program') }}" placeholder="Contoh: Program Bimbingan Belajar SD" required>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Deskripsi Program</label>
                <textarea name="deskripsi_program" id="deskripsi_program" class="form-control form-control-custom" rows="4"
                    placeholder="Jelaskan kegiatan program mengajar...">{{ old('deskripsi_program') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Mata Pelajaran</label>
                <select name="mata_pelajaran_id" class="form-select form-select-custom" required>
                    <option value="">Pilih Mata Pelajaran</option>

                    @foreach ($mataPelajaran as $mapel)
                        <option value="{{ $mapel->id }}" @selected(old('mata_pelajaran_id') == $mapel->id)>
                            {{ $mapel->nama_mata_pelajaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Lokasi Mengajar</label>
                <textarea name="lokasi" class="form-control form-control-custom" rows="2"
                    placeholder="Masukkan alamat lokasi mengajar..." required>{{ old('lokasi') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Jenjang Pendidikan</label>
                <select name="jenjang_pendidikan" id="jenjang_pendidikan" class="form-select form-select-custom" required>
                    @foreach (['PAUD', 'TK', 'SD', 'SMP', 'SMA/SMK', 'Umum'] as $jenjang)
                        <option value="{{ $jenjang }}" @selected(old('jenjang_pendidikan', 'SD') == $jenjang)>
                            {{ $jenjang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Kuota Relawan</label>
                <input type="number" name="kuota_relawan" class="form-control form-control-custom"
                    value="{{ old('kuota_relawan', 1) }}" min="1" required>
            </div>

            <hr class="my-4">

            <h5 class="mb-4">Jadwal Program</h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label-custom">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control form-control-custom"
                        value="{{ old('tanggal_mulai') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control form-control-custom"
                        value="{{ old('tanggal_selesai') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control form-control-custom"
                        value="{{ old('jam_mulai') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control form-control-custom"
                        value="{{ old('jam_selesai') }}">
                </div>
            </div>

            <div class="mb-4 mt-4">
                <label class="form-label-custom">Status Program</label>
                <select name="status_program" class="form-select form-select-custom" required>
                    <option value="draf" @selected(old('status_program', 'draf') == 'draf')>
                        Draf
                    </option>
                    <option value="dibuka" @selected(old('status_program') == 'dibuka')>
                        Dibuka
                    </option>
                </select>
                <small class="text-muted">
                    Pilih Dibuka jika program sudah siap menerima pendaftaran relawan.
                </small>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.program.index') }}" class="btn btn-light">
                    Batal
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>
                    Simpan Program
                </button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')
    <script>
        const pilihPengajuan = document.getElementById('pengajuan_id');

        pilihPengajuan.addEventListener('change', function() {
            const pilihan = this.options[this.selectedIndex];

            if (this.value !== '') {
                document.getElementById('nama_program').value =
                    pilihan.dataset.judul || '';

                document.getElementById('deskripsi_program').value =
                    pilihan.dataset.deskripsi || '';

                document.getElementById('jenjang_pendidikan').value =
                    pilihan.dataset.jenjang || 'SD';
            }
        });
    </script>
@endpush
