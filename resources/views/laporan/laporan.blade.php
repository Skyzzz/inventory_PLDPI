@extends('layout.main')

@section('laporan', 'active')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Cetak Laporan</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('cetak_laporan') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tgl_awal">Tanggal Awal</label>
                            <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror" id="tgl_awal" name="tgl_awal">
                            @error('tgl_awal')
                            <div class="invalid-feedback">Kolom tanggal awal wajib diisi.</div>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror" id="tgl_akhir" name="tgl_akhir">
                            @error('tgl_akhir')
                            <div class="invalid-feedback">Kolom tanggal akhir wajib diisi.</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="jenis_laporan">Jenis Laporan</label>
                            <select id="jenis_laporan" name="jenis_laporan" class="form-control @error('tgl_akhir') is-invalid @enderror">
                                <option disabled selected value="">Pilih Jenis Laporan...</option>
                                <option value="masuk">Laporan Barang Masuk</option>
                                <option value="keluar">Laporan Barang Keluar</option>
                            </select>
                        @error('jenis_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
