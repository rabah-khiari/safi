<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;
use App\Models\Purchase;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class InterventionController extends Controller
{
    // Show all interventions
    public function index(Request $request)
    {
    
    $notificationDays = $request->input('alert_days', Cache::get('alert_days', 10)); // Default to 10 days
    Cache::put('alert_days', $notificationDays);

    $today = Carbon::today();

    // Get all interventions and filter with collection (easier logic)
    $expiringInterventions = Intervention::with('client')->get()->filter(function ($intervention) use ($today, $notificationDays) {
        $expiryDate = Carbon::parse($intervention->intervention_date)->addMonths(6);
        $alertStartDate = $expiryDate->copy()->subDays($notificationDays);
        return $today->between($alertStartDate, $expiryDate);
    });

    $expiringExtincteur = Purchase::with('client')->get()->filter(function ($intervention) use ($today, $notificationDays) {
        $expiryDate = Carbon::parse($intervention->intervention_date)->addMonths(6);
        $alertStartDate = $expiryDate->copy()->subDays($notificationDays);
        return $today->between($alertStartDate, $expiryDate);
    });
            
        $clients = Client::paginate(10);
        $interventions = Intervention::with('client')->orderBy('intervention_date', 'desc')->paginate(30);
        return view('interventions.index', [
            'clients' => $clients,
            'expiringInterventions' => $expiringInterventions,
            'notificationDays' => $notificationDays,
            'expiringExtincteur' => $expiringExtincteur,
            'interventions' => $interventions
        ]);

    }

    // Show the form to add an intervention
    public function create($id)
    {
        $clients = Client::findOrFail($id);
        
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
        return redirect()->route('clients.details', ['client_id' => $request->client_id])
                          ->with('success', 'Intervention added successfully!');
        
    }

    public function destroy($id)
    {
        $purchase = Intervention::findOrFail($id);
        $purchase->delete();

        return redirect()->back()->with('success', 'Intervention deleted successfully!');
    }
    
}