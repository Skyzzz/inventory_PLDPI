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
                            <option value="Surat Keputusan" {{ old('kategori') == 'Surat Keputusan' ? 'selected' : '' }}>Surat Keputusan (SK)</option>
                            <option value="Laporan" {{ old('kategori') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                            <option value="Peraturan" {{ old('kategori') == 'Peraturan' ? 'selected' : '' }}>Peraturan</option>
                            <option value="Dokumen Administrasi" {{ old('kategori') == 'Dokumen Administrasi' ? 'selected' : '' }}>Dokumen Administrasi</option>
                            <option value="Rencana Kerja" {{ old('kategori') == 'Rencana Kerja' ? 'selected' : '' }}>Rencana Kerja</option>
                            <option value="Dokumen Keuangan" {{ old('kategori') == 'Dokumen Keuangan' ? 'selected' : '' }}>Dokumen Keuangan</option>
                            <option value="Data dan Statistik" {{ old('kategori') == 'Data dan Statistik' ? 'selected' : '' }}>Data dan Statistik</option>
                            <option value="Surat Permohonan" {{ old('kategori') == 'Surat Permohonan' ? 'selected' : '' }}>Surat Permohonan</option>
                            <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Penyuluhan dan Edukasi" {{ old('kategori') == 'Penyuluhan dan Edukasi' ? 'selected' : '' }}>Penyuluhan dan Edukasi</option>
                            <option value="Protokol" {{ old('kategori') == 'Protokol' ? 'selected' : '' }}>Protokol</option>
                            <option value="Kontrak dan Perjanjian" {{ old('kategori') == 'Kontrak dan Perjanjian' ? 'selected' : '' }}>Kontrak dan Perjanjian</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
