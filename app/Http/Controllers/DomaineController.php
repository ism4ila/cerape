<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    public function index()
    {
        $domaines = Domaine::all();
        return view('domaines.index', compact('domaines'));
    }

    public function show($slug)
    {
        $domaine = Domaine::where('slug', $slug)->firstOrFail();
        return view('domaines.show', compact('domaine'));
    }
}
