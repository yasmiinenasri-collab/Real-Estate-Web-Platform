<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tunisiemaison - Accueil</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* Ajout de styles personnalisés pour améliorer l'apparence */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .hero-section {
            background: url('/path/to/your/hero-image.jpg') no-repeat center center;
            background-size: cover;
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
        .immeubles-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 0 20px;
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
        .immeuble-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .immeuble-card .card-body {
            padding: 15px;
        }
        .immeuble-card h3 {
            margin: 0 0 10px;
            color: #007bff;
            font-size: 1.25rem;
        }
        .immeuble-card p {
            margin: 0 0 10px;
            color: #6c757d;
        }
        .btn-reserve {
            display: block;
            width: 100%;
            padding: 10px 0;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-reserve:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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
            <section class="hero-section">
                <h1>Bienvenue sur Tunisiemaison</h1>
            </section>

            @if(isset($immeubles) && $immeubles->count() > 0)
    <div class="immeubles-list">
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
    <p>Aucun immeuble trouvé.</p>
@endif

</body>
</html>
