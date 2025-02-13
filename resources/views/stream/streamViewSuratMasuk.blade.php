@extends('layout.main')

@section('surat_masuk', 'active')

@section('content')

<style>
    #pdf-frame {
        width: 100%;
        height: calc(100vh - 100px);
        border: 1px solid #ccc;
    }
</style>

<div class="container-fluid mt-4">
    <h4>Preview PDF: {{ $surat_masuk->nama_surat }}</h4>
    <br>
    <iframe id="pdf-frame" src="{{ asset('storage/' . $surat_masuk->file_surat) }}"></iframe>
    <br>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

<script>
    function adjustIframeHeight() {
        document.getElementById("pdf-frame").style.height = (window.innerHeight - 100) + "px";
    }

    window.addEventListener("resize", adjustIframeHeight);
    window.addEventListener("load", adjustIframeHeight);
</script>
@endsection