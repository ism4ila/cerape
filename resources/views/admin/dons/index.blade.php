@extends('layouts.admin')

@section('header', 'Suivi des Dons')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3">Donateur</th>
                        <th class="border-0 py-3">Montant</th>
                        <th class="border-0 py-3">Cause / Projet</th>
                        <th class="border-0 py-3">Statut</th>
                        <th class="border-0 py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dons as $don)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="fw-bold">{{ $don->donateur }}</div>
                                <div class="small text-muted">{{ $don->email }}</div>
                            </td>
                            <td class="py-3">
                                <div class="fw-bold text-cer-blue">{{ number_format($don->montant, 0, ',', ' ') }} FCFA</div>
                                <div class="small text-secondary text-uppercase" style="font-size: 0.7rem;">via {{ $don->moyen }}</div>
                            </td>
                            <td class="py-3">
                                <span class="small">{{ $don->cause }}</span>
                            </td>
                            <td class="py-3">
                                @if($don->statut == 'confirme')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Confirmé</span>
                                @elseif($don->statut == 'en_attente')
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">En attente</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Échec</span>
                                @endif
                            </td>
                            <td class="py-3 text-end px-4">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        <li>
                                            <form action="{{ route('admin.dons.update', $don->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="statut" value="confirme">
                                                <button type="submit" class="dropdown-item text-success small fw-bold"><i class="fa-solid fa-check me-2"></i> Confirmer</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.dons.update', $don->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="statut" value="echec">
                                                <button type="submit" class="dropdown-item text-danger small fw-bold"><i class="fa-solid fa-xmark me-2"></i> Marquer échec</button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <x-modal-confirm id="delete-don-{{ $don->id }}" button-class="dropdown-item text-secondary small w-full text-start" message="Supprimer ce don ?">
                                                <form action="{{ route('admin.dons.destroy', $don->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="submit" variant="danger" size="sm">Supprimer</x-button>
                                                </form>
                                            </x-modal-confirm>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4">
                                <x-empty-state title="Aucun don enregistre" message="Les dons apparaitront ici apres validation." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($dons->hasPages())
        <div class="card-footer bg-white border-0 py-3">{{ $dons->links() }}</div>
    @endif
</div>
@endsection
