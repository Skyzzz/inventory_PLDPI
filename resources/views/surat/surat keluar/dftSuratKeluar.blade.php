@extends('layout.main')

@section('surat', 'active')

@section('content')

<style>
    /* div.dataTables_wrapper {
        width: 980px;
        margin: 0 auto;
    } */
</style>
@if (auth()->user()->role == 'Admin')
<a href="/tbhSuratKeluar" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Surat Keluar</a>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong class="card-title">Daftar Surat Keluar</strong>
                <a href="/surat_masuk_detail" class="btn btn-md btn-outline-primary">List Detail</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!-- <th>Kode Surat</th>
                                <th>Nomor Surat</th> -->
                                <th>Nama Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Pengirim</th>
                                <!-- <th>Perihal</th> -->
                                <th>Tanggal Keluar</th>
                                <th>Diupload Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKeluar as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <!-- <td>{{ $item->kode_surat }}</td>
                                <td>{{ $item->nomor_surat }}</td> -->
                                <td>{{ $item->nama_surat }}</td>
                                <td>{{ $item->tanggal_surat->format('d-m-Y') }}</td>
                                <td>{{ $item->pengirim }}</td>
                                <!-- <td>{{ $item->perihal }}</td> -->
                                <td>{{ $item->tanggal_keluar->format('d-m-Y') }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>
                                    <a href="/edtSuratKeluar/{{ $item->id }}" class="btn btn-sm btn-success"data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ asset('storage/' . $item->file_surat) }}" class="btn btn-sm btn-primary" download data-bs-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                                    <a href="/hpsSuratKeluar/{{ $item->id }}" class="btn btn-sm btn-danger"data-bs-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                                    <a href="/detailSuratKeluar/{{ $item->id }}" class="btn btn-sm btn-primary"data-bs-toggle="tooltip" title="Detail"><i class="fa fa-info-circle"></i></a>
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
