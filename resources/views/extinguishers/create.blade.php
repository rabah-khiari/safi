@extends('layouts.app')

@section('content')
    <h2>Add New Extinguisher</h2>

    <form action="{{ route('extinguishers.store') }}" method="POST">
        @csrf
        <label>Type:</label>
        <input type="text" name="type" required>
        
        <label>Size (L):</label>
        <input type="number" name="size" step="0.1" required>
        
        <label>Stock:</label>
        <input type="number" name="stock" required>

        <button type="submit">Save</button>
    </form>
@endsection
