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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Barang Masuk</strong>
            </div>
            <div class="card-body card-block">
                <form action="/tbhBarang_masuk" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kode_bm">Kode Barang Masuk</label>
                            <input type="text" class="form-control @error('kode_bm') is-invalid @enderror" 
                                id="kode_bm" name="kode_bm" value="{{ old('kode_bm', $kode_bm) }}" readonly>
                            @error('kode_bm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="supplier">Supplier</label>
                            <select id="supplier" class="form-control @error('supplier') is-invalid @enderror" name="supplier" onchange="supplier_id()">
                                <option disabled selected>Pilih Supplier...</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->id_pemasok }}" {{ old('supplier', $id ?? '') == $item->id_pemasok ? 'selected' : '' }}> {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tgl_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" 
                                id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk') }}">
                            @error('tgl_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if (isset($produk))
                    <hr>
                    <div class="form-row">
                        <div class="table-responsive">
                            <table id="barang" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="hidden" name="satuan[]" value="{{ $item->satuan }}">
                                            <input type="hidden" name="nama[]" value="{{ $item->nama }}">
                                            {{ $item->nama }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="harga_ambil[]" value="{{ $item->harga_ambil }}">
                                            Rp. {{ number_format($item->harga_ambil) }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="id_barang[]" value="{{ $item->id_barang }}">
                                            <input type="hidden" name="kategori_id[]" value="{{ $item->kategori_id }}">
                                            <input class="form-control @error('jumlah.' . $loop->index) is-invalid @enderror" 
                                                name="jumlah[]" type="number" min="0" value="{{ old('jumlah.' . $loop->index, 0) }}">
                                            @error('jumlah.' . $loop->index)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    @endif
                    <button type="submit" class="btn btn-sm btn-primary">Top Up Barang</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('lihat-barang')
<script type="text/javascript">
    $(document).ready(function () {
        $('#barang').DataTable();
    });

    function supplier_id() {
        var id_pemasok = document.getElementById("supplier").value;
        var url = "{{ url('list') }}" + '/' + id_pemasok;
        window.location.href = url;

    }

</script>
@endsection
