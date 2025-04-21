@extends('layouts.app')
@section('title', 'éditer affectation')

@section('content')
    <h2>Editer affectation pour : {{$purchase->client->name}} </h2>

    <form action="{{ route('purchases.update', $purchase->purchase_id) }}" method="POST">
        @csrf
        @method('PUT')

       
        <select class="form-control" name="client_id" required hidden>
                <option value="{{ $purchase->client->client_id }}" selected>
                    {{ $purchase->client->name }}
                </option>
        </select>

        <label>Extincteur:</label>
        <select class="form-control" name="extinguisher_id" required>
            @foreach($extinguishers as $extinguisher)
                <option value="{{ $extinguisher->extinguisher_id }}" {{ $purchase->extinguisher_id == $extinguisher->extinguisher_id ? 'selected' : '' }}>
                    {{ $extinguisher->type }} - {{ $extinguisher->size }}L
                </option>
            @endforeach
        </select>

        <label class="form-label">Quantité:</label>
        <input class="form-control" type="number" name="quantity" value="{{ $purchase->quantity }}" required>

        <label class="form-label">Date d'intervention:</label>
        <input class="form-control" type="date" name="intervention_date" value="{{ $purchase->intervention_date }}" required>

        <button class="btn btn-primary" type="submit">Mise à jour</button>
    </form>
@endsection
