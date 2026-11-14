@extends('backend.v_layouts.app')

@section('title', 'Program Mengajar')
@section('judul_halaman', 'Program Mengajar')
@section('deskripsi_halaman', 'Kelola seluruh program mengajar EduRelawan.')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-light shadow-sm p-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h5 class="mb-1">Daftar Program Mengajar</h5>
                <p class="text-muted mb-0">Program yang telah dibuat oleh admin.</p>
            </div>

            <a href="{{ route('admin.program.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Program
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Program</th>
                        <th>Mata Pelajaran</th>
                        <th>Lokasi</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($program as $item)
                        <tr>
                            <td>{{ $program->firstItem() + $loop->index }}</td>

                            <td>
                                <strong>{{ $item->nama_program }}</strong>
                            </td>

                            <td>
                                {{ $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                            </td>

                            <td>{{ $item->lokasi }}</td>

                            <td>{{ $item->kuota_relawan }} relawan</td>

                            <td>
                                @if ($item->status_program == 'dibuka')
                                    <span class="badge-table success">Dibuka</span>
                                @elseif($item->status_program == 'draf')
                                    <span class="badge-table pending">Draf</span>
                                @elseif($item->status_program == 'selesai')
                                    <span class="badge-table success">Selesai</span>
                                @else
                                    <span class="badge-table failed">
                                        {{ ucfirst($item->status_program) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.program.show', $item->id) }}" class="table-btn-action" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada program mengajar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $program->links() }}
        </div>

    </div>

@endsection
