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
<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        var kategori = document.getElementById("kategori");
        if (kategori.value === "-- Pilih Kategori --") {
            alert("Silakan pilih kategori sebelum mengirim formulir!");
            event.preventDefault(); // Mencegah pengiriman formulir
        }
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tambah Surat Masuk</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('tbhSuratMasuk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- <div class="form-group">
                        <label for="nama_surat" class="form-control-label">Nama Surat</label>
                        <input type="text" id="nama_surat" name="nama_surat" class="form-control" value="{{ old('nama_surat') }}" required>
                        @if ($errors->has('nama_surat'))
                            <div class="alert alert-danger">
                                {{ $errors->first('nama_surat') }}
                            </div>
                        @endif
                    </div> -->

                    <div class="form-group">
                        <label for="nomor_surat" class="form-control-label">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat') }}">
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_surat" class="form-control-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat') }}">
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_terima" class="form-control-label">Tanggal Terima</label>
                        <input type="date" id="tanggal_terima" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror" value="{{ old('tanggal_terima') }}">
                        @error('tanggal_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pengirim" class="form-control-label">Pengirim</label>
                        <input type="text" id="pengirim" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror" value="{{ old('pengirim') }}">
                        @error('pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="perihal" class="form-control-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}">
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control @error('kategori_surat_id') is-invalid @enderror" onchange="updateKategoriID()">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori_surat as $kategori)
                                <option value="{{ $kategori->kategori_surat }}" data-id="{{ $kategori->id_kategori_surat }}" {{ old('kategori') == $kategori->kategori_surat ? 'selected' : '' }}>
                                    {{ $kategori->kategori_surat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_surat_id')
                            <div class="invalid-feedback">Kolom kategori wajib diisi.</div>
                        @enderror
                    </div>
                    <input type="hidden" id="kategori_surat_id" name="kategori_surat_id" value="{{ old('kategori_surat_id') }}">

                    <div class="form-group">
                        <label for="file_surat" class="form-control-label">File Surat</label>
                        <input type="file" id="file_surat" name="file_surat" class="form-control @error('file_surat') is-invalid @enderror">
                        @error('file_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-control-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="4"></textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="/surat_masuk" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function updateKategoriID() {
        var select = document.getElementById("kategori");
        var selectedOption = select.options[select.selectedIndex]; 
        var kategoriID = selectedOption.getAttribute("data-id"); 
        
        if (kategoriID) {
            document.getElementById("kategori_surat_id").value = kategoriID; 
        } else {
            document.getElementById("kategori_surat_id").value = ""; // Pastikan tidak ada nilai kosong
        }
    }
</script>

@endsection
