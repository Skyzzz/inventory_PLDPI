@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h4>Preview PDF: {{ $media->nama_file }}</h4>
    <div id="pdf-viewer" style="width: 100%; height: 600px;"></div>
    <br>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
    var url = "{{ asset('storage/' . $media->path) }}";

    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function(pdf) {
        pdf.getPage(1).then(function(page) {
            var scale = 1.5;
            var viewport = page.getViewport({ scale: scale });

            var canvas = document.createElement("canvas");
            var context = canvas.getContext("2d");
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            document.getElementById("pdf-viewer").appendChild(canvas);

            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext);
        });
    });
</script>
@endsection
