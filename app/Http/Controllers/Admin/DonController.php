<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Don;
use Illuminate\Http\Request;

class DonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dons = Don::latest()->paginate(20);
        return view('admin.dons.index', compact('dons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $don = Don::findOrFail($id);
        
        $request->validate([
            'statut' => 'required|in:confirme,echec,en_attente',
        ]);

        $don->update([
            'statut' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Statut du don mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $don = Don::findOrFail($id);
        $don->delete();

        return redirect()->back()->with('success', 'Don supprimé avec succès.');
    }
}
