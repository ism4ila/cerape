<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date_heure', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'type' => 'required|in:formation,sensibilisation,ag,commemoration,autre',
            'description' => 'required',
            'date_heure' => 'required|date',
            'lieu' => 'required|max:255',
            'capacite_max' => 'required|integer|min:0',
            'inscriptions_ouvertes' => 'boolean',
            'image_url' => 'nullable|url',
        ]);

        $validated['inscriptions_ouvertes'] = $request->has('inscriptions_ouvertes');

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Événement créé avec succès.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'type' => 'required|in:formation,sensibilisation,ag,commemoration,autre',
            'description' => 'required',
            'date_heure' => 'required|date',
            'lieu' => 'required|max:255',
            'capacite_max' => 'required|integer|min:0',
            'inscriptions_ouvertes' => 'boolean',
            'image_url' => 'nullable|url',
        ]);

        $validated['inscriptions_ouvertes'] = $request->has('inscriptions_ouvertes');

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Événement supprimé avec succès.');
    }
}
