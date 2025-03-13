@extends('layouts.app')

@section('content')
    <div class="container mt-5"
        style="height: 70vh; display: flex; flex-direction: column; justify-content: center; background-color: #f0f0f0; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2>Télécharger votre fichier ici.</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="/convert-to-pdf" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Choisir un fichier (.doc, .docx, .xls, .xlsx, .ppt, .pptx,
                    .odt, .ods, .odp, .txt, .rtf, .html, .jpeg, .png, .jpg)</label>
                <input type="file" class="form-control" id="file" name="file" required
                    accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.odt,.ods,.odp,.txt,.rtf,.html,.jpeg,.png,.jpg">
            </div>
            @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Convertir</button>
        </form>
        <script>
            // Lorsque le formulaire est soumis, on le réinitialise après un délai
            document.getElementById('uploadForm').addEventListener('submit', function() {
                setTimeout(function() {
                    document.getElementById('uploadForm').reset(); // Réinitialiser le formulaire
                }, 500); // Attendre 500ms avant de réinitialiser (pour s'assurer que la soumission est terminée)
            });
        </script>
    </div>
@endsection
