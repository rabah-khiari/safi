<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Client;
use App\Models\Extinguisher;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // Show all purchases
    public function index()
    {
        $purchases = Purchase::with(['client', 'extinguisher'])->orderBy('purchase_id', 'desc')->get();
        return view('purchases.index', compact('purchases'));
    }

    // Show the create form
    public function create()
    {
        $clients = Client::all();
        $extinguishers = Extinguisher::all();
        return view('purchases.create', compact('clients', 'extinguishers'));
    }

    // Store a new purchase
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'extinguisher_id' => 'required|exists:extinguishers,extinguisher_id',
            'quantity' => 'required|integer|min:1',
            'intervention_date' => 'required|date',
        ]);

        Purchase::create($request->all());

        return redirect()->route('purchases.index')->with('success', 'Purchase added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $clients = Client::all();
        $extinguishers = Extinguisher::all();
        return view('purchases.edit', compact('purchase', 'clients', 'extinguishers'));
    }

    // Update purchase
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'extinguisher_id' => 'required|exists:extinguishers,extinguisher_id',
            'quantity' => 'required|integer|min:1',
            'intervention_date' => 'required|date',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update($request->all());

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
    }

    // Delete purchase
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}