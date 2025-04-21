@extends('layouts.app')
@section('title', 'éditer Extincteur')

@section('content')
    <h2>Editer extincteur</h2>

    <form action="{{ route('extincteur.update', $extinguisher->extinguisher_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="form-label">Type:</label>
        <input class="form-control" type="text" name="type" value="{{ $extinguisher->type }}" required>

        

        <button class="btn btn-primary" type="submit">Mise à jour</button>
    </form>
@endsection
