@extends('layouts.app')
@section('title', 'affectation')

@section('content')
<a class="btn btn-primary btn-sm" href="{{ url('/clients/' . $client->client_id . '/edit') }}" >Éditer le client </a>
<br>

<br>
<div class=" shadow"> 
    <h2 class="text-center "> {{ $client->name }}</h2>

    <p><strong> &nbsp; Addresse:</strong> {{ $client->address }}</p>
    <p><strong> &nbsp; Téléphone:</strong> {{ $client->phone1 }} {{ $client->phone2 ? ', ' . $client->phone2 : '' }}</p>
    <p><strong> &nbsp; Email:</strong> {{ $client->email ?? 'N/A' }}</p>

</div>
    <br>
<div class="">
    <br>
    <h3>&nbsp;Affectation des extincteurs </h3>
    &nbsp;<a class="btn btn-primary" href="{{url('/purchases/create/'.$client->client_id ) }}"> &nbsp;Ajouter un nouvel Affectation</a>
    @if($client->purchases->isEmpty())
        <p> &nbsp; Aucun Affectation trouvé.</p>
    @else
        <table class="table">
            <tr>
                <th>ID</th>
                <th>extincteur</th>
                <th>Quantité</th>
                <th>Date d'intervention</th>
            </tr>
            @foreach($client->purchases as $purchase)
                <tr>&nbsp;
                    <td>{{ $purchase->purchase_id }}</td>
                    <td>{{ $purchase->extinguisher->type }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ $purchase->intervention_date }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('purchases.edit', $purchase->purchase_id) }}">Editer</a>
                        <form action="{{ route('purchases.destroy', $purchase->purchase_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                
            @endforeach
        </table>
    @endif
</div>
    

<div class="">

    <h3>📜 Historique des interventions</h3>
    <a href="{{ url('/interventions/create/'.$client->client_id )}}" class="btn btn-primary mb-3">Ajouter une intervention</a>
    @if($interventions->isEmpty())
        <p>Aucune intervention enregistrée.</p>
    @else
  
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Commentaire</th>
            </tr>
            @foreach($interventions as $intervention)
                <tr>
                    <td>{{ $intervention->intervention_id }}</td>
                    <td>{{ $intervention->intervention_date }}</td>
                    <td>{{ $intervention->comment }}</td>
                    <td>
                        <form action="{{route('interventions.destroy', $intervention->intervention_id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</div>

@endsection
