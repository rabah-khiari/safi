@extends('layouts.app')

@section('content')
    <h2>Edit extincteur</h2>

    <form action="{{ route('extincteur.update', $extinguisher->extinguisher_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="form-label">Type:</label>
        <input class="form-control" type="text" name="type" value="{{ $extinguisher->type }}" required>

        <label class="form-label">Size (L):</label>
        <input class="form-control" type="number" name="size" value="{{ $extinguisher->size }}" step="0.1" required>

        <label class="form-label"> Stock:</label>
        <input class="form-control" type="number" name="stock" value="{{ $extinguisher->stock }}" required><br>

        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
