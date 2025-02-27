@extends('layout.main')

@section('surat_masuk', 'active')

@section('content')

<style>
    .card{
        border-radius: 20px;
     }

    .btn{
        border-radius: 5px;
    }
    .table{
        border-radius: 10px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg h-100 w-100">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold"><i class="fa fa-envelope-open"></i> Detail Surat Masuk</h4>
                <!-- <a href="{{ url('/surat_masuk') }}" class="btn btn-light btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a> -->
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold text-dark"><i class="fa fa-file-alt text-primary"></i> Informasi Surat</h5>
                        <hr>
                        <p class="fs-5 text-dark "><strong>Kode Surat:</strong> {{ $suratMasuk->kode_surat }}</p>
                        <p class="fs-5 text-dark "><strong>Nama Surat:</strong> {{ $suratMasuk->nama_surat }}</p>
                        <p class="fs-5 text-dark"><strong>Nomor Surat:</strong> {{ $suratMasuk->nomor_surat }}</p>
                        <p class="fs-5 text-dark"><strong>Tanggal Surat:</strong> {{ $suratMasuk->tanggal_surat->format('d-m-Y') }}</p>
                        <p class="fs-5 text-dark"><strong>Tanggal Terima:</strong> {{ $suratMasuk->tanggal_terima->format('d-m-Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-dark"><i class="fa fa-user text-primary"></i> Pengirim & Kategori</h5>
                        <hr>
                        <p class="fs-5 text-dark"><strong>Pengirim:</strong> {{ $suratMasuk->pengirim }}</p>
                        <p class="fs-5 text-dark"><strong>Perihal:</strong> {{ $suratMasuk->perihal }}</p>
                        <p class="fs-5 text-dark"><strong>Kategori:</strong> {{ $selectedKategori }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="fw-bold text-dark"><i class="fa fa-paperclip text-primary"></i> File Surat</h5>
                        <hr>
                        @if ($suratMasuk->file_surat)
                            <a href="{{ asset('storage/' . $suratMasuk->file_surat) }}" target="_blank" class="btn btn-outline-primary btn-lg">
                                <i class="fa fa-file"></i> Lihat File
                            </a>
                        @else
                            <p class="fs-5 text-muted">Tidak ada file tersedia</p>
                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="fw-bold text-dark"><i class="fa fa-sticky-note text-primary"></i> Keterangan</h5>
                        <hr>
                        <p class="fs-5 text-justify">{{ $suratMasuk->keterangan ?? 'Tidak ada keterangan' }}</p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/surat_masuk') }}" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
