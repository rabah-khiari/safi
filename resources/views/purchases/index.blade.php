@extends('layouts.app')

@section('content')
    <h2>Purchases</h2>
    <a class="btn btn-primary" href="{{ route('purchases.create') }}">Add New Purchase</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Extinguisher</th>
            <th>Quantity</th>
            <th>Intervention Date</th>
            <th>Actions</th>
        </tr>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->purchase_id }}</td>
                <td>{{ $purchase->client->name ?? 'N/A' }}</td>
                <td>{{ $purchase->extinguisher->type }} - {{ $purchase->extinguisher->size }}L</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->intervention_date }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('purchases.edit', $purchase->purchase_id) }}">Edit</a>
                    <form action="{{ route('purchases.destroy', $purchase->purchase_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
