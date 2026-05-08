<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::with('domaineRelation')->where('visible_public', true)->latest()->paginate(12);
        return view('projets.index', compact('projets'));
    }

    public function show($slug)
    {
        $projet = Projet::with('domaineRelation')->where('slug', $slug)->where('visible_public', true)->firstOrFail();
        return view('projets.show', compact('projet'));
    }
}
