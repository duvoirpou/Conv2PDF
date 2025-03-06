<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion de fichier en PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Convertir un fichier en PDF
        </h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="/convert-to-pdf" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Choisir un fichier (.doc, .docx, .xls, .xlsx, .ppt, .pptx,
                    .odt, .ods, .odp, .txt, .rtf, .html)</label>
                <input type="file" class="form-control" id="file" name="file" required
                    accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.odt,.ods,.odp,.txt,.rtf,.html">
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
</body>

</html>
