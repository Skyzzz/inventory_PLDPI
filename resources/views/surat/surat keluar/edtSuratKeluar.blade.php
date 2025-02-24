@extends('layout.main')

@section('surat_keluar', 'active')

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
                <strong class="card-title">Edit Surat Keluar</strong>
            </div>
            <div class="card-body">
                <form action="{{ url('/surat_keluar/' . $suratKeluar->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Atur untuk mengirimkan request POST -->

                    <div class="form-group">
                        <label for="nama_surat" class="form-control-label">Nama Surat</label>
                        <input type="text" id="nama_surat" name="nama_surat" class="form-control" value="{{ old('nama_surat', $suratKeluar->nama_surat) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nomor_surat" class="form-control-label">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_surat" class="form-control-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_keluar" class="form-control-label">Tanggal Keluar</label>
                        <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar', $suratKeluar->tanggal_keluar->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="pengirim" class="form-control-label">Pengirim</label>
                        <input type="text" id="pengirim" name="pengirim" class="form-control" value="{{ old('pengirim', $suratKeluar->pengirim) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="perihal" class="form-control-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal" class="form-control" value="{{ old('perihal', $suratKeluar->perihal) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori_surat as $kategori)
                                <option value="{{ $kategori->kategori_surat }}" {{ old('kategori') == $kategori->kategori_surat ? 'selected' : '' }}>
                                    {{ $kategori->kategori_surat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_surat" class="form-control-label">File Surat</label>
                        <input type="file" id="file_surat" name="file_surat" class="form-control">
                        @if ($suratKeluar->file_surat)
                            <small>Current file: <a href="{{ asset('storage/' . $suratKeluar->file_surat) }}" target="_blank">{{ $suratKeluar->file_surat }}</a></small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-control-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $suratKeluar->keterangan) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <a href="{{ url('/surat_keluar') }}" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
