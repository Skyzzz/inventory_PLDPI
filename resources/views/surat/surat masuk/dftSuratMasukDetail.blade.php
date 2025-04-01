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
@if (auth()->user()->role == 'Admin')
<a href="/tbhSuratMasuk" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Surat Masuk</a>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong class="card-title">Daftar Surat Masuk</strong>
                <a href="/surat_masuk" class="btn btn-md btn-outline-primary">List Sederhana</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Surat</th>
                                <th>Nomor Surat</th>
                                <th>Nama Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>
                                <th>Kategori</th>
                                <th>Tanggal Terima</th>
                                <th>Diupload Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratMasuk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_surat }}</td>
                                <td>{{ $item->nomor_surat }}</td>
                                <td>{{ $item->nama_surat }}</td>
                                <td>{{ $item->tanggal_surat->format('d-m-Y') }}</td>
                                <td>{{ $item->pengirim }}</td>
                                <td>{{ $item->perihal }}</td>
                                <td>{{ $item->kategori_surat->kategori_surat }}</td>
                                <td>{{ $item->tanggal_terima->format('d-m-Y') }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>
                                    <a href="/edtSuratMasuk/{{ $item->id }}" class="btn btn-sm btn-success"data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ asset('storage/' . $item->file_surat) }}" class="btn btn-sm btn-primary" download data-bs-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                                    <!-- <a href="/hpsSuratMasuk/{{ $item->id }}" class="btn btn-sm btn-danger"data-bs-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a> -->
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{url('/hpsSuratMasuk', $item->id)}}"><i
                                    class="fa fa-trash"></i></a>
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
