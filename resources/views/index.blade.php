@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($immeubles as $immeuble)
            <div class="col-md-4">
                <div class="card mb-4">
                <img src="{{ asset('storage/' . $immeuble->picture) }}" class="card-img-top" alt="{{ $immeuble->name }}">
                <div class="card-body">
                        <h5 class="card-title">{{ $immeuble->name }}</h5>
                        <p class="card-text">{{ $immeuble->description }}</p>
                        <p class="card-text"><strong>Price:</strong> {{ $immeuble->price }} TND</p>
                        <p class="card-text"><strong>Location:</strong> {{ $immeuble->ville }}</p>
                        <a href="{{ route('user.immeubles.reserve', $immeuble->id) }}" class="btn btn-primary">Reserve</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
