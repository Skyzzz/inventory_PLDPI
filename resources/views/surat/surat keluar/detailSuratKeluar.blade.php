@extends('layout.main')

@section('detail_surat_keluar', 'active')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg h-100 w-100">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold"><i class="fa fa-envelope-open"></i> Detail Surat Keluar</h4>
                <!-- <a href="{{ url('/surat_keluar') }}" class="btn btn-light btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a> -->
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold text-dark"><i class="fa fa-file-alt text-primary"></i> Informasi Surat</h5>
                        <hr>
                        <p class="fs-5 text-dark "><strong>Kode Surat:</strong> {{ $suratKeluar->kode_surat }}</p>
                        <p class="fs-5 text-dark "><strong>Nama Surat:</strong> {{ $suratKeluar->nama_surat }}</p>
                        <p class="fs-5 text-dark"><strong>Nomor Surat:</strong> {{ $suratKeluar->nomor_surat }}</p>
                        <p class="fs-5 text-dark"><strong>Tanggal Surat:</strong> {{ $suratKeluar->tanggal_surat->format('d-m-Y') }}</p>
                        <p class="fs-5 text-dark"><strong>Tanggal Terima:</strong> {{ $suratKeluar->tanggal_keluar->format('d-m-Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-dark"><i class="fa fa-user text-primary"></i> Pengirim & Kategori</h5>
                        <hr>
                        <p class="fs-5 text-dark"><strong>Pengirim:</strong> {{ $suratKeluar->pengirim }}</p>
                        <p class="fs-5 text-dark"><strong>Perihal:</strong> {{ $suratKeluar->perihal }}</p>
                        <p class="fs-5 text-dark"><strong>Kategori:</strong> {{ $selectedKategori }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="fw-bold text-dark"><i class="fa fa-paperclip text-primary"></i> File Surat</h5>
                        <hr>
                        @if ($suratKeluar->file_surat)
                            <a href="{{ asset('storage/' . $suratKeluar->file_surat) }}" target="_blank" class="btn btn-outline-primary btn-lg">
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
                        <p class="fs-5 text-justify">{{ $suratKeluar->keterangan ?? 'Tidak ada keterangan' }}</p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/surat_keluar') }}" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
