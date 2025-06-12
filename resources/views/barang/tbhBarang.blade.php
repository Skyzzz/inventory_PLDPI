@extends('layout.main')

@section('barang_masuk', 'active')

@section('content')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let hargaInput = document.getElementById("harga_ambil");

    hargaInput.addEventListener("input", function (e) {
        let value = e.target.value.replace(/\D/g, ""); // Hanya angka
        let formattedValue = new Intl.NumberFormat("id-ID").format(value);
        e.target.value = value ? "Rp" + formattedValue : ""; // Tambahkan "Rp"
    });
});
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Barang</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('tbhBarang') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $kode_b }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pemasok_id">Supplier</label>
                            <select id="pemasok_id" name="pemasok_id" class="form-control @error('pemasok_id') is-invalid @enderror">
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->id_pemasok }}" {{ old('pemasok_id') == $item->id_pemasok ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pemasok_id')
                                <div class="invalid-feedback">Supplier wajib dipilih</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kategori_id">Kategori</label>
                        <select id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}" {{ old('kategori_id') == $item->id_kategori ? 'selected' : '' }}>
                                    {{ $item->kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">Kolom kategori wajib diisi.</div>
                        @enderror
                    </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">Kolom nama barang wajib diisi.</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="satuan">Satuan</label>
                            <input type="text" name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror" placeholder="misal: pcs, box, pack" value="{{ old('satuan') }}">
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="harga_ambil">Harga Beli</label>
                            <input type="text" class="form-control @error('harga_ambil') is-invalid @enderror" 
                                id="harga_ambil" name="harga_ambil" 
                                value="{{ old('harga_ambil') }}" placeholder="Rp0">
                            @error('harga_ambil')
                                <div class="invalid-feedback">Kolom harga beli wajib diisi.</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-4 ml-2">
                            <label for="gambar" class="form-label">Gambar Promosi</label>
                            <img class="lihat-gambar img-fluid mb-3 col-sm-5">
                            <input class="form-control @error('gambar') is-invalid @enderror" type="file" onchange="tampilGambar()" name="gambar" id="gambar" value="{{ old('gambar') }}" >
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <a href="/barang" class="btn btn-sm btn-danger">Kembali</a>
                </form>
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

@section('lihat-gambar')
<script>
    function tampilGambar() {
        const image = document.querySelector('#gambar');
        const lihatImg = document.querySelector('.lihat-gambar');

        lihatImg.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            lihatImg.src = oFREvent.target.result;
        }
    }
</script>
@endsection
