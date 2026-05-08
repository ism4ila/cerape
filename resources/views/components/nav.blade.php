<nav class="sticky top-0 z-40 border-b border-gray-100 bg-white" x-data="{ open: false }">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6 lg:px-16">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[--cerape-orange] text-white">
                <i class="fa-solid fa-book-open" aria-hidden="true"></i>
            </span>
            <span class="flex flex-col leading-tight">
                <span class="text-sm font-medium text-gray-900">{{ __('CERAPE') }}</span>
                <span class="text-xs text-gray-500">{{ __('Association') }}</span>
            </span>
        </a>

        <ul class="hidden items-center gap-6 lg:flex">
            <li>
                <a href="{{ route('home') }}" class="border-b-2 pb-1 text-sm {{ request()->routeIs('home') ? 'border-[--cerape-orange] text-[--cerape-orange]' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                    {{ __('Accueil') }}
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="border-b-2 pb-1 text-sm {{ request()->routeIs('about') ? 'border-[--cerape-orange] text-[--cerape-orange]' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                    {{ __('Qui sommes-nous') }}
                </a>
            </li>
            <li>
                <a href="{{ route('domaines.index') }}" class="border-b-2 pb-1 text-sm {{ request()->routeIs('domaines.*') ? 'border-[--cerape-orange] text-[--cerape-orange]' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                    {{ __('Domaines') }}
                </a>
            </li>
            <li>
                <a href="{{ route('projets.index') }}" class="border-b-2 pb-1 text-sm {{ request()->routeIs('projets.*') ? 'border-[--cerape-orange] text-[--cerape-orange]' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                    {{ __('Projets') }}
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="border-b-2 pb-1 text-sm {{ request()->routeIs('contact') ? 'border-[--cerape-orange] text-[--cerape-orange]' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                    {{ __('Contact') }}
                </a>
            </li>
        </ul>

        <div class="hidden lg:block">
            <a href="{{ route('don') }}" class="inline-flex items-center rounded-full bg-[--cerape-orange] px-5 py-2 text-sm text-white hover:opacity-90">
                {{ __('Faire un don') }}
            </a>
        </div>

        <button type="button" class="rounded-md p-2 text-gray-600 lg:hidden" @click="open = !open" :aria-expanded="open.toString()" aria-label="{{ __('Ouvrir le menu') }}">
            <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'" aria-hidden="true"></i>
        </button>
    </div>

    <div x-show="open" x-cloak class="fixed inset-0 z-30 bg-white lg:hidden" @click.outside="open = false">
        <div class="flex h-full flex-col gap-5 px-6 pt-24">
            <a href="{{ route('home') }}" class="text-base {{ request()->routeIs('home') ? 'text-[--cerape-orange]' : 'text-gray-600' }}">{{ __('Accueil') }}</a>
            <a href="{{ route('about') }}" class="text-base {{ request()->routeIs('about') ? 'text-[--cerape-orange]' : 'text-gray-600' }}">{{ __('Qui sommes-nous') }}</a>
            <a href="{{ route('domaines.index') }}" class="text-base {{ request()->routeIs('domaines.*') ? 'text-[--cerape-orange]' : 'text-gray-600' }}">{{ __('Domaines') }}</a>
            <a href="{{ route('projets.index') }}" class="text-base {{ request()->routeIs('projets.*') ? 'text-[--cerape-orange]' : 'text-gray-600' }}">{{ __('Projets') }}</a>
            <a href="{{ route('contact') }}" class="text-base {{ request()->routeIs('contact') ? 'text-[--cerape-orange]' : 'text-gray-600' }}">{{ __('Contact') }}</a>
            <a href="{{ route('don') }}" class="mt-2 inline-flex items-center justify-center rounded-full bg-[--cerape-orange] px-5 py-3 text-sm text-white">
                {{ __('Faire un don') }}
            </a>
        </div>
    </div>
</nav>
