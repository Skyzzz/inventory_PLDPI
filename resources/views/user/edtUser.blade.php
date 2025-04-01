@extends('layout.main')

@section('user', 'active')

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
            <div class="card-header"><b>Edit User</b></div>
            <div class="card-body card-block">
                @foreach ($user as $item)
                <form method="POST" action="/edtUser/{{ $item->id_user }}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id_user }}">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" value="{{ old('nama', $item->nama) }}" name="nama">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" value="{{ old('email', $item->email) }}" name="email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">User Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="Admin" {{ old('role', $item->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                    <a href="/user" class="btn btn-sm btn-danger">Kembali</a>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
