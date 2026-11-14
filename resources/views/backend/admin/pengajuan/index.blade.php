@extends('backend.v_layouts.app')

@section('title', 'Pengajuan Bantuan')
@section('judul_halaman', 'Pengajuan Bantuan')
@section('deskripsi_halaman', 'Kelola dan periksa pengajuan bantuan dari Mitra.')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-light shadow-sm p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <h5 class="mb-0">Daftar Pengajuan</h5>

            <form action="{{ route('admin.pengajuan.index') }}" method="GET">
                <select name="status" class="form-select form-select-custom" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Pengajuan</th>
                        <th>Nama Mitra</th>
                        <th>Jumlah Anak</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan as $item)
                        <tr>
                            <td>{{ $pengajuan->firstItem() + $loop->index }}</td>
                            <td>{{ $item->judul_pengajuan }}</td>
                            <td>{{ $item->profilMitra->user->name ?? '-' }}</td>
                            <td>{{ $item->jumlah_anak }}</td>
                            <td>
                                @if ($item->status_pengajuan == 'menunggu')
                                    <span class="badge-table pending">Menunggu</span>
                                @elseif($item->status_pengajuan == 'disetujui')
                                    <span class="badge-table success">Disetujui</span>
                                @else
                                    <span class="badge-table failed">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pengajuan.detail', $item->id) }}" class="table-btn-action" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada pengajuan bantuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $pengajuan->links() }}
        </div>
    </div>

@endsection
