<?php

namespace App\Http\Controllers;

use App\Models\Immeuble;
use Illuminate\Http\Request;

class UserImmeubleController extends Controller
{
    public function index()
    {
        // Retrieve all properties (immeubles) from the database
        $immeubles = Immeuble::all();

        // Return the view with the list of properties
        return view('index', compact('immeubles'));
    }

    public function reserve($id)
    {
        // Find the specific property by its ID
        $immeuble = Immeuble::find($id);

        if ($immeuble) {
            // Logic to reserve the property (e.g., mark it as reserved, notify the admin, etc.)
            return redirect()->route('index')->with('success', 'Property reserved successfully!');
        }

        return redirect()->route('index')->with('error', 'Property not found!');
    }


    
}
