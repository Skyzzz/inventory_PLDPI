@extends('layout.main')

@section('pemasok', 'active')

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
            <div class="card-header"><b>Edit Supplier</b></div>
            <div class="card-body card-block">
                @foreach ($pemasok as $item)
                <form method="POST" action="/edtPemasok/{{ $item->id_pemasok }}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id_pemasok }}">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama', $item->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                               id="alamat" name="alamat" value="{{ old('alamat', $item->alamat) }}">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $item->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                               id="telepon" name="telepon" value="{{ old('telepon', $item->telepon) }}">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                    <a href="/pemasok" class="btn btn-sm btn-danger">Kembali</a>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
