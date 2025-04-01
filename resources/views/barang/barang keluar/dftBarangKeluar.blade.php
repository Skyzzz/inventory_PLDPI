@extends('layout.main')

@section('barang_keluar', 'active')

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
<a href="/tbhBarang_keluar" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Barang Keluar</a>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Barang Keluar</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Pegawai</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang_keluar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_bk }}</td>
                            <td>{{ $item->pegawai->nama_pegawai }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>
                                <!-- <a href="/edtBarangKeluar/{{ $item->id_barang }}" class="btn btn-sm btn-success"><i
                                        class="fa fa-pencil-square-o"></i></a> -->
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{url('/hpsBarang_keluar', $item->id_barang_keluar)}}"><i
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
@endsection

@section('table')
<script type="text/javascript">
    $(document).ready(function () {
        $('#bootstrap-data-table-export').DataTable();
    });

</script>
@endsection
