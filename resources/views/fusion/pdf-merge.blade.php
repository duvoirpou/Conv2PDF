@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Fusionner des fichiers PDF</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('merge.pdf') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <div class="mb-3">
            <input type="file" class="form-control" name="pdf_files[]" multiple required accept=".pdf">
        </div>
        <button type="submit" class="btn btn-primary">Fusionner</button>
    </form>
    <script>
        // Lorsque le formulaire est soumis, on le réinitialise après un délai
        document.getElementById('uploadForm').addEventListener('submit', function() {
            setTimeout(function() {
                document.getElementById('uploadForm').reset(); // Réinitialiser le formulaire
            }, 500); // Attendre 500ms avant de réinitialiser (pour s'assurer que la soumission est terminée)
        });
    </script>
@endsection
