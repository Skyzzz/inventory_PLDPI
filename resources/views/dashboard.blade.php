@extends('layout.main')

@section('dashboard', 'active')

@section('content')

<style>
    /* Efek hover untuk card */
    .hover-effect {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Membuat ikon lebih menarik */
    .rounded-circle {
        border-radius: 50%;
    }

    /* Menghilangkan garis bawah pada link */
    .text-decoration-none {
        text-decoration: none;
    }

    .category-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 1rem;
    color: #333;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    display: inline-block;
    }       

    .category-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .category-title:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    .card{
        border-radius: 20px;
    }
</style>

<div>
    <div class="col-12">
        <div class="category-title">PENGGUNA</div>
    </div>
    <!-- Card Total Barang -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/user') }}" class="text-decoration-none">
                    <i class="fa fa-users bg-info p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-info mb-0 pt-2">{{ $users }} User</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total User</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->

    <!-- Card Total Barang Masuk -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/pegawai') }}" class="text-decoration-none">
                    <i class="fa fa-id-badge bg-danger p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-danger mb-0 pt-2">{{ $pegawai }} Pegawai</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Pegawai</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->

    <!-- Card Total Barang Keluar -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/pemasok') }}" class="text-decoration-none">
                    <i class="fa fa-truck bg-primary p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-primary mb-0 pt-2">{{ $pemasok }} Pemasok</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Pemasok</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>

<div>
    <div class="col-12">
        <div class="category-title">DATA BARANG</div>
    </div>
    <!-- Card Total Barang -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/barang') }}" class="text-decoration-none">
                    <i class="fa fa-briefcase bg-info p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-info mb-0 pt-2">{{ $barang }} Barang</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Barang</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->

    <!-- Card Total Barang Masuk -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/barang_masuk') }}" class="text-decoration-none">
                    <i class="fa fa-shopping-cart bg-danger p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-danger mb-0 pt-2">{{ $barang_masuk }} Barang</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Barang Masuk</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->

    <!-- Card Total Barang Keluar -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/barang_keluar') }}" class="text-decoration-none">
                    <i class="fa fa-dropbox bg-primary p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-primary mb-0 pt-2">{{ $barang_keluar }} Barang</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Barang Keluar</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>

<div>
    <div class="col-12">
        <div class="category-title">DATA FILE DAN SURAT</div>
    </div>
    <!-- Card Total Barang -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/media') }}" class="text-decoration-none">
                    <i class="fa fa-file bg-info p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-info mb-0 pt-2">{{ $media }} File</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total File</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->

    <!-- Card Total Barang Masuk -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/surat_masuk') }}" class="text-decoration-none">
                    <i class="fa fa-envelope-open bg-danger p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-danger mb-0 pt-2">{{ $surat_masuk }} Surat</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Surat Masuk</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->

    <!-- Card Total Barang Keluar -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm hover-effect" role="button" tabindex="0">
            <div class="card-body p-4 clearfix">
                <a href="{{ url('/surat_keluar') }}" class="text-decoration-none">
                    <i class="fa fa-paper-plane bg-primary p-4 font-2xl mr-3 float-left text-light rounded-circle" aria-hidden="true"></i>
                    <div class="h5 text-primary mb-0 pt-2">{{ $surat_keluar }} Surat</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Surat Keluar</div>
                </a>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>

@endsection