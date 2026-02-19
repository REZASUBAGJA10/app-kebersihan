<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-center h-16">

            {{-- LOGO (KIRI) --}}
            <div class="absolute left-0 flex items-center h-16">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('img/logo_smk.png') }}" 
                         alt="Logo SMKN 1 Maja"
                         class="h-10 w-auto object-contain">
                    <span class="font-bold text-gray-800 text-lg">
                        SMKN 1 MAJA
                    </span>
                </a>
            </div>

            {{-- MENU NAV (TENGAH) --}}
            <div class="flex-1 hidden sm:flex justify-center space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')">
                    {{ __('Kelas') }}
                </x-nav-link>

                <x-nav-link :href="route('kriteria.index')" :active="request()->routeIs('kriteria.*')">
                    {{ __('Kriteria') }}
                </x-nav-link>

                <x-nav-link :href="route('penilaian.create')" :active="request()->routeIs('penilaian.create')">
                    {{ __('Input Penilaian') }}
                </x-nav-link>

                <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">
                    {{ __('Laporan') }}
                </x-nav-link>
            </div>

            {{-- USER DROPDOWN (KANAN) --}}
            <div class="absolute right-0 hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- HAMBURGER (MOBILE) --}}
            <div class="sm:hidden ml-auto">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>
