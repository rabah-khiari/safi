@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Interventions</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('interventions.create') }}" class="btn btn-primary mb-3">Add Intervention</a>
    <a href="{{ route('interventions.schedule') }}" class="btn btn-warning mb-3">Schedule Interventions</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Date</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interventions as $intervention)
                <tr>
                    <td>{{ $intervention->client->name }}</td>
                    <td>{{ $intervention->intervention_date }}</td>
                    <td>{{ $intervention->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
