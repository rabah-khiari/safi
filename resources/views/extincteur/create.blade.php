@extends('layouts.app')
@section('title', 'créer Extincteur')

@section('content')
    <h2>Ajouter un nouvel extincteur</h2>

    <form action="{{ route('extincteur.store') }}" method="POST">
        @csrf
        <label class="form-label">Type:</label>
        <input class="form-control" type="text" name="type" required>
        
        

        <button class="btn btn-primary" type="submit">Sauvegarder</button>
    </form>
@endsection
