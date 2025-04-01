@extends('layout.main')

@section('kategori', 'active')

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
    .invalid-feedback {
        display: block;
    }
</style>

<a data-toggle="modal" data-target="#tambah" href="#" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i>
    Tambah Kategori</a>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Kategori</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_kategori }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>
                                <a data-toggle="modal" data-bs-toggle="tooltip" title="Edit" 
                                   data-target="#edit{{ $item->id_kategori }}" 
                                   class="btn btn-sm btn-success">
                                   <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a href="/hpsKategori/{{ $item->id_kategori }}" 
                                   onclick="confirmation(event)" 
                                   data-bs-toggle="tooltip" 
                                   title="Hapus" 
                                   class="btn btn-sm btn-danger">
                                   <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel"><b>Tambah Kategori</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tbhKategori" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_kategori" class="form-label">Kode Kategori</label>
                        <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" 
                            id="kode_kategori" name="kode_kategori" 
                            value="{{ old('kode_kategori', $kode_kt) }}" readonly>
                        @error('kode_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" 
                            value="{{ old('kategori') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
@foreach ($kategori as $item)
<div class="modal fade" id="edit{{ $item->id_kategori }}" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel"><b>Edit Kategori</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/edtKategori/{{ $item->id_kategori }}" method="POST">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kode Kategori</label>
                        <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                            value="{{ $item->kode_kategori }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori"
                            value="{{ $item->kategori }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Edit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menambahkan Kategori',
            text: '{{ $errors->first("kategori") }}'
        });
    });
</script>
@endif

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: true,
            // timer: 2000
        });
    });
</script>
@endif

@endsection

@section('table')
<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari...",
            }
        });
    });
</script>
@endsection