<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;
use App\Models\Client;
use Carbon\Carbon;

class InterventionController extends Controller
{
    // Show all interventions
    public function index()
    {
        $interventions = Intervention::with('client')->orderBy('intervention_date', 'desc')->limit(10000)->get();
        return view('interventions.index', compact('interventions'));
    }

    // Show the form to add an intervention
    public function create()
    {
        $clients = Client::all();
        return view('interventions.create', compact('clients'));
    }

    // Store a new intervention
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'intervention_date' => 'required|date',
            'comment' => 'nullable|string',
        ]);
        
        Intervention::create([
            'client_id' => $request->client_id,
            'intervention_date' => $request->intervention_date,
            'comment' => $request->comment
        ]);

        return redirect()->route('interventions.index')->with('success', 'Intervention added successfully.');
    }

    // Automatically add interventions every 6 months
    public function scheduleInterventions()
    {
        $clients = Client::all();
        $today = Carbon::today();

        foreach ($clients as $client) {
            $lastIntervention = Intervention::where('client_id', $client->id)
                ->orderBy('intervention_date', 'desc')
                ->first();

            // If no previous intervention, create the first one
            if (!$lastIntervention) {
                Intervention::create([
                    'client_id' => $client->id,
                    'intervention_date' => $today,
                    'comment' => 'First scheduled intervention.',
                ]);
            } 
            // If last intervention is more than 6 months old, schedule a new one
            elseif ($lastIntervention->intervention_date->addMonths(6)->lte($today)) {
                Intervention::create([
                    'client_id' => $client->id,
                    'intervention_date' => $today,
                    'comment' => 'Scheduled intervention after 6 months.',
                ]);
            }
        }

        return redirect()->route('interventions.index')->with('success', 'Scheduled interventions added.');
    }
}