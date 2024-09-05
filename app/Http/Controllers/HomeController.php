<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immeuble;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve immeubles from the database
        $immeubles = Immeuble::all(); // Assuming Immeuble is the model name
    
        if (Auth::check()) {
            // Pass immeubles to the view for logged-in users
            return view('home_logged_in', compact('immeubles'));
        } else {
            // Pass immeubles to the view for non-logged-in users
            return view('home', compact('immeubles'));
        }

    
        
            

    }}
