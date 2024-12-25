@extends('layout.main')

@section('surat_masuk', 'active')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Edit Surat Masuk</strong>
            </div>
            <div class="card-body">
                <form action="{{ url('/surat_masuk/' . $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Atur untuk mengirimkan request POST -->

                    <div class="form-group">
                        <label for="nomor_surat" class="form-control-label">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_surat" class="form-control-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $suratMasuk->tanggal_surat->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_terima" class="form-control-label">Tanggal Terima</label>
                        <input type="date" id="tanggal_terima" name="tanggal_terima" class="form-control" value="{{ old('tanggal_terima', $suratMasuk->tanggal_terima->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="pengirim" class="form-control-label">Pengirim</label>
                        <input type="text" id="pengirim" name="pengirim" class="form-control" value="{{ old('pengirim', $suratMasuk->pengirim) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="perihal" class="form-control-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal" class="form-control" value="{{ old('perihal', $suratMasuk->perihal) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control">
                            <option value="Surat Keputusan" {{ $suratMasuk->kategori == 'Surat Keputusan' ? 'selected' : '' }}>Surat Keputusan (SK)</option>
                            <option value="Laporan" {{ $suratMasuk->kategori == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                            <option value="Peraturan" {{ $suratMasuk->kategori == 'Peraturan' ? 'selected' : '' }}>Peraturan</option>
                            <option value="Dokumen Administrasi" {{ $suratMasuk->kategori == 'Dokumen Administrasi' ? 'selected' : '' }}>Dokumen Administrasi</option>
                            <option value="Rencana Kerja" {{ $suratMasuk->kategori == 'Rencana Kerja' ? 'selected' : '' }}>Rencana Kerja</option>
                            <option value="Dokumen Keuangan" {{ $suratMasuk->kategori == 'Dokumen Keuangan' ? 'selected' : '' }}>Dokumen Keuangan</option>
                            <option value="Data dan Statistik" {{ $suratMasuk->kategori == 'Data dan Statistik' ? 'selected' : '' }}>Data dan Statistik</option>
                            <option value="Surat Permohonan" {{ $suratMasuk->kategori == 'Surat Permohonan' ? 'selected' : '' }}>Surat Permohonan</option>
                            <option value="Pengumuman" {{ $suratMasuk->kategori == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Penyuluhan dan Edukasi" {{ $suratMasuk->kategori == 'Penyuluhan dan Edukasi' ? 'selected' : '' }}>Penyuluhan dan Edukasi</option>
                            <option value="Protokol" {{ $suratMasuk->kategori == 'Protokol' ? 'selected' : '' }}>Protokol</option>
                            <option value="Kontrak dan Perjanjian" {{ $suratMasuk->kategori == 'Kontrak dan Perjanjian' ? 'selected' : '' }}>Kontrak dan Perjanjian</option>
                            <option value="Lainnya" {{ $suratMasuk->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_surat" class="form-control-label">File Surat</label>
                        <input type="file" id="file_surat" name="file_surat" class="form-control">
                        @if ($suratMasuk->file_surat)
                            <small>Current file: <a href="{{ asset('storage/' . $suratMasuk->file_surat) }}" target="_blank">{{ $suratMasuk->file_surat }}</a></small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-control-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $suratMasuk->keterangan) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <a href="{{ url('/surat_masuk') }}" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
