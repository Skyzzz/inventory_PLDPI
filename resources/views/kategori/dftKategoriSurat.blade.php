@extends('layout.main')

@section('kategori_surat', 'active')

@section('content')

<style>
    .card {
        border-radius: 20px;
    }

    .btn {
        border-radius: 5px;
    }

    .table {
        border-radius: 10px;
    }
</style>

<a data-toggle="modal" data-target="#tambah" href="#" class="btn btn-primary btn-sm mb-3">
    <i class="fa fa-plus"></i> Tambah Kategori Surat
</a>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Kategori Surat</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kategori Surat</th>
                            <th>Nama Kategori Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoriSurat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_kategori_surat }}</td>
                            <td>{{ $item->kategori_surat }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edit{{ $item->id_kategori_surat }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{ url('/hpsKategoriSurat', $item->id_kategori_surat) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori Surat -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel"><b>Tambah Kategori Surat</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tbhKategoriSurat" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_kategori_surat" class="form-label">Kode Kategori Surat</label>
                        <input type="text" class="form-control" id="kode_kategori_surat" name="kode_kategori_surat" 
                               value="{{ old('kode_kategori_surat', $kode_ks ?? '') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_surat" class="form-label">Nama Kategori Surat</label>
                        <input type="text" class="form-control" 
                               id="kategori_surat" name="kategori_surat" 
                               value="{{ old('kategori_surat') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori Surat -->
@foreach ($kategoriSurat as $item)
<div class="modal fade" id="edit{{ $item->id_kategori_surat }}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel"><b>Edit Kategori Surat</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/edtKategoriSurat/{{ $item->id_kategori_surat }}" method="POST">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_kategori_surat" class="form-label">Kode Kategori Surat</label>
                        <input type="text" class="form-control" id="kode_kategori_surat" name="kode_kategori_surat" value="{{ $item->kode_kategori_surat }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_surat" class="form-label">Nama Kategori Surat</label>
                        <input type="text" class="form-control" id="kategori_surat" name="kategori_surat" value="{{ $item->kategori_surat }}">
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
            title: 'Gagal Menambahkan Kategori Surat',
            text: '{{ $errors->first("kategori_surat") }}'
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
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menghapus!',
            text: '{{ session("error") }}',
            showConfirmButton: true,
        });
    });
</script>
@endif

@endsection

@section('table')
<script type="text/javascript">
    $(document).ready(function () {
        $('#bootstrap-data-table').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
