@extends('layouts.app')

@section('content')
    <h2>Edit Purchase</h2>

    <form action="{{ route('purchases.update', $purchase->purchase_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Client:</label>
        <select name="client_id" required>
            @foreach($clients as $client)
                <option value="{{ $client->client_id }}" {{ $purchase->client_id == $client->client_id ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>

        <label>Extinguisher:</label>
        <select name="extinguisher_id" required>
            @foreach($extinguishers as $extinguisher)
                <option value="{{ $extinguisher->extinguisher_id }}" {{ $purchase->extinguisher_id == $extinguisher->extinguisher_id ? 'selected' : '' }}>
                    {{ $extinguisher->type }} - {{ $extinguisher->size }}L
                </option>
            @endforeach
        </select>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="{{ $purchase->quantity }}" required>

        <label>Intervention Date:</label>
        <input type="date" name="intervention_date" value="{{ $purchase->intervention_date }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
