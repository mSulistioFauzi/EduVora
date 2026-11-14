@extends('backend.v_layouts.app')

@section('title', 'Program Mengajar')

@section('judul_halaman', 'Program Mengajar')
@section('deskripsi_halaman', 'Temukan program mengajar yang tersedia dan sesuai dengan keahlian Anda.')

@section('content')

    <div class="row g-4">
        @forelse ($program as $item)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-light shadow-sm h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-success-subtle text-success">
                                Program Dibuka
                            </span>

                            <span class="badge bg-light text-dark">
                                {{ $item->jenjang_pendidikan }}
                            </span>
                        </div>

                        <h5 class="fw-bold mb-2">
                            {{ $item->nama_program }}
                        </h5>

                        <p class="text-muted mb-3">
                            {{ Str::limit($item->deskripsi_program ?? 'Belum ada deskripsi program.', 100) }}
                        </p>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-book me-2 text-success"></i>
                                <span>{{ $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}</span>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-geo-alt me-2 text-success"></i>
                                <span>{{ $item->lokasi }}</span>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-event me-2 text-success"></i>
                                <span>{{ $item->tanggal_mulai->format('d M Y') }}</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="bi bi-people me-2 text-success"></i>
                                <span>Kuota: {{ $item->kuota_relawan }} relawan</span>
                            </div>
                        </div>

                        <a href="{{ route('relawan.program.show', $item->id) }}" class="btn btn-success w-100">
                            Lihat Detail
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-light shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-journal-x text-muted" style="font-size: 3rem;"></i>

                        <h5 class="fw-bold mt-3">Belum Ada Program</h5>

                        <p class="text-muted mb-0">
                            Saat ini belum ada program mengajar yang dibuka oleh Admin.
                            Silakan periksa kembali nanti.
                        </p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $program->links() }}
    </div>

@endsection
