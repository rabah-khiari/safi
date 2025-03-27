@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Client</h2>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('clients.update', $client->client_id) }}" method="POST">
        @csrf {{-- Security Token --}}
        @method('PUT') {{-- Laravel uses this for update requests --}}

        <div class="mb-3">
            <label for="type" class="form-label">Client Type:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="person" {{ $client->type == 'person' ? 'selected' : '' }}>Person</option>
                <option value="enterprise" {{ $client->type == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Client Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $client->address }}" required>
        </div>

        <div class="mb-3">
            <label for="phone1" class="form-label">Phone 1:</label>
            <input type="text" name="phone1" id="phone1" class="form-control" value="{{ $client->phone1 }}" required>
        </div>

        <div class="mb-3">
            <label for="phone2" class="form-label">Phone 2 (Optional):</label>
            <input type="text" name="phone2" id="phone2" class="form-control" value="{{ $client->phone2 }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (Optional):</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}">
        </div>

        <button type="submit" class="btn btn-success">Update Client</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
