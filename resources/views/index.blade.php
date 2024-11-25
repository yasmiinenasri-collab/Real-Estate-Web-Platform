@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('user.immeubles.index') }}">
                <div class="card p-4 mb-3">
                    <h4 class="mb-3">Rechercher des Immeubles</h4>
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par ville" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Rechercher</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="number" name="price_min" class="form-control" placeholder="Prix minimum" value="{{ request('price_min') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="price_max" class="form-control" placeholder="Prix maximum" value="{{ request('price_max') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="rooms" class="form-control" placeholder="Nombre de chambres" value="{{ request('rooms') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select name="sort" class="form-control">
                                <option value="">Trier par</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">Appliquer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach($immeubles as $immeuble)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($immeuble->picture)
                        <img src="{{ asset('uploads/' . $immeuble->picture) }}" class="card-img-top" alt="{{ $immeuble->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $immeuble->name }}</h5>
                        <p class="card-text">{{ $immeuble->description }}</p>
                        <p class="card-text"><strong>Prix:</strong> {{ $immeuble->price }} TND</p>
                        <p class="card-text"><strong>Ville :</strong> {{ $immeuble->ville }}</p>
                        <p class="card-text"><strong>Nombre de chambres :</strong> {{ $immeuble->rooms }}</p>
                        <a href="{{ route('user.immeubles.show', $immeuble->id) }}" class="btn btn-secondary">Voir Détails</a>
                        <a href="{{ route('user.immeubles.reserve', $immeuble->id) }}" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="row">
        <div class="col-md-12">
            {{ $immeubles->links() }} <!-- Liens de pagination -->
        </div>
    </div>
</div> 
@endsection
