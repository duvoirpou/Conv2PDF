<header class="bg-dark text-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-4">ArtisanPDF</h1>
                <p class="lead">
                    Créer, modifier et exporter des documents PDF avec facilité.
                </p>
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
                                    <a class="nav-link active text-light" aria-current="page" href="/">Convertir
                                        PDF</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('fusionner.pdf') }}">Fusionner PDF</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('form.compress') }}">Compresser
                                        PDF</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
