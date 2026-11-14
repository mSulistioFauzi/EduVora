{{-- SIDEBAR --}}
<div class="sidebar-wrapper" id="sidebar">

    <a href="#" class="sidebar-brand">
        <i class="bi bi-asterisk"></i>
        <span>EduRelawan</span>
    </a>

    <div class="flex-grow-1 overflow-y-auto">
        {{-- MENU UMUM --}}
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menu Utama</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    @if (auth()->user()->peran === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        @elseif (auth()->user()->peran === 'relawan')
                            <a href="{{ route('relawan.dashboard') }}"
                                class="sidebar-menu-link {{ request()->routeIs('relawan.dashboard') ? 'active' : '' }}">
                            @else
                                <a href="{{ route('mitra.dashboard') }}"
                                    class="sidebar-menu-link {{ request()->routeIs('mitra.dashboard') ? 'active' : '' }}">
                    @endif
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- MENU ADMIN --}}
        @if (auth()->user()->peran === 'admin')
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Menu Admin</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-people"></i>
                            <span>Data Pengguna</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.verifikasi.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-person-check"></i>
                            <span>Verifikasi Akun</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.pengajuan.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-clipboard-check"></i>
                            <span>Pengajuan Bantuan</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.program.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-book"></i>
                            <span>Program Mengajar</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Laporan Kegiatan</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        {{-- MENU RELAWAN --}}
        @if (auth()->user()->peran === 'relawan')
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Menu Relawan</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('relawan.profil') }}" class="sidebar-menu-link">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href={{ route('relawan.program.index') }}#" class="sidebar-menu-link">
                            <i class="bi bi-journal-bookmark"></i>
                            <span>Program Mengajar</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-pencil-square"></i>
                            <span>Pendaftaran Saya</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat Kegiatan</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        {{-- MENU MITRA --}}
        @if (auth()->user()->peran === 'mitra')
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Menu Mitra</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('mitra.profil') }}" class="sidebar-menu-link">
                            <i class="bi bi-building"></i>
                            <span>Profil Organisasi</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('mitra.pengajuan.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-file-earmark-plus"></i>
                            <span>Pengajuan Bantuan</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-clipboard-data"></i>
                            <span>Status Pengajuan</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>

    {{-- PROFIL PENGGUNA DI SIDEBAR --}}
    <div class="sidebar-profile">
        <img src="{{ asset('spark-admin/assets/images/avatar.png') }}" alt="Foto Profil" class="sidebar-profile-img">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                {{ auth()->user()->name }}
            </div>
            <div class="sidebar-profile-email">
                {{ auth()->user()->email }}
            </div>
        </div>
    </div>
</div>
