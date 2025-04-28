@extends('layout.main')

@section('barang_masuk', 'active')

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

<a href="/tbhBarang_masuk" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Barang Masuk</a>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Barang Masuk</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kategori</th>
                                <th>Supplier</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total Pengeluaran</th>
                                <th>Tanggal Masuk</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang_masuk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kategori->kategori }}</td>
                                <td>{{ $item->pemasok->nama }}</td>
                                <td>{{ $item->barang->nama }}</td>
                                <td>Rp. {{ number_format($item->harga) }}</td>
                                <td>{{ number_format($item->jumlah) }} {{ $item->satuan }}</td>
                                <td>Rp. {{ number_format($item->tot_pengeluaran) }}</td>
                                <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                <td>
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{url('/hpsBarang_masuk', $item->id_barang_masuk)}}"><i
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
