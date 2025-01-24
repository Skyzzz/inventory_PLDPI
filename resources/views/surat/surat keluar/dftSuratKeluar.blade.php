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
            <div class="card-header">
                <strong class="card-title">Daftar Surat Keluar</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Surat</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>
                                <th>Tanggal Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKeluar as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_surat }}</td>
                                <td>{{ $item->nomor_surat }}</td>
                                <td>{{ $item->tanggal_surat->format('d-m-Y') }}</td>
                                <td>{{ $item->pengirim }}</td>
                                <td>{{ $item->perihal }}</td>
                                <td>{{ $item->tanggal_keluar->format('d-m-Y') }}</td>
                                <td>
                                    <a href="/edtSuratKeluar/{{ $item->id }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="/hpsSuratKeluar/{{ $item->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                    <a href="{{ asset('storage/uploads/media/' . $item->nama_file) }}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> Unduh</a>
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
