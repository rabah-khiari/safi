@extends('layouts.app')
@section('title', 'Extincteur')

@section('content')
    <h2>extincteur</h2>
    <a class="btn btn-primary" href="{{ route('extincteur.create') }}">Ajouter un nouvel extincteur</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Type</th>
            
            <th>Actions</th>
        </tr>
        @foreach($extinguishers as $extinguisher)
            <tr>
                <td>{{ $extinguisher->extinguisher_id }}</td>
                <td>{{ $extinguisher->type }}</td>
                
                <td>
                    <a class="btn btn-success" href="{{ route('extincteur.edit', $extinguisher->extinguisher_id) }}">Editer</a>
                    <form action="{{ route('extincteur.destroy', $extinguisher->extinguisher_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @php
        use Illuminate\Pagination\Paginator;
        Paginator::useBootstrap(); 
    @endphp
    <div class="d-flex justify-content-center mt-4">
        {{ $extinguishers->links() }}
    </div>
@endsection
