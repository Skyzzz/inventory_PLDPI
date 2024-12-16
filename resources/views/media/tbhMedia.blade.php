@extends('layout.main')

@section('media', 'active')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tambah Media</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('tbhMedia') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file" class="form-control-label">File Media</label>
                        <input type="file" id="file" name="file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control">
                        <option value="Surat Keputusan">Surat Keputusan (SK)</option>
                        <option value="Laporan">Laporan</option>
                        <option value="Peraturan">Peraturan</option>
                        <option value="Dokumen Administrasi">Dokumen Administrasi</option>
                        <option value="Rencana Kerja">Rencana Kerja</option>
                        <option value="Dokumen Keuangan">Dokumen Keuangan</option>
                        <option value="Data dan Statistik">Data dan Statistik</option>
                        <option value="Surat Permohonan">Surat Permohonan</option>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Penyuluhan dan Edukasi">Penyuluhan dan Edukasi</option>
                        <option value="Protokol">Protokol</option>
                        <option value="Kontrak dan Perjanjian">Kontrak dan Perjanjian</option>
                        <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    <a href="/media" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
