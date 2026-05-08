<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domaine;
use App\Models\Projet;
use App\Services\SlugService;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function __construct(private readonly SlugService $slugService)
    {
    }

    public function index()
    {
        $this->authorize('viewAny', Projet::class);
        $projets = Projet::with('domaineRelation')->latest()->paginate(10);

        return view('admin.projets.index', compact('projets'));
    }

    public function create()
    {
        $this->authorize('create', Projet::class);
        $domaines = Domaine::orderBy('nom')->get();

        return view('admin.projets.create', compact('domaines'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Projet::class);
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'domaine_id' => 'required|exists:domaines,id',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'beneficiaires' => 'required|integer|min:0',
            'statut' => 'required|in:en_cours,termine,planifie',
            'visible_public' => 'boolean',
        ]);

        $validated['slug'] = $this->slugService->makeUnique(Projet::class, $validated['titre']);

        $validated['visible_public'] = $request->has('visible_public');

        Projet::create($validated);

        return redirect()->route('admin.projets.index')->with('success', 'Projet créé avec succès.');
    }

    public function edit(Projet $projet)
    {
        $this->authorize('update', $projet);
        $domaines = Domaine::orderBy('nom')->get();

        return view('admin.projets.edit', compact('projet', 'domaines'));
    }

    public function update(Request $request, Projet $projet)
    {
        $this->authorize('update', $projet);
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'domaine_id' => 'required|exists:domaines,id',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'beneficiaires' => 'required|integer|min:0',
            'statut' => 'required|in:en_cours,termine,planifie',
            'visible_public' => 'boolean',
        ]);

        if ($validated['titre'] !== $projet->titre) {
            $validated['slug'] = $this->slugService->makeUnique(
                Projet::class,
                $validated['titre'],
                $projet->id
            );
        }

        $validated['visible_public'] = $request->has('visible_public');

        $projet->update($validated);

        return redirect()->route('admin.projets.index')->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Projet $projet)
    {
        $this->authorize('delete', $projet);
        $projet->delete();

        return redirect()->route('admin.projets.index')->with('success', 'Projet supprimé avec succès.');
    }
}
