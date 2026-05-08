<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Don;

class DonController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:100',
            'donateur' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'cause' => 'required|string|max:255',
            'moyen' => 'required|in:mtn,orange,cinetpay,virement,paypal',
        ]);

        $validated['devise'] = 'FCFA';
        $validated['statut'] = 'en_attente';
        $validated['date_don'] = now();

        Don::create($validated);

        return redirect()->back()->with('success', 'Merci pour votre générosité ! Votre don est en attente de confirmation.');
    }
}
