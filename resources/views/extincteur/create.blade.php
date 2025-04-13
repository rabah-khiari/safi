@extends('layouts.app')

@section('content')
    <h2>Add New extincteur</h2>

    <form action="{{ route('extincteur.store') }}" method="POST">
        @csrf
        <label class="form-label">Type:</label>
        <input class="form-control" type="text" name="type" required>
        
        <label class="form-label"> Size (L):</label>
        <input class="form-control" type="number" name="size" step="0.1" required>
        
        <label class="form-label">Stock:</label>
        <input class="form-control" type="number" name="stock" required><br>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>
@endsection
