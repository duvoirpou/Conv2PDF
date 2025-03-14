@extends('layouts.app')

@section('content')
    <h2>Compresser un PDF</h2>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('pdf.compress') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Choisir un fichier (.pdf)</label>
            <input type="file" class="form-control" name="pdf_file" required>
        </div>
        @error('file')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Compresser</button>
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
