@extends('layout.main')

@section('media', 'active')

@section('content')

<style>
    /* div.dataTables_wrapper {
        width: 980px;
        margin: 0 auto;
    } */
</style>
@if (auth()->user()->role == 'Admin')
<a href="/tbhMedia" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Media</a>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Media</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Media</th>
                                <th>Nama File</th>
                                <th>Ukuran File</th>
                                <th>Kategori</th>
                                <th>Diupload Oleh</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($media as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_media }}</td>
                                <td>{{ $item->nama_file }}</td>
                                <td>{{ number_format($item->ukuran_file / 1048576, 2) }} MB</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->uploaded_by }}</td>
                                <td>{{ $item->tanggal_upload }}</td>
                                <td>
                                    <a href="{{ asset('storage/uploads/media/' . $item->nama_file) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"></i></a>
                                    <a href="{{ asset('storage/uploads/media/' . $item->id) }}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i></a>
                                    <a href="/hpsMedia/{{ $item->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>  
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
</script>
@endsection
