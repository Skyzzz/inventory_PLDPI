@extends('layout.main')

@section('barang', 'active')

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

<a href="/tbhBarang" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Barang</a>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Barang</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Beli</th>
                                <th>Gambar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->kategori->kategori }}</td>
                                <td>{{ $item->pemasok->nama }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ number_format($item->jumlah) }} {{ $item->satuan }}</td>
                                <td>Rp. {{ number_format($item->harga_ambil) }}</td>
                                <td><img src="{{ asset('Image/'.$item->gambar) }}" alt="" width="50" height="50"></td>
                                <td>
                                    <a href="/edtBarang/{{ $item->id_barang }}" data-bs-toggle="tooltip" title="Edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{url('/hpsBarang', $item->id_barang)}}"><i
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
        $('#bootstrap-data-table-export').DataTable();
    });

</script>
@endsection
