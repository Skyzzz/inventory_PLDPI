<style>
    /* Sidebar */
    .left-panel {
        background: #ffffff;
        width: 280px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .navbar-brand {
        padding: 1.2rem 1.5rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #f1f3f5;
    }

    .navbar-brand img {
        height: 40px;
        transition: transform 0.3s ease;
    }

    .navbar-brand b {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        color:rgb(250, 250, 250);
        font-size: 1.4rem;
        margin-left: 12px;
    }

    .nav.navbar-nav {
        padding: 1rem 0.5rem;
        width: 100%;
    }

    .menu-title {
        color: #95a5a6;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.5rem 1.5rem 0.5rem;
        margin: 0;
    }

    .nav-link {
        color: #2d3436;
        padding: 0.8rem 1.5rem;
        margin: 4px 0.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .nav-link:hover {
        background: #f8f9fa;
        transform: translateX(4px);
    }

    .nav-link.active {
        background: #f1f3ff;
        color: #4a6cf7;
        font-weight: 500;
    }

    .menu-icon {
        width: 24px;
        margin-right: 14px;
        font-size: 1.1rem;
        color: #747d8c;
    }

    /* Dropdown */
    .dropdown-menu {
        border: none;
        box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.05);
        margin-left: 1rem;
        border-radius: 12px;
    }

    .dropdown-item {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
        color: #2d3436;
        border-radius: 6px;
        margin: 2px 0;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
    }

    .dropdown-toggle::after {
        margin-left: auto;
        color: #b2bec3;
        transition: transform 0.2s ease;
    }

    .dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(90deg);
    }

    /* Responsive */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
        margin-right: 1rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }
</style>

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/kantor.png') }}" alt="Logo">
                <b>INVENTORI</b>
            </a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@yield('dashboard')">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="menu-icon fa fa-dashboard"></i>
                        Dashboard
                    </a>
                </li>

                @if (auth()->user()->role == 'Admin')
                <li class="@yield('user')">
                    <a href="{{ url('/user') }}" class="nav-link">
                        <i class="menu-icon fa fa-user"></i>
                        Daftar User
                    </a>
                </li>
                <li class="@yield('pegawai')">
                    <a href="{{ url('/pegawai') }}" class="nav-link">
                        <i class="menu-icon fa fa-users"></i>
                        Daftar Pegawai
                    </a>
                </li>
                <li class="@yield('pemasok')">
                    <a href="{{ url('/pemasok') }}" class="nav-link">
                        <i class="menu-icon fa fa-truck"></i>
                        Supplier
                    </a>
                </li>

                <h3 class="menu-title">Daftar Barang</h3>
                <li class="@yield('kategori')">
                    <a href="{{ url('/kategori') }}" class="nav-link">
                        <i class="menu-icon fa fa-suitcase"></i>
                        Kategori Barang
                    </a>
                </li>
                <li class="@yield('barang')">
                    <a href="{{ url('/barang') }}" class="nav-link">
                        <i class="menu-icon fa fa-cube"></i>
                        Daftar Barang
                    </a>
                </li>
                @endif
                <li class="menu-item-has-children dropdown @yield('barang_masuk')">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="menu-icon fa fa-arrow-down"></i>
                        Barang Masuk
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        @if (auth()->user()->role == 'Admin')
                        <li>
                            <a href="{{ url('/tbhBarang_masuk') }}" class="dropdown-item">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Pembelian
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('/barang_masuk') }}" class="dropdown-item">
                                <i class="fa fa-list"></i>
                                Riwayat Transaksi
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown @yield('barang_keluar')">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="menu-icon fa fa-arrow-up"></i>
                        Barang Keluar
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        @if (auth()->user()->role == 'Admin')
                        <li>
                            <a href="{{ url('/tbhBarang_keluar') }}" class="dropdown-item">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Barang
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('/barang_keluar') }}" class="dropdown-item">
                                <i class="fa fa-list"></i>
                                Riwayat Distribusi
                            </a>
                        </li>
                    </ul>
                </li>

                <h3 class="menu-title">Manajemen Media</h3>
                <li class="@yield('kategori')">
                    <a href="{{ url('/kategori_media') }}" class="nav-link">
                        <i class="menu-icon fa fa-folder-open"></i>
                        Kategori Media
                    </a>
                </li>
                <li class="@yield('media')">
                    <a href="{{ url('/media') }}" class="nav-link">
                        <i class="menu-icon fa fa-folder"></i>
                        Arsip Media
                    </a>
                </li>

                <h3 class="menu-title">Manajemen Surat</h3>
                <li class="@yield('kategori')">
                    <a href="{{ url('/kategori_surat') }}" class="nav-link">
                        <i class="menu-icon fa fa-tags"></i>
                        Kategori Surat
                    </a>
                </li>
                <li class="@yield('surat')">
                    <a href="{{ url('/surat_masuk') }}" class="nav-link">
                        <i class="menu-icon fa fa-envelope"></i>
                        Surat Masuk
                    </a>
                </li>
                <li class="@yield('surat')">
                    <a href="{{ url('/surat_keluar') }}" class="nav-link">
                        <i class="menu-icon fa fa-paper-plane"></i>
                        Surat Keluar
                    </a>
                </li>

                @if (auth()->user()->role == 'Admin')
                <h3 class="menu-title">Laporan</h3>
                <li class="@yield('laporan')">
                    <a href="{{ url('/laporan') }}" class="nav-link">
                        <i class="menu-icon fa fa-print"></i>
                        Cetak Laporan
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</aside>