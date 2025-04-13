@extends('layouts.app')

@section('content')
    <h2>Clients List</h2>
    <a class="btn btn-primary btn-sm" href="{{ route('clients.create') }}">Add Client</a>
<div class="container">

    
    <form method="GET" action="{{ route('clients.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="wilaya" class="form-label">Wilaya</label>
            <select name="wilaya" id="wilaya" class="form-control" onchange="this.form.submit()">
                <option value="">-- All Wilayas --</option>
                @foreach ($wilayas as $wilaya)
                    <option value="{{ $wilaya }}" {{ request('wilaya') == $wilaya ? 'selected' : '' }}>
                        {{ $wilaya }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="col-md-4">
            <label for="commune" class="form-label">Commune</label>
            <select name="commune" id="commune" class="form-control">
                <option value="">-- All Communes --</option>
                @foreach ($communes as $commune)
                    <option value="{{ $commune }}" {{ request('commune') == $commune ? 'selected' : '' }}>
                        {{ $commune }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary" type="submit">Filter</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary ms-2">Reset</a>
        </div>
    </form>

    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>address</th>
            <th>Phone</th>
            <th>Phone2</th>
            <th>Email</th>
            <th>interventions</th>
            <th>Actions</th>
        </tr>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->name }} </td>
                <td>{{ ucfirst($client->type) }}</td>
                <td>{{ $client->address }}</td>
                <td>{{ $client->phone1 }}</td>
                <td>{{ $client->phone2 }}</td>
                <td>{{ $client->email ?? 'N/A' }}</td>
                <td>
                    <select class="form-select form-select-sm ">
                        @foreach ($client->intervetions as $intervention)
                            <option><a class="dropdown-item" href="#">{{ $intervention->intervention_date }}</a></option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ url('/clients/' . $client->client_id . '/details') }}">View</a>
                    <a class="btn btn-primary btn-sm" href="{{ url('/clients/' . $client->client_id . '/edit') }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
    @php
        use Illuminate\Pagination\Paginator;
        Paginator::useBootstrap(); 
    @endphp
    <div class="d-flex justify-content-center mt-4">
        {{ $clients->links() }}
    </div>

</div>

@endsection
