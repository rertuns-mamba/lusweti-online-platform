<header x-data="{ mobileMenuOpen: false, accountMenuOpen: false }" class="sticky top-0 z-50 w-full bg-white font-sans border-b border-gray-200">
    
    {{-- Main Top Bar --}}
    <div class="max-w-7xl mx-auto relative z-40 bg-white">
        <div class="flex h-14 sm:h-16 items-center justify-between border-b border-gray-100">
            
            {{-- Left: Mobile Toggle --}}
            <div class="flex items-center gap-4">
                @include('partials.site-header.mobile-toggle')
            </div>

            {{-- Center: Logo --}}
            <div class="flex-shrink-0">
                <a href="/" wire:navigate><img src="/logo.png" class="h-8"></a>
            </div>

            {{-- Right: Search & Auth (Unified Component) --}}
            <div class="flex items-center h-full">
                <livewire:frontend.navbar-actions /> 
            </div>
        </div>
    </div>

    {{-- Main Category Bar (Now Dynamic) --}}
    <nav class="border-b border-gray-100 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <livewire:frontend.header-navigation />
        </div>
    </nav>

    <livewire:frontend.breaking-news />
</header>