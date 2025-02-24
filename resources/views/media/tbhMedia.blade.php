@extends('layout.main')

@section('media', 'active')

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
                        @if ($errors->has('file'))
                            <div class="alert alert-danger">
                                {{ $errors->first('file') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="form-control-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control" onchange="updateKategoriID()">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach ($kategoriMedia as $kategori)
                                <option value="{{ $kategori->kategori_media }}" data-id="{{ $kategori->id_kategori_media }}">
                                    {{ $kategori->kategori_media }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Hidden input untuk menyimpan ID kategori -->
                    <input type="hidden" id="kategori_media_id" name="kategori_media_id">

                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    <a href="/media" class="btn btn-sm btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function updateKategoriID() {
        var select = document.getElementById("kategori");
        var selectedOption = select.options[select.selectedIndex]; 
        var kategoriID = selectedOption.getAttribute("data-id"); // Ambil ID dari atribut data-id
        document.getElementById("kategori_media_id").value = kategoriID; // Masukkan ke hidden input
    }
</script>


@endsection
