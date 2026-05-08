<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Projet;
use App\Models\Event;
use App\Models\Don;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $articleCount = Article::count();
        $projetCount = Projet::count();
        $eventCount = Event::count();
        $donCount = Don::count();
        $contactCount = Contact::count();
        $userCount = User::where('role', 'member')->count();
        $recentContacts = Contact::latest()->take(5)->get();
        $contactsNonLus = Contact::where('lu', false)->count();

        return view('admin.dashboard', compact(
            'articleCount', 'projetCount', 'eventCount', 
            'donCount', 'contactCount', 'userCount',
            'recentContacts', 'contactsNonLus'
        ));
    }
}
