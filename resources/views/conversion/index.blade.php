<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conv2PDF – Convertir vos fichiers en PDF en toute simplicité.</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-white p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-4">Conv2PDF</h1>
                    <p class="lead">Convertir vos fichiers en PDF en toute simplicité.</p>
                </div>
                <div class="col-md-6 text-end">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-light" aria-current="page"
                                            href="/">Convertir PDF</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-light" href="#">Fusionner PDF</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link text-light" href="#">Contact</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

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

    <footer class="bg-dark text-white p-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; {{ date('Y') }} Conv2PDF. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-end">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-white" href="#">Mentions légales</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="#">Conditions d'utilisation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
