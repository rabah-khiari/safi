@extends('layouts.app')

@section('content')
    <h2>Add New Purchase</h2>

    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <label>Client:</label>
        <select name="client_id" required>
            @foreach($clients as $client)
                <option value="{{ $client->client_id }}">{{ $client->name }}</option>
            @endforeach
        </select>

        <label>Extinguisher:</label>
        <select name="extinguisher_id" required>
            @foreach($extinguishers as $extinguisher)
                <option value="{{ $extinguisher->extinguisher_id }}">
                    {{ $extinguisher->type }} - {{ $extinguisher->size }}L
                </option>
            @endforeach
        </select>

        <label>Quantity:</label>
        <input type="number" name="quantity" required>

        <label>Intervention Date:</label>
        <input type="date" name="intervention_date" required>

        <button type="submit">Save</button>
    </form>
@endsection
