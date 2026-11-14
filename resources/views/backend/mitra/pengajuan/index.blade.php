@extends('backend.v_layouts.app')

@section('title', 'Pengajuan Bantuan')

@section('judul_halaman', 'Pengajuan Bantuan')
@section('deskripsi_halaman', 'Lihat dan pantau pengajuan bantuan pendidikan Anda.')

@section('content')

    <div class="card border-light shadow-sm p-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h5 class="card-title mb-1">Daftar Pengajuan</h5>
                <p class="text-muted mb-0">
                    Daftar pengajuan bantuan yang telah Anda kirim.
                </p>
            </div>

            <a href="{{ route('mitra.pengajuan.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i>
                Buat Pengajuan
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Pengajuan</th>
                        <th>Jumlah Anak</th>
                        <th>Jenjang</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengajuan as $item)
                        <tr>
                            <td>{{ $pengajuan->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="table-product-name">
                                    {{ $item->judul_pengajuan }}
                                </div>
                            </td>

                            <td>{{ $item->jumlah_anak }} anak</td>

                            <td>{{ $item->jenjang_pendidikan }}</td>

                            <td>{{ $item->created_at->format('d-m-Y') }}</td>

                            <td>
                                @if ($item->status_pengajuan === 'disetujui')
                                    <span class="badge-table success">Disetujui</span>
                                @elseif ($item->status_pengajuan === 'ditolak')
                                    <span class="badge-table failed">Ditolak</span>
                                @else
                                    <span class="badge-table pending">Menunggu</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('mitra.pengajuan.detail', $item->id) }}" class="table-btn-action"
                                    title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 text-muted"></i>
                                <p class="text-muted mb-0 mt-2">
                                    Belum ada pengajuan bantuan.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
            <small class="text-muted">
                Menampilkan {{ $pengajuan->firstItem() ?? 0 }}
                sampai {{ $pengajuan->lastItem() ?? 0 }}
                dari {{ $pengajuan->total() }} pengajuan
            </small>

            {{ $pengajuan->links() }}
        </div>

    </div>

@endsection
