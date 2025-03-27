@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Intervention</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('interventions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Client:</label>
            <select name="client_id" id="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->client_id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="intervention_date" class="form-label">Intervention Date:</label>
            <input type="date" name="intervention_date" id="intervention_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment (Optional):</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Intervention</button>
    </form>
</div>
@endsection
