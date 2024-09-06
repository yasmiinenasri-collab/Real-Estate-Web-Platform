<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tunisiemaison - Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .hero-section {
            background-color: #007bff;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .hero-section h1 {
            font-size: 3rem;
            margin: 0;
        }
        .navbar, .btn-reserve {
            background-color: #007bff;
            color: white;
        }
        .navbar-brand img {
            height: 50px; /* Ajustez la hauteur du logo */
            width: auto;  /* Conserver le ratio d'aspect */
        }
        .btn-reserve:hover {
            background-color: #0056b3;
        }
        .immeubles-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .immeuble-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .immeuble-card:hover {
            transform: translateY(-5px);
        }
        .carousel-caption {
            bottom: 20px;
            text-align: center;
        }
        .carousel-caption h5 {
            font-size: 2rem;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .agency-description {
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
            text-align: center;
        }
        .agency-description h2 {
            margin-bottom: 20px;
        }
        .agency-description p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/M.png') }}" alt="Logo">
                    Tunisiemaison
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <!-- Carrousel -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/5.png') }}" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/4.jpg') }}" class="d-block w-100" alt="Slide 4">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Description de l'agence -->
            <section class="agency-description mt-5">
                <h2>À propos de Tunisiemaison</h2>
                <p>Chez Tunisiemaison, nous sommes spécialisés dans la vente et la location de maisons à travers la Tunisie. Nous nous engageons à offrir des services de haute qualité pour vous aider à trouver le bien immobilier qui correspond à vos besoins. Que vous cherchiez une maison à acheter ou à louer, notre équipe est là pour vous guider à chaque étape du processus.</p>
                <p>Notre expertise et notre connaissance approfondie du marché local nous permettent de vous offrir les meilleures options disponibles. Nous mettons un point d'honneur à satisfaire nos clients en leur fournissant des informations précises et des conseils personnalisés.</p>
                <p>Découvrez dès maintenant notre large sélection d'immeubles et trouvez la maison de vos rêves avec Tunisiemaison.</p>
            </section>

            <!-- Liste des immeubles -->
            @if(isset($immeubles) && $immeubles->count() > 0)
                <div class="immeubles-list mt-5">
                    @foreach ($immeubles as $immeuble)
                        <div class="immeuble-card">
                            <img src="{{ asset('storage/' . $immeuble->picture) }}" alt="Image de {{ $immeuble->name }}">
                            <div class="card-body">
                                <h3>{{ $immeuble->name }}</h3>
                                <p><strong>Adresse :</strong> {{ $immeuble->address }}</p>
                                <p><strong>Prix :</strong> {{ number_format($immeuble->price, 2) }} TND</p>
                                <p>{{ $immeuble->description }}</p>
                                <a href="{{ route('reserve', $immeuble->id) }}" class="btn-reserve">Réserver</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">Aucun immeuble trouvé.</p>
            @endif
        </main>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>