@extends('layouts.admin')

@section('header', 'Tableau de bord')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4 mb-6">
    <x-card title="Articles">
        <div class="text-3xl font-bold text-slate-900">{{ $articleCount }}</div>
    </x-card>
    <x-card title="Projets">
        <div class="text-3xl font-bold text-slate-900">{{ $projetCount }}</div>
    </x-card>
    <x-card title="Evenements">
        <div class="text-3xl font-bold text-slate-900">{{ $eventCount }}</div>
    </x-card>
    <x-card title="Contacts non lus">
        <div class="text-3xl font-bold text-slate-900">{{ $contactsNonLus }}</div>
    </x-card>
    <x-card title="Dons">
        <div class="text-3xl font-bold text-slate-900">{{ $donCount }}</div>
    </x-card>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2">
        <x-card title="5 derniers contacts">
            @if($recentContacts->isEmpty())
                <x-empty-state title="Aucun contact recent" message="Les derniers messages recus apparaitront ici." />
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-500 border-b">
                                <th class="py-2">Nom</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Sujet</th>
                                <th class="py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentContacts as $contact)
                                <tr class="border-b border-slate-100">
                                    <td class="py-2 font-medium text-slate-800">{{ $contact->nom }}</td>
                                    <td class="py-2 text-slate-600">{{ $contact->email }}</td>
                                    <td class="py-2 text-slate-600">{{ $contact->sujet }}</td>
                                    <td class="py-2 text-slate-500">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card>
    </div>

    <div class="space-y-4">
        <x-card title="Raccourcis">
            <div class="grid gap-2">
                <a href="{{ route('admin.articles.create') }}" class="rounded-lg bg-blue-700 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-800">Nouvel article</a>
                <a href="{{ route('admin.projets.create') }}" class="rounded-lg bg-emerald-700 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-800">Nouveau projet</a>
                <a href="{{ route('admin.events.create') }}" class="rounded-lg bg-indigo-700 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-800">Nouvel evenement</a>
                <a href="{{ route('admin.contacts.index') }}" class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Voir messages</a>
            </div>
        </x-card>
    </div>
</div>
@endsection
