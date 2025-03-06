<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation du PDF</title>
</head>

<body>

    <h2>Votre document PDF</h2>
    {{ $pdfUrl }}
    <!-- Affichage du PDF -->
    <iframe src="{{ $pdfUrl }}" width="100%" height="600px"></iframe>

    <!-- Bouton de téléchargement -->
    <br>
    <a href="{{ $pdfUrl }}" download>
        <button>Télécharger le PDF</button>
    </a>

</body>

</html>
