@extends('layout.main')

@section('surat', 'active')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tambah Surat Keluar</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('tbhSuratKeluar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                        <label for="tanggal_keluar" class="form-control-label">Tanggal keluar</label>
                        <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar') }}" required>
                        @if ($errors->has('tanggal_keluar'))
                            <div class="alert alert-danger">
                                {{ $errors->first('tanggal_keluar') }}
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
                        <input type="file" id="file_surat" name="file_surat" class="form-control" required>
                        @if ($errors->has('file_surat'))
                            <div class="alert alert-danger">
                                {{ $errors->first('file_surat') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    <a href="/surat_keluar" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
