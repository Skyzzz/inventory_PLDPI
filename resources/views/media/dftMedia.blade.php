@extends('layout.main')

@section('media', 'active')

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
    /* .card-header{
        background-color:rgb(179, 193, 255);
    } */
</style>
@if (auth()->user()->role == 'Admin')
<a href="/tbhMedia" class="btn btn-sm btn-primary mb-3 "><i class="fa fa-plus"></i> Tambah Media</a>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong class="card-title">Daftar Media</strong>
            <a href="/media_detail" class="btn btn-md btn-outline-primary">List Detail</a>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!-- <th>Kode Media</th> -->
                                <th>Nama File</th>
                                <!-- <th>Ukuran File</th> -->
                                <th>Kategori</th>
                                <!-- <th>Diupload Oleh</th>
                                <th>Tanggal Upload</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($media as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <!-- <td>{{ $item->kode_media }}</td> -->
                                <td>{{ Str::limit($item->nama_file, 70) }}</td>
                                <!-- <td>{{ number_format($item->ukuran_file / 1048576, 2) }} MB</td> -->
                                <td>{{ $item->kategori }}</td>
                                <!-- <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->created_at }}</td> -->
                                <td>
                                    <a href="{{ route('streamMedia', $item->id) }}" target="_blank" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Lihat"><i class="fa fa-eye"></i></a>
                                    <a href="{{ asset('storage/' . $item->path) }}" class="btn btn-sm btn-primary" download="{{ $item->nama_file }}" data-bs-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                                    <a href="/hpsMedia/{{ $item->id }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                                    <a href="/detailMedia/{{ $item->id }}" class="btn btn-sm btn-primary"data-bs-toggle="tooltip" title="Detail"><i class="fa fa-info-circle"></i></a>  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('table')
<script type="text/javascript">
    $(document).ready(function () {
        $('#bootstrap-data-table').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
