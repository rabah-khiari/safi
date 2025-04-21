@extends('layouts.app')
@section('title', 'Affectation')

@section('content')
    <h2>Affectation</h2>
    <a class="btn btn-primary" href="{{ route('purchases.create') }}">Add New Purchase</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Extincteur</th>
            <th>Quantité</th>
            <th>Date d'intervention</th>
            <th>Actions</th>
        </tr>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->purchase_id }}</td>
                <td>{{ $purchase->client->name ?? 'N/A' }}</td>
                <td>{{ $purchase->extinguisher->type }} </td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->intervention_date }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('purchases.edit', $purchase->purchase_id) }}">Editer</a>
                    <form action="{{ route('purchases.destroy', $purchase->purchase_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure?')">Supprimer</button>
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
        {{ $purchases->links() }}
    </div>
@endsection
