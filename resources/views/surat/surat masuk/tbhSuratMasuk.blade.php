@extends('layout.main')

@section('surat', 'active')

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
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}" required>
                        @if ($errors->has('nomor_surat'))
                            <div class="alert alert-danger">
                                {{ $errors->first('nomor_surat') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tanggal_surat" class="form-control-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat') }}" required>
                        @if ($errors->has('tanggal_surat'))
                            <div class="alert alert-danger">
                                {{ $errors->first('tanggal_surat') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tanggal_terima" class="form-control-label">Tanggal Terima</label>
                        <input type="date" id="tanggal_terima" name="tanggal_terima" class="form-control" value="{{ old('tanggal_terima') }}" required>
                        @if ($errors->has('tanggal_terima'))
                            <div class="alert alert-danger">
                                {{ $errors->first('tanggal_terima') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="pengirim" class="form-control-label">Pengirim</label>
                        <input type="text" id="pengirim" name="pengirim" class="form-control" value="{{ old('pengirim') }}" required>
                        @if ($errors->has('pengirim'))
                            <div class="alert alert-danger">
                                {{ $errors->first('pengirim') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="perihal" class="form-control-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal" class="form-control" value="{{ old('perihal') }}" required>
                        @if ($errors->has('perihal'))
                            <div class="alert alert-danger">
                                {{ $errors->first('perihal') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control" onchange="updateKategoriID()">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori_surat as $kategori)
                                <option value="{{ $kategori->kategori_surat }}" data-id="{{ $kategori->id_kategori_surat }}">
                                    {{ $kategori->kategori_surat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="kategori_surat_id" name="kategori_surat_id">

                    <div class="form-group">
                        <label for="file_surat" class="form-control-label">File Surat</label>
                        <input type="file" id="file_surat" name="file_surat" class="form-control" required>
                        @if ($errors->has('file_surat'))
                            <div class="alert alert-danger">
                                {{ $errors->first('file_surat') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-control-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" rows="4"></textarea>
                        @if ($errors->has('keterangan'))
                            <div class="alert alert-danger">
                                {{ $errors->first('keterangan') }}
                            </div>
                        @endif
                    </div>


                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
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
        var kategoriID = selectedOption.getAttribute("data-id"); // Ambil ID dari atribut data-id
        document.getElementById("kategori_surat_id").value = kategoriID; // Masukkan ke hidden input
    }
</script>

@endsection
