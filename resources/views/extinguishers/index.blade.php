@extends('layouts.app')

@section('content')
    <h2>Extinguishers</h2>
    <a class="btn btn-primary" href="{{ route('extinguishers.create') }}">Add New Extinguisher</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Size</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        @foreach($extinguishers as $extinguisher)
            <tr>
                <td>{{ $extinguisher->extinguisher_id }}</td>
                <td>{{ $extinguisher->type }}</td>
                <td>{{ $extinguisher->size }} L</td>
                <td>{{ $extinguisher->stock }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('extinguishers.edit', $extinguisher->extinguisher_id) }}">Edit</a>
                    <form action="{{ route('extinguishers.destroy', $extinguisher->extinguisher_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
