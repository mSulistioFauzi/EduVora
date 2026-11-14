
@extends('backend.v_layouts.app')

@section('title', 'Verifikasi Akun')

@section('judul_halaman', 'Verifikasi Akun')

@section('deskripsi_halaman', 'Kelola dan periksa akun Relawan serta Mitra yang terdaftar.')

@section('content')

<div class="table-card-custom">

    {{-- Header Tabel --}}
    <div class="table-header-control">

        {{-- Pencarian dan Filter --}}
        <form action="{{ route('admin.verifikasi.index') }}" method="GET"
            class="d-flex flex-wrap gap-2 align-items-center">

            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text"
                    name="cari"
                    class="table-search-input"
                    placeholder="Cari nama atau email..."
                    value="{{ request('cari') }}">
            </div>

            <select name="status" class="form-select" style="width: auto;">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                    Menunggu
                </option>
                <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>
                    Terverifikasi
                </option>
                <option value="perlu_perbaikan" {{ request('status') == 'perlu_perbaikan' ? 'selected' : '' }}>
                    Perlu Perbaikan
                </option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                    Ditolak
                </option>
            </select>

            <button type="submit" class="btn-table-action">
                <i class="bi bi-funnel"></i> Filter
            </button>

            <a href="{{ route('admin.verifikasi.index') }}" class="btn-table-action text-decoration-none">
                Reset
            </a>

        </form>

    </div>

    {{-- Tabel Data --}}
    <div class="table-responsive">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                    <th>Status Akun</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($akun as $item)

                    <tr>
                        <td>
                            {{ $akun->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <div class="table-user-cell">
                                <img
                                    src="{{ asset('spark-admin/assets/images/avatar.png') }}"
                                    alt="Avatar"
                                    class="table-user-avatar">

                                <div>
                                    <div class="table-user-name">
                                        {{ $item->name }}
                                    </div>

                                    <div class="table-user-sub">
                                        {{ $item->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if ($item->role == 'relawan')
                                <span class="badge-table success">Relawan</span>
                            @else
                                <span class="badge-table pending">Mitra</span>
                            @endif
                        </td>

                        <td>
                            {{ $item->created_at->format('d M Y') }}
                        </td>

                        <td>
                            @if ($item->status_akun == 'terverifikasi')
                                <span class="badge-table success">
                                    Terverifikasi
                                </span>
                            @elseif ($item->status_akun == 'menunggu')
                                <span class="badge-table pending">
                                    Menunggu
                                </span>
                            @elseif ($item->status_akun == 'perlu_perbaikan')
                                <span class="badge-table pending">
                                    Perlu Perbaikan
                                </span>
                            @else
                                <span class="badge-table failed">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.verifikasi.detail', $item->id) }}" class="table-btn-action" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada akun yang ditemukan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="table-footer-control">

        <span class="table-pagination-info">
            Menampilkan {{ $akun->firstItem() ?? 0 }}
            sampai {{ $akun->lastItem() ?? 0 }}
            dari {{ $akun->total() }} akun
        </span>

        <div>
            {{ $akun->links() }}
        </div>

    </div>

</div>

@endsection
