@extends('layout.main')

@section('pegawai', 'active')

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
    <div class="col-lg">
        <div class="card">
            <div class="card-header"><b>Tambah Pegawai</b></div>
            <div class="card-body card-block">
                <form method="POST" action="{{ route('tbhPegawai') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="kode_pegawai" class="form-label">Kode Pegawai</label>
                        <input type="text" class="form-control" id="kode_pegawai" name="kode_pegawai"
                            value="{{ $kode_pegawai }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="id_personal_pegawai" class="form-label">ID Pegawai</label>
                        <input type="text" class="form-control @error('id_personal_pegawai') is-invalid @enderror" 
                            id="id_personal_pegawai" name="id_personal_pegawai" value="{{ old('id_personal_pegawai') }}">
                        @error('nama_pegawai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" 
                            id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai') }}">
                        @error('nama_pegawai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
                            <option disabled selected>-- Pilih Jabatan --</option>
                            <option value="Manager" {{ old('jabatan') == 'Manager' ? 'selected' : '' }}>Manager</option>
                            <option value="Supervisor" {{ old('jabatan') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="Staff" {{ old('jabatan') == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="Admin" {{ old('jabatan') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="HRD" {{ old('jabatan') == 'HRD' ? 'selected' : '' }}>HRD</option>
                        </select>
                        @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telp" class="form-label">No. Hp</label>
                        <input type="telp" class="form-control @error('telp') is-invalid @enderror" 
                            id="telp" name="telp" value="{{ old('telp') }}">
                        @error('telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="/pegawai" class="btn btn-sm btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
