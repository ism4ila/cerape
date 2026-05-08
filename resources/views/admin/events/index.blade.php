@extends('layouts.admin')

@section('header', 'Gestion de l\'Agenda')

@section('actions')
    <a href="{{ route('admin.events.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm text-white">
        <i class="fa-solid fa-plus me-2"></i> Nouvel Événement
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3">Événement</th>
                        <th class="border-0 py-3">Type</th>
                        <th class="border-0 py-3">Date & Heure</th>
                        <th class="border-0 py-3">Lieu</th>
                        <th class="border-0 py-3">Inscriptions</th>
                        <th class="border-0 py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="fw-bold">{{ $event->titre }}</div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 text-capitalize">{{ $event->type }}</span>
                            </td>
                            <td class="py-3 small text-secondary">
                                <i class="fa-regular fa-calendar me-1"></i> {{ $event->date_heure->format('d/m/Y') }}<br>
                                <i class="fa-regular fa-clock me-1"></i> {{ $event->date_heure->format('H:i') }}
                            </td>
                            <td class="py-3 small">
                                {{ $event->lieu }}
                            </td>
                            <td class="py-3 text-center">
                                @if($event->inscriptions_ouvertes)
                                    <span class="badge bg-success rounded-pill">Ouvertes</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">Fermées</span>
                                @endif
                                <div class="small text-muted mt-1">{{ $event->capacite_max > 0 ? $event->capacite_max . ' places' : 'Illimité' }}</div>
                            </td>
                            <td class="py-3 text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-light rounded-circle" title="Modifier" aria-label="Modifier l'evenement"><i class="fa-solid fa-pen text-info"></i></a>
                                    <x-modal-confirm id="delete-event-{{ $event->id }}" message="Supprimer cet evenement ?">
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
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
                            <td colspan="6" class="p-4">
                                <x-empty-state title="Aucun evenement enregistre" message="Ajoute un evenement pour alimenter l'agenda public." :action-href="route('admin.events.create')" action-label="Nouvel evenement" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($events->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $events->links() }}
        </div>
    @endif
</div>
@endsection
