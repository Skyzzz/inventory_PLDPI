<style>
    /* Efek hover untuk sidebar */
    .left-panel .navbar-nav li a {
        transition: all 0.3s ease-in-out;
        color: #ffffff;
    }

    .left-panel .navbar-nav li a:hover {
        background-color: #007bff; /* Warna latar belakang saat hover */
        color: #ffffff; /* Warna teks saat hover */
        padding-left: 15px; /* Sedikit pergeseran ke kanan untuk efek dinamis */
    }

    .left-panel .navbar-nav li.active a {
        background-color: #0056b3; /* Warna khusus untuk menu aktif */
        color: #ffffff;
    }
</style>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/dashboard') }}"><img style=" height: 45px;" class="mr-2"
                    src="{{ asset('images/kantor.png') }}" alt=""><b class="mr-4">INVENTORI</b></a>
            <a class="navbar-brand hidden" href="{{ url('/dashboard') }}"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@yield('dashboard')">
                    <a href="{{ url('/dashboard') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                @if (auth()->user()->role == 'Admin')
                <li class="@yield('user')">
                    <a href="{{ url('/user') }}"> <i class="menu-icon fa fa-user"></i>Daftar User</a>
                </li>
                <li class="@yield('pegawai')">
                    <a href="{{ url('/pegawai') }}"> <i class="menu-icon fa fa-users"></i>Daftar Pegawai</a>
                </li>
                <li class="@yield('pemasok')">
                    <a href="{{ url('/pemasok') }}"> <i class="menu-icon fa fa-truck"></i>Daftar Supplier</a>
                </li>
                <!-- /.menu-title -->
                <h3 class="menu-title">Data Barang</h3><!-- /.menu-title -->
                <li class="@yield('kategori')">
                    <a href="{{ url('/kategori') }}"> <i class="menu-icon fa fa-folder-open"></i>Daftar Kategori</a>
                </li>
                <li class="@yield('barang')">
                    <a href="{{ url('/barang') }}"> <i class="menu-icon fa fa-suitcase"></i>Daftar Barang</a>
                </li>
                @endif
                <li class="menu-item-has-children dropdown @yield('barang_masuk')">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-download"></i>Barang Masuk</a>
                    <ul class="sub-menu children dropdown-menu">
                        @if (auth()->user()->role == 'Admin')
                        <li><i class="menu-icon fa fa-plus"></i><a href="{{ url('/tbhBarang_masuk') }}">Tambah
                                Pembelian</a></li>
                        @endif
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="{{ url('/barang_masuk') }}">Daftar Barang
                                Masuk</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown @yield('barang_keluar')">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-upload"></i>Barang Keluar</a>
                    <ul class="sub-menu children dropdown-menu">
                        @if (auth()->user()->role == 'Admin')
                        <li><i class="menu-icon fa fa-plus"></i><a href="{{ url('/tbhBarang_keluar') }}">Tambah
                                Barang</a></li>
                        @endif
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="{{ url('/barang_keluar') }}">Daftar Barang
                                Keluar</a>
                        </li>
                    </ul>
                </li>
                <h3 class="menu-title">Data Media</h3><!-- /.menu-title -->
                <li class="@yield('kategori')">
                    <a href="{{ url('/kategori_media') }}"> <i class="menu-icon fa fa-folder-open"></i>Daftar Kategori Media</a>
                </li>
                <li class="@yield('media')">
                    <a href="{{ url('/media') }}"> <i class="menu-icon fa fa-folder"></i>Daftar File</a>
                </li>
                <h3 class="menu-title">Data Surat</h3><!-- /.menu-title -->
                <li class="@yield('kategori')">
                    <a href="{{ url('/kategori_surat') }}"> <i class="menu-icon fa fa-folder-open"></i>Daftar Kategori Surat</a>
                </li>
                <li class="@yield('surat')">
                    <a href="{{ url('/surat_masuk') }}"> <i class="menu-icon fa fa-download"></i>Surat Masuk</a>
                </li>
                <li class="@yield('surat')">
                    <a href="{{ url('/surat_keluar') }}"> <i class="menu-icon fa fa-paper-plane"></i>Surat Keluar</a>
                </li>
                <h3 class="menu-title">Laporan</h3><!-- /.menu-title -->
                @if (auth()->user()->role == 'Admin')
                <li class="@yield('laporan')">
                    <a href="{{ url('/laporan') }}"><i class="menu-icon fa fa-print"></i> Cetak Laporan</a>
                </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
