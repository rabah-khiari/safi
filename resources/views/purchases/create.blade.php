@extends('layouts.app')
@section('title', 'Créer affectation')

@section('content')
    <h2>Ajouter un nouvel affectation pour {{ $clients->name }}</h2>

    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <label class="form-label">Cliente:</label>
        <select class="form-select"  name="client_id" required hidden>
                <option value="{{ $clients->client_id }}">{{ $clients->name }}</option>
        </select>

        <label class="form-label">Extincteur:</label>
        <select  class="form-select" name="extinguisher_id" required>
            @foreach($extinguishers as $extinguisher)
                <option value="{{ $extinguisher->extinguisher_id }}">
                    {{ $extinguisher->type }} - {{ $extinguisher->size }}L
                </option>
            @endforeach
        </select>
 
        <label class="form-label">Quantité:</label>
        <input class="form-control" type="number" name="quantity" required>

        <label class="form-label">Date d'intervention:</label>
        <input class="form-control" type="date" name="intervention_date" required>
        <br>
        <button class="btn btn-primary" type="submit">Sauvegarder</button>
    </form>
@endsection
