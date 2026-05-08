<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\SlugService;

class ArticleController extends Controller
{
    public function __construct(private readonly SlugService $slugService)
    {
    }

    public function index()
    {
        $this->authorize('viewAny', Article::class);
        $articles = Article::latest()->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);

        return view('admin.articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create', Article::class);
        $validated = $request->validated();
        $validated['slug'] = $this->slugService->makeUnique(Article::class, $validated['titre']);

        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', (string) $request->input('tags')));
        } else {
            $validated['tags'] = [];
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('admin.articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $validated = $request->validated();

        if ($validated['titre'] !== $article->titre) {
            $validated['slug'] = $this->slugService->makeUnique(
                Article::class,
                $validated['titre'],
                $article->id
            );
        }

        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', (string) $request->input('tags')));
        } else {
            $validated['tags'] = [];
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé avec succès.');
    }
}
