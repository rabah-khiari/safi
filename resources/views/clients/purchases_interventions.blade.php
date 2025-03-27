@extends('layouts.app')

@section('content')
    <h2>Client Details: {{ $client->name }}</h2>
    <p><strong>Address:</strong> {{ $client->address }}</p>
    <p><strong>Phone:</strong> {{ $client->phone1 }} {{ $client->phone2 ? ', ' . $client->phone2 : '' }}</p>
    <p><strong>Email:</strong> {{ $client->email ?? 'N/A' }}</p>

    <hr>

    <h3>🛒 Purchases</h3>
    <a class="btn btn-primary" href="{{ route('purchases.create') }}">Add New Purchase</a>
    @if($client->purchases->isEmpty())
        <p>No purchases found.</p>
    @else
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Extinguisher</th>
                <th>Quantity</th>
                <th>Intervention Date</th>
            </tr>
            @foreach($client->purchases as $purchase)
                <tr>
                    <td>{{ $purchase->purchase_id }}</td>
                    <td>{{ $purchase->extinguisher->type }} - {{ $purchase->extinguisher->size }}L</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ $purchase->intervention_date }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <hr>

    <h3>📜 Intervention History</h3>
    <a href="{{ route('interventions.create') }}" class="btn btn-primary mb-3">Add Intervention</a>
    @if($interventions->isEmpty())
        <p>No interventions recorded.</p>
    @else
  
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Comment</th>
            </tr>
            @foreach($interventions as $intervention)
                <tr>
                    <td>{{ $intervention->intervention_id }}</td>
                    <td>{{ $intervention->intervention_date }}</td>
                    <td>{{ $intervention->comment }}</td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection
