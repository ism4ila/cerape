<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'auteur' => 'required|max:255',
            'categorie' => 'required|max:255',
            'image_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'statut' => 'required|in:brouillon,publie,archive',
            'date_publication' => 'nullable|date',
        ];
    }
}
