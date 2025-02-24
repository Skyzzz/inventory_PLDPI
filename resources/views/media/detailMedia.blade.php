@extends('layout.main')

@section('detail_media', 'active')

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
                <h4 class="mb-0 fw-bold"><i class="fa fa-envelope-open"></i> Detail Media</h4>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold text-dark"><i class="fa fa-file-alt text-primary"></i> Informasi Media</h5>
                        <hr>
                        <p class="fs-5 text-dark"><strong>Kode Media:</strong> {{ $media_detail->kode_media }}</p>
                        <p class="fs-5 text-dark"><strong>Nama Media:</strong> {{ $media_detail->nama_file }}</p>
                        <p class="fs-5 text-dark"><strong>Tipe Media:</strong> {{ $media_detail->tipe_file }}</p>
                        <p class="fs-5 text-dark"><strong>Ukuran Media:</strong> {{ number_format($media_detail->ukuran_file / 1048576, 2) }} MB</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-dark"><i class="fa fa-user text-primary"></i> Pengupload & Kategori</h5>
                        <hr>
                        <p class="fs-5 text-dark"><strong>Pengupload:</strong> {{ $media_detail->user->nama }}</p>
                        <p class="fs-5 text-dark"><strong>Kategori:</strong> {{ $media_detail->kategori }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="fw-bold text-dark"><i class="fa fa-paperclip text-primary"></i> File Media</h5>
                        <hr>
                        @if ($media_detail->path)
                            <a href="{{ asset('storage/' . $media_detail->path) }}" target="_blank" class="btn btn-outline-primary btn-lg">
                                <i class="fa fa-file"></i> Lihat File
                            </a>
                        @else
                            <p class="fs-5 text-muted">Tidak ada file tersedia</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/media') }}" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
