@extends('layouts.app')
@section('title', 'créer Extincteur')

@section('content')
    <h2>Ajouter un nouvel extincteur</h2>

    <form action="{{ route('extincteur.store') }}" method="POST">
        @csrf
        <label class="form-label">Type:</label>
        <input class="form-control" type="text" name="type" required>
        
        <label class="form-label"> Taille (L/kg):</label>
        <input class="form-control" type="number" name="size" step="0.1" required>
        
        <label class="form-label">Stock:</label>
        <input class="form-control" type="number" name="stock" required><br>

        <button class="btn btn-primary" type="submit">Sauvegarder</button>
    </form>
@endsection
