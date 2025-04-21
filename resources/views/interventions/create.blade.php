@extends('layouts.app')
@section('title', 'Créer intervention')

@section('content')
<div class="container">
    <h2>Ajouter une nouvelle intervention pour : {{$clients->name}} </h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('interventions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            
            <select name="client_id" id="client_id" class="form-control" required hidden>
               
                <option value="{{ $clients->client_id }}">{{ $clients->name }}</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="intervention_date" class="form-label">Date d'intervention :</label>
            <input type="date" name="intervention_date" id="intervention_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire (optionnel):</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter une intervention</button>
    </form>
</div>
@endsection
