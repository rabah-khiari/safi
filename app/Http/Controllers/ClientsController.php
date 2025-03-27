<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Purchase;
use App\Models\Intervention;

class ClientsController extends Controller {
    public function index()
    {
        return view('clients.index', ['clients' => Client::all()]);
    }
    // Show the create client form
    public function create()
    {
        return view('clients.create');
    }

    // Store the new client
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'type' => 'required|in:person,enterprise',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:clients,email|max:255',
        ]);

        // Create the client
        Client::create($request->all());

        // Redirect with success message
        return redirect()->route('clients.create')->with('success', 'Client added successfully.');
    }
    public function edit($client_id)
    {
        $client = Client::findOrFail($client_id);
        return view('clients.edit', compact('client'));
    }

    // Update the client
    public function update(Request $request, $client_id)
    {
        $request->validate([
            'type' => 'required|in:person,enterprise',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:clients,email,'.$client_id.',client_id'
        ]);

        $client = Client::findOrFail($client_id);
        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function showPurchasesAndInterventions($client_id)
    {
    // Fetch client details manually
    $client = Client::where('client_id', $client_id)->firstOrFail();
    // Fetch purchases with extinguisher details
    $purchases = Purchase::where('client_id', $client_id)
        ->join('extinguishers', 'purchases.extinguisher_id', '=', 'extinguishers.extinguisher_id')
        ->select('purchases.*', 'extinguishers.type', 'extinguishers.size')
        ->get();
        

    // Fetch interventions sorted by latest date
    $interventions = Intervention::where('client_id', $client_id)
        ->orderBy('intervention_date', 'desc')
        ->get();
       
    return view('clients.purchases_interventions', compact('client', 'purchases', 'interventions'));

    }


}
