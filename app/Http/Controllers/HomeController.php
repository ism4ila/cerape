<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Projet;
use App\Models\Stat;
use App\Models\Partenaire;
use App\Models\Faq;
use App\Models\Domaine;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = Stat::all();
        $partenaires = Partenaire::orderBy('ordre')->get();
        $domaines = Domaine::all();
        $latestArticles = Article::where('statut', 'publie')->latest('date_publication')->take(3)->get();
        $recentProjets = Projet::with('domaineRelation')
            ->where('visible_public', true)
            ->latest()
            ->take(3)
            ->get();
        
        return view('home', compact('stats', 'partenaires', 'domaines', 'latestArticles', 'recentProjets'));
    }

    public function about()
    {
        return view('about');
    }

    public function faq()
    {
        $faqs = Faq::orderBy('ordre')->get();
        return view('faq', compact('faqs'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function don()
    {
        return view('don');
    }
}
