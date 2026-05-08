@extends('layouts.admin')

@section('header', 'Gestion des Réalisations')

@section('actions')
    <a href="{{ route('admin.projets.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
        <i class="fa-solid fa-plus me-2"></i> Nouveau Projet
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3">Projet / Lieu</th>
                        <th class="border-0 py-3">Domaine</th>
                        <th class="border-0 py-3">Statut</th>
                        <th class="border-0 py-3">Bénéficiaires</th>
                        <th class="border-0 py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projets as $projet)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="fw-bold">{{ $projet->titre }}</div>
                                <div class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> {{ $projet->lieu }}</div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-info bg-opacity-10 text-info border-info border-opacity-25">{{ $projet->domaine }}</span>
                            </td>
                            <td class="py-3">
                                @if($projet->statut == 'termine')
                                    <span class="badge bg-success">Terminé</span>
                                @elseif($projet->statut == 'en_cours')
                                    <span class="badge bg-primary">En cours</span>
                                @else
                                    <span class="badge bg-warning text-dark">Planifié</span>
                                @endif
                            </td>
                            <td class="py-3 fw-bold text-cer-blue">
                                {{ number_format($projet->beneficiaires, 0, ',', ' ') }}
                            </td>
                            <td class="py-3 text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('projets.show', $projet->slug) }}" target="_blank" class="btn btn-sm btn-light rounded-circle" aria-label="Voir le projet"><i class="fa-regular fa-eye text-primary"></i></a>
                                    <a href="{{ route('admin.projets.edit', $projet->id) }}" class="btn btn-sm btn-light rounded-circle" aria-label="Modifier le projet"><i class="fa-solid fa-pen text-info"></i></a>
                                    <x-modal-confirm id="delete-projet-{{ $projet->id }}" message="Supprimer ce projet ?">
                                        <form action="{{ route('admin.projets.destroy', $projet->id) }}" method="POST">
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
                                <x-empty-state title="Aucun projet enregistre" message="Cree ton premier projet pour mettre en valeur vos realisations." :action-href="route('admin.projets.create')" action-label="Nouveau projet" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($projets->hasPages())
        <div class="card-footer bg-white border-0 py-3 text-center">
            {{ $projets->links() }}
        </div>
    @endif
</div>
@endsection
