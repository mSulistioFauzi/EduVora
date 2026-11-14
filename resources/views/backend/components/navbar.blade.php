<header class="navbar-custom">
            <div class="navbar-left">
                {{-- Tombol sidebar desktop --}}
                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
                    <i class="bi bi-chevron-bar-left"></i>
                </button>

                {{-- Tombol sidebar mobile --}}
                <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            {{-- SEARCH --}}
            <div class="navbar-search-wrapper">
                <input type="text" class="navbar-search-input" placeholder="Cari sesuatu..." id="main-search">
                <button class="navbar-search-btn" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            {{-- NAVBAR KANAN --}}
            <div class="navbar-actions">
                {{-- FULLSCREEN --}}
                <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                {{-- PROFIL DROPDOWN --}}
                <div class="dropdown ms-2">
                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="profile-dropdown">
                        <img src="{{ asset('spark-admin/assets/images/avatar.png') }}" alt="Profile Image"
                            class="navbar-profile-img">
                        <span class="navbar-profile-name d-none d-md-inline">
                            {{ auth()->user()->name }}
                        </span>
                        <i class="bi bi-chevron-down navbar-profile-caret"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">
                        <li class="dropdown-header">
                            {{ auth()->user()->name }}
                        </li>
                        <li>
                            <span class="dropdown-item-text">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
