@extends('layouts.admin')

@section('header', 'Gestion des Actualités')

@section('actions')
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="fa-solid fa-plus me-2"></i> Nouvel Article
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3">Titre</th>
                        <th class="border-0 py-3">Catégorie</th>
                        <th class="border-0 py-3">Statut</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="fw-bold">{{ $article->titre }}</div>
                                <div class="small text-muted text-truncate" style="max-width: 300px;">{{ $article->slug }}</div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-light text-dark border">{{ $article->categorie }}</span>
                            </td>
                            <td class="py-3">
                                @if($article->statut == 'publie')
                                    <span class="badge bg-success bg-opacity-10 text-success">Publié</span>
                                @elseif($article->statut == 'brouillon')
                                    <span class="badge bg-warning bg-opacity-10 text-warning">Brouillon</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Archivé</span>
                                @endif
                            </td>
                            <td class="py-3 small text-secondary">
                                {{ $article->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-3 text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="btn btn-sm btn-light rounded-circle" title="Voir" aria-label="Voir l'article"><i class="fa-regular fa-eye text-primary"></i></a>
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-light rounded-circle" title="Modifier" aria-label="Modifier l'article"><i class="fa-solid fa-pen text-info"></i></a>
                                    <x-modal-confirm id="delete-article-{{ $article->id }}" message="Confirmer la suppression de cet article ?">
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="submit" variant="danger" size="sm">Supprimer</x-button>
                                        </form>
                                    </x-modal-confirm>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4">
                                <x-empty-state title="Aucun article enregistre" message="Cree ton premier article pour alimenter la section actualites." :action-href="route('admin.articles.create')" action-label="Nouvel article" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($articles->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
