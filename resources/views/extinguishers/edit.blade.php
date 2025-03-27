@extends('layouts.app')

@section('content')
    <h2>Edit Extinguisher</h2>

    <form action="{{ route('extinguishers.update', $extinguisher->extinguisher_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Type:</label>
        <input type="text" name="type" value="{{ $extinguisher->type }}" required>

        <label>Size (L):</label>
        <input type="number" name="size" value="{{ $extinguisher->size }}" step="0.1" required>

        <label>Stock:</label>
        <input type="number" name="stock" value="{{ $extinguisher->stock }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
