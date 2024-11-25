@extends('admin::layouts.default')

@section('content')
    <div class="container">
        <h1>Créer une Fiche de Contact pour {{ $immeuble->name }}</h1>

        <form action="{{ route('admin.contacts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="text" class="form-control" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="price">Prix</label>
                <input type="number" class="form-control" name="price" required>
            </div>

            <input type="hidden" name="immeuble_id" value="{{ $immeuble->id }}">

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
