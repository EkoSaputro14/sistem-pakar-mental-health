<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script>
            (() => {
                try {
                    const stored = localStorage.getItem('theme');
                    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'dark' || (!stored && prefersDark)) {
                        document.documentElement.classList.add('dark');
                    }
                } catch (_) {}
            })();
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-950 dark:bg-slate-950 dark:text-slate-100">
        <div id="top-loading-bar"></div>
        <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(125,211,252,0.18),transparent_34rem),linear-gradient(180deg,#f8fafc_0%,#eef8f6_48%,#f8fafc_100%)] dark:bg-[radial-gradient(circle_at_top_left,rgba(14,165,233,0.14),transparent_34rem),linear-gradient(180deg,#020617_0%,#07111f_52%,#020617_100%)]">
            @include('layouts.navigation')

            <x-flash />

            <!-- Page Heading -->
            @isset($header)
                <header class="border-b border-white/60 bg-white/70 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/70">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="animate-page-fade-in">
                {{ $slot }}
            </main>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }

                // Sliding Underline Navigation Indicator
                const container = document.getElementById('desktop-nav-container');
                const indicator = document.getElementById('nav-indicator');
                if (container && indicator) {
                    const activeLink = container.querySelector('a.font-bold');
                    
                    const updateIndicator = (el) => {
                        if (el) {
                            const rect = el.getBoundingClientRect();
                            const containerRect = container.getBoundingClientRect();
                            indicator.style.left = (rect.left - containerRect.left) + 'px';
                            indicator.style.width = rect.width + 'px';
                        } else {
                            indicator.style.width = '0px';
                        }
                    };

                    // Initial position on load
                    setTimeout(() => {
                        if (activeLink) {
                            updateIndicator(activeLink);
                        }
                    }, 50);

                    // Resize listener
                    window.addEventListener('resize', () => {
                        if (activeLink) {
                            updateIndicator(activeLink);
                        }
                    });

                    // Hover/Click sliding listeners
                    const links = container.querySelectorAll('a');
                    links.forEach(link => {
                        link.addEventListener('mouseenter', () => {
                            updateIndicator(link);
                        });
                        link.addEventListener('mouseleave', () => {
                            updateIndicator(activeLink);
                        });
                        link.addEventListener('click', () => {
                            updateIndicator(link);
                        });
                    });
                }

                // Smooth top loading bar simulator for page transitions
                const loader = document.getElementById('top-loading-bar');
                if (loader) {
                    document.querySelectorAll('a').forEach(link => {
                        const href = link.getAttribute('href');
                        const target = link.getAttribute('target');
                        if (href && !href.startsWith('#') && !href.startsWith('javascript:') && target !== '_blank' && !link.hasAttribute('onclick')) {
                            link.addEventListener('click', () => {
                                loader.classList.add('top-loading-active');
                            });
                        }
                    });

                    window.addEventListener('pageshow', (event) => {
                        if (event.persisted) {
                            loader.classList.remove('top-loading-active');
                        }
                    });
                }
            });
        </script>
    </body>
</html>
