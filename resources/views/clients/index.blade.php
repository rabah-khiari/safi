@extends('layouts.app')

@section('content')
    <h2>Clients List</h2>
    <a class="btn btn-primary btn-sm" href="{{ route('clients.create') }}">Add Client</a>
<div class="container">

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
</div>

@endsection
