<?php
namespace App\Http\Controllers;

use App\Models\Extinguisher;
use Illuminate\Http\Request;

class ExtinguisherController extends Controller
{
    // Show all extinguishers
    public function index()
    {
        $extinguishers = Extinguisher::paginate(30);
        return view('extincteur.index', compact('extinguishers'));
    }

    // Show the create form
    public function create()
    {
        return view('extincteur.create');
    }

    // Store a new extinguisher
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'size' => 'required|numeric|min:0.1',
            'stock' => 'required|integer|min:0',
        ]);

        Extinguisher::create($request->all());

        return redirect()->route('extincteur.index')->with('success', 'extincteur added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $extinguisher = Extinguisher::findOrFail($id);
        return view('extincteur.edit', compact('extinguisher'));
    }

    // Update extinguisher
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'size' => 'required|numeric|min:0.1',
            'stock' => 'required|integer|min:0',
        ]);

        $extinguisher = Extinguisher::findOrFail($id);
        $extinguisher->update($request->all());

        return redirect()->route('extincteur.index')->with('success', 'Extinguisher updated successfully!');
    }

    // Delete extinguisher
    public function destroy($id)
    {
        $extinguisher = Extinguisher::findOrFail($id);
        $extinguisher->delete();

        return redirect()->route('extincteur.index')->with('success', 'Extinguisher deleted successfully!');
    }
}