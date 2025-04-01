@extends('layout.main')

@section('surat_masuk', 'active')

@section('content')

<style>
    .card {
        border-radius: 20px;
    }

    .btn {
        border-radius: 5px;
    }

    .table {
        border-radius: 10px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Edit Surat Masuk</strong>
            </div>
            <div class="card-body">
                <form action="{{ url('/surat_masuk/' . $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_surat" class="form-control-label">Nama Surat</label>
                        <input type="text" id="nama_surat" name="nama_surat" class="form-control @error('nama_surat') is-invalid @enderror" value="{{ old('nama_surat', $suratMasuk->nama_surat) }}">
                        @error('nama_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nomor_surat" class="form-control-label">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}">
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_surat" class="form-control-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat', $suratMasuk->tanggal_surat->format('Y-m-d')) }}">
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_terima" class="form-control-label">Tanggal Terima</label>
                        <input type="date" id="tanggal_terima" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror" value="{{ old('tanggal_terima', $suratMasuk->tanggal_terima->format('Y-m-d')) }}">
                        @error('tanggal_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pengirim" class="form-control-label">Pengirim</label>
                        <input type="text" id="pengirim" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror" value="{{ old('pengirim', $suratMasuk->pengirim) }}">
                        @error('pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="perihal" class="form-control-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal', $suratMasuk->perihal) }}">
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori_surat_id" class="form-control @error('kategori_surat_id') is-invalid @enderror">
                            <option value="" disabled> --Pilih Kategori-- </option>
                            @foreach ($kategori_surat as $kategori)
                                <option value="{{ $kategori->id_kategori_surat }}" 
                                    {{ old('kategori_surat_id', $suratMasuk->kategori_surat_id) == $kategori->id_kategori_surat ? 'selected' : '' }}>
                                    {{ $kategori->kategori_surat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_surat_id')
                            <div class="invalid-feedback">Kolom kategori wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file_surat" class="form-control-label">File Surat</label>
                        <input type="file" id="file_surat" name="file_surat" class="form-control @error('file_surat') is-invalid @enderror">
                        @if ($suratMasuk->file_surat)
                            <small>File saat ini: <a href="{{ asset('storage/' . $suratMasuk->file_surat) }}" target="_blank">{{ $suratMasuk->file_surat }}</a></small>
                        @endif
                        @error('file_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-control-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $suratMasuk->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                    <a href="{{ url('/surat_masuk') }}" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
