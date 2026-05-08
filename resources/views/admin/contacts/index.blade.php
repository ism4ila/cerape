@extends('layouts.admin')

@section('header', 'Messages Reçus')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3">Expéditeur</th>
                        <th class="border-0 py-3">Sujet</th>
                        <th class="border-0 py-3">Statut</th>
                        <th class="border-0 py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="{{ $contact->lu ? 'opacity-75' : 'fw-bold border-start border-primary border-4' }}">
                            <td class="px-4 py-3">
                                <div>{{ $contact->nom }}</div>
                                <div class="small text-muted fw-normal">{{ $contact->email }}</div>
                            </td>
                            <td class="py-3">
                                <div class="text-truncate" style="max-width: 400px;">{{ $contact->sujet }}</div>
                                <div class="small text-secondary fw-normal text-truncate" style="max-width: 400px;">{{ $contact->message }}</div>
                            </td>
                            <td class="py-3">
                                @if($contact->lu)
                                    <span class="badge bg-light text-secondary rounded-pill">Lu</span>
                                @else
                                    <span class="badge bg-primary rounded-pill">Nouveau</span>
                                @endif
                            </td>
                            <td class="py-3 text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-light rounded-pill px-3" title="{{ $contact->lu ? 'Marquer non-lu' : 'Marquer lu' }}">
                                            <i class="fa-solid {{ $contact->lu ? 'fa-envelope' : 'fa-envelope-open' }} text-primary"></i>
                                        </button>
                                    </form>
                                    <x-modal-confirm id="delete-contact-{{ $contact->id }}" message="Supprimer ce message ?">
                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
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
                            <td colspan="4" class="p-4">
                                <x-empty-state title="Boite de reception vide" message="Aucun message n'a encore ete recu." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($contacts->hasPages())
        <div class="card-footer bg-white border-0 py-3">{{ $contacts->links() }}</div>
    @endif
</div>
@endsection
