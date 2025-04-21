@extends('layouts.app')
@section('title', 'Intervention')


@section('content')
<div class="container">
    <h2>Interventions</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    
    
    <div class="mb-4">
        <form method="GET" action="{{ route('interventions.index') }}">
            <label for="alert_days">Afficher les interventions expirant dans :</label>
            <input type="number" name="alert_days" value="{{ $notificationDays }}" min="1" class="form-control d-inline-block w-auto mx-2">
            <button type="submit" class="btn btn-sm btn-warning">Update</button>
        </form>
    </div>
    
    @if ($expiringInterventions->count() > 0)
        <div class="alert alert-warning">
            <strong>⚠ Interventions expirant dans le prochain {{ $notificationDays }} jours:</strong>
            <ul>
                @foreach ($expiringInterventions as $intervention)
                    <li>
                        {{ $intervention->client->name }} - 
                        Date d'intervention : {{ \Carbon\Carbon::parse($intervention->intervention_date)->format('Y-m-d') }} -
                        Expirer: {{ \Carbon\Carbon::parse($intervention->intervention_date)->addMonths(6)->format('Y-m-d') }}
                        reste: {{ (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($intervention->intervention_date)->addMonths(6), false) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($expiringExtincteur->count() > 0)
        <div class="alert alert-warning">
            <strong>⚠ Extincteurs expirant dans le prochain {{ $notificationDays }} jours:</strong>
            <ul>
                @foreach ($expiringExtincteur as $interventionExtincteur)
                    <li>
                        {{ $interventionExtincteur->client->name }} - {{ $interventionExtincteur->extinguisher->type }}-{{ $interventionExtincteur->extinguisher->size }}
                         {{ \Carbon\Carbon::parse($interventionExtincteur->intervention_date)->format('Y-m-d') }} -
                        Expirer: {{ \Carbon\Carbon::parse($interventionExtincteur->intervention_date)->addMonths(6)->format('Y-m-d') }}
                        reste: {{ (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($interventionExtincteur->intervention_date)->addMonths(6), false) }}

                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Date</th>
                <th>Expirer</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interventions as $intervention)
                <tr>
                    <td>
                        <a target="_blank" href="{{ url('/clients/' . $intervention->client->client_id . '/details') }}">{{ $intervention->client->name }}</a>
                    </td>
                    <td>{{ $intervention->intervention_date }}</td>
                    <td>{{ \Carbon\Carbon::parse($intervention->intervention_date)->addMonths(6)->format('Y-m-d') }}</td>
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
