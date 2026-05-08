@props([
    'id',
    'title' => 'Confirmer la suppression',
    'message' => 'Cette action est irreversible.',
    'confirmLabel' => 'Supprimer',
    'cancelLabel' => 'Annuler',
    'buttonClass' => 'btn btn-sm btn-light rounded-circle',
])

<div
    x-data="{
        open: false,
        trigger: null,
        focusables() {
            return [...$refs.panel.querySelectorAll('a, button, input:not([type=\'hidden\']), textarea, select, [tabindex]:not([tabindex=\'-1\'])')]
                .filter((el) => !el.hasAttribute('disabled'));
        },
        firstFocusable() { return this.focusables()[0]; },
        lastFocusable() { return this.focusables().slice(-1)[0]; },
        close() {
            this.open = false;
            if (this.trigger) {
                this.trigger.focus();
            }
        },
    }"
    class="inline"
>
    <button type="button" @click="trigger = $el; open = true; $nextTick(() => firstFocusable()?.focus())" class="{{ $buttonClass }}" aria-haspopup="dialog" aria-controls="{{ $id }}">
        <i class="fa-solid fa-trash text-danger" aria-hidden="true"></i>
    </button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" @keydown.escape.window="close()" id="{{ $id }}" role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">
        <div
            x-ref="panel"
            class="w-full max-w-md rounded-xl bg-white p-6 shadow-2xl"
            @keydown.tab.prevent="$event.shiftKey ? (document.activeElement === firstFocusable() ? lastFocusable()?.focus() : focusables()[focusables().indexOf(document.activeElement) - 1]?.focus()) : (document.activeElement === lastFocusable() ? firstFocusable()?.focus() : focusables()[focusables().indexOf(document.activeElement) + 1]?.focus())"
        >
            <h3 id="{{ $id }}-title" class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
            <p class="mt-2 text-sm text-slate-600">{{ $message }}</p>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" @click="close()">
                    {{ $cancelLabel }}
                </button>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
