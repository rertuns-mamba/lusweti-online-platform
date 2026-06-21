<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lusweti-online-center' }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Page-specific meta overrides --}}
    @yield('meta')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased">

    <livewire:global.page-header />
    <x-frontend.navbar />


    {{-- <livewire:frontend.navigation-menu :currentSlug="$slug ?? null" /> 

    <livewire:frontend.site-header />
    <livewire:frontend.page-header-meta /> --}}
    <main>
        {{ $slot }}
    </main>

    <livewire:frontend.global-page-footer /> 

    {{-- Authentication Modals
    <livewire:auth.auth-modal /> --}}
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, Livewire:', typeof window.Livewire, 'Alpine:', typeof window.Alpine);

            // Bridge Alpine $dispatch events to Livewire
            window.addEventListener('open-auth-modal', function(e) {
                console.log('open-auth-modal event received', e.detail);
                if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                    window.Livewire.dispatch('open-auth-modal', e.detail || {});
                }
            });

            window.addEventListener('close-auth-modal', function(e) {
                console.log('close-auth-modal event received', e.detail);
                if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                    window.Livewire.dispatch('close-auth-modal', e.detail || {});
                }
            });
        });
    </script>


    <!-- TOGGLE LOGIC WITH SAFETY CHECKS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggler = document.getElementById('menu-toggler');
            const defaultNav = document.getElementById('default-nav');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Safety check: Only run if all three elements exist on the page
            if (menuToggler && defaultNav && dropdownMenu) {
                menuToggler.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');

                    if (dropdownMenu.classList.contains('hidden')) {
                        defaultNav.classList.remove('hidden');
                    } else {
                        defaultNav.classList.add('hidden');
                    }
                });
            } else {
                console.error('Menu toggler or navigation elements not found. Make sure IDs match.');
            }
        });
    </script>


    @stack('scripts')


    <livewire:article-preview-modal />

</body>

</html>