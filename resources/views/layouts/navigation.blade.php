<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/60 bg-white/75 backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/75">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-2xl bg-teal-500 text-white shadow-lg shadow-teal-500/20">
                            <i data-lucide="heart-pulse" class="h-5 w-5"></i>
                        </span>
                        <span class="hidden text-sm font-bold tracking-tight text-slate-900 dark:text-white md:block">MindCare</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex relative" id="desktop-nav-container">
                    <!-- Sliding Underline Indicator -->
                    <div id="nav-indicator" class="absolute bottom-0 h-0.5 bg-teal-600 dark:bg-teal-400 transition-all duration-300 ease-out pointer-events-none" style="left: 0; width: 0;"></div>

                    @auth
                        @if (Auth::user()->isAdmin())
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('admin.symptoms.index')" :active="request()->routeIs('admin.symptoms.*')">
                                Gejala
                            </x-nav-link>
                            <x-nav-link :href="route('admin.depressions.index')" :active="request()->routeIs('admin.depressions.*')">
                                Kategori Depresi
                            </x-nav-link>
                            <x-nav-link :href="route('admin.rules.index')" :active="request()->routeIs('admin.rules.*')">
                                Rule
                            </x-nav-link>
                            <x-nav-link :href="route('admin.recommendations.index')" :active="request()->routeIs('admin.recommendations.*')">
                                Rekomendasi
                            </x-nav-link>
                            <x-nav-link :href="route('admin.answer-options.index')" :active="request()->routeIs('admin.answer-options.*')">
                                Opsi Jawaban
                            </x-nav-link>
                            <x-nav-link :href="route('admin.diagnoses.index')" :active="request()->routeIs('admin.diagnoses.*')">
                                Laporan
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                Pengguna
                            </x-nav-link>
                        @endif
                    @endauth

                    @guest
                        <x-nav-link :href="route('user.home')" :active="request()->routeIs('user.home')">
                            Beranda
                        </x-nav-link>
                        <x-nav-link :href="route('user.about')" :active="request()->routeIs('user.about')">
                            Tentang Depresi
                        </x-nav-link>
                        <x-nav-link :href="route('user.diagnosis')" :active="request()->routeIs('user.diagnosis*')">
                            Diagnosis
                        </x-nav-link>
                        <x-nav-link :href="route('user.history')" :active="request()->routeIs('user.history')">
                            Riwayat
                        </x-nav-link>
                        <x-nav-link :href="route('user.emergency')" :active="request()->routeIs('user.emergency')">
                            Kontak Darurat
                        </x-nav-link>
                    @endguest
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <button
                    type="button"
                    class="me-3 inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white/80 text-slate-600 shadow-sm transition hover:-translate-y-0.5 hover:bg-teal-50 hover:text-teal-700 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
                    title="Toggle dark mode"
                    onclick="(() => { const el=document.documentElement; const isDark=el.classList.toggle('dark'); try{localStorage.setItem('theme', isDark?'dark':'light');}catch(_){}})()"
                >
                    <i data-lucide="moon" class="h-4 w-4"></i>
                </button>

                @auth
                    @if (Auth::user()->isAdmin())
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center rounded-full border border-slate-200 bg-white/80 px-3 py-2 text-sm font-medium leading-4 text-slate-600 shadow-sm transition hover:bg-white hover:text-slate-900 focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10 dark:hover:text-white">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    Dashboard Admin
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white/70 p-2 text-slate-500 transition hover:bg-white hover:text-slate-800 focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-white/60 bg-white/90 backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/95 sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.symptoms.index')" :active="request()->routeIs('admin.symptoms.*')">Gejala</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.depressions.index')" :active="request()->routeIs('admin.depressions.*')">Kategori Depresi</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.rules.index')" :active="request()->routeIs('admin.rules.*')">Rule</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.recommendations.index')" :active="request()->routeIs('admin.recommendations.*')">Rekomendasi</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.answer-options.index')" :active="request()->routeIs('admin.answer-options.*')">Opsi Jawaban</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.diagnoses.index')" :active="request()->routeIs('admin.diagnoses.*')">Laporan</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">Pengguna</x-responsive-nav-link>
                @endif
            @endauth

            @guest
                <x-responsive-nav-link :href="route('user.home')" :active="request()->routeIs('user.home')">Beranda</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.about')" :active="request()->routeIs('user.about')">Tentang Depresi</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.diagnosis')" :active="request()->routeIs('user.diagnosis*')">Diagnosis</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.history')" :active="request()->routeIs('user.history')">Riwayat</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.emergency')" :active="request()->routeIs('user.emergency')">Kontak Darurat</x-responsive-nav-link>
            @endguest
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-slate-200 pb-1 pt-4 dark:border-white/10">
            <div class="mt-3 space-y-1">
                <button
                    type="button"
                    class="w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800"
                    onclick="(() => { const el=document.documentElement; const isDark=el.classList.toggle('dark'); try{localStorage.setItem('theme', isDark?'dark':'light');}catch(_){}})()"
                >
                    Toggle Mode
                </button>

                @auth
                    @if (Auth::user()->isAdmin())
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-100">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</div>
                        </div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
