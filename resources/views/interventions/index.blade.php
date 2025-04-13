@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Interventions</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('interventions.create') }}" class="btn btn-primary mb-3">Add Intervention</a>
    
    <div class="mb-4">
        <form method="GET" action="{{ route('interventions.index') }}">
            <label for="alert_days">Show interventions expiring in:</label>
            <input type="number" name="alert_days" value="{{ $notificationDays }}" min="1" class="form-control d-inline-block w-auto mx-2">
            <button type="submit" class="btn btn-sm btn-warning">Update</button>
        </form>
    </div>
    
    @if ($expiringInterventions->count() > 0)
        <div class="alert alert-warning">
            <strong>⚠ Interventions expiring in the next {{ $notificationDays }} days:</strong>
            <ul>
                @foreach ($expiringInterventions as $intervention)
                    <li>
                        {{ $intervention->client->name }} - 
                        Intervention Date: {{ \Carbon\Carbon::parse($intervention->intervention_date)->format('Y-m-d') }} -
                        Expires: {{ \Carbon\Carbon::parse($intervention->intervention_date)->addMonths(6)->format('Y-m-d') }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    

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
    @php
        use Illuminate\Pagination\Paginator;
        Paginator::useBootstrap(); 
    @endphp
    <div class="d-flex justify-content-center mt-4">
        {{ $interventions->links() }}
    </div>
</div>
@endsection
