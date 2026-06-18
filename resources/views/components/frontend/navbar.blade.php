<header class="bg-neutral-950 text-white relative z-50 border-b border-neutral-800 select-none">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">
            <div class="flex items-center gap-3 w-1/4 sm:w-1/3">
                <button id="menu-toggler" class="flex items-center gap-2 text-neutral-400 hover:text-red-500 transition-colors group p-1 -ml-1 focus:outline-none">
                    <svg class="h-6 w-6 sm:h-7 sm:w-7 group-hover:scale-105 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="hidden md:block text-sm font-bold uppercase tracking-widest group-hover:text-white transition-colors">
                        Menu
                    </span>
                </button>
            </div>

            <div class="flex justify-center items-center w-2/4 sm:w-1/3 text-center">
                <a href="/" class="flex items-center space-x-2 sm:space-x-4 group">
                    <div class="flex items-center space-x-[2px]">
                        <span class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">C</span>
                        <span class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">B</span>
                        <span class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">S</span>
                    </div>
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase border-l border-neutral-700 pl-2 sm:pl-4 hidden sm:inline text-neutral-300 group-hover:text-white transition-colors whitespace-nowrap">
                        {{ $brandName ?? 'Online Center' }}
                    </span>
                </a>
            </div>

            <div class="flex items-center justify-end gap-3 sm:gap-5 w-1/4 sm:w-1/3">

                <form action="{{ route('search') }}" method="GET" class="hidden lg:flex items-center">
                    <div class="flex items-center bg-neutral-900 border border-neutral-700 overflow-hidden focus-within:border-neutral-400 transition-colors">
                        <input type="text" name="query" placeholder="Search news..." class="w-32 xl:w-48 bg-transparent px-3 py-1.5 text-sm text-white placeholder-neutral-500 focus:outline-none">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 xl:h-5 xl:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 105.65 5.65a7.5 7.5 0 0010.6 10.6z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <button class="lg:hidden text-neutral-400 hover:text-red-500 transition-colors p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 105.65 5.65a7.5 7.5 0 0010.6 10.6z" />
                    </svg>
                </button>

                <div class="hidden sm:block h-6 w-px bg-neutral-800"></div>

                @auth
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none p-1 group">
                        <span class="text-xs sm:text-sm font-bold hidden md:inline-block tracking-wide text-neutral-300 group-hover:text-white transition-colors">
                            {{ Auth::user()->name }}
                        </span>

                        <div class="h-8 w-8 sm:h-9 sm:w-9 bg-neutral-800 border border-neutral-700 flex items-center justify-center overflow-hidden group-hover:border-red-600 transition-colors">
                            @if(Auth::user()->avatar_url)
                            <img src="{{ Auth::user()->avatar_url }}" alt="Profile Avatar" class="h-full w-full object-cover">
                            @else
                            <span class="text-xs font-black tracking-wider text-red-500 uppercase">{{ Auth::user()->initials }}</span>
                            @endif
                        </div>
                    </button>

                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-cloak
                        class="absolute right-0 mt-3 w-56 bg-neutral-950 border border-neutral-800 shadow-2xl z-50 py-1">

                        <div class="px-4 py-3 border-b border-neutral-900">
                            <p class="text-[10px] text-neutral-500 uppercase font-black tracking-widest mb-1">Account ID</p>
                            <p class="text-xs font-medium truncate text-neutral-300">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="/profile" class="block px-4 py-3 text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-neutral-900 hover:text-white hover:border-l-2 hover:border-red-600 transition-all">
                            Settings & Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="block border-t border-neutral-900">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-xs font-bold uppercase tracking-wider text-red-500 hover:bg-neutral-900 hover:text-red-400 transition-colors">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a href="{{ route('login') }}" class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-neutral-400 hover:text-white transition-colors hidden sm:flex">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Sign In
                    </a>
                </div>
                @endauth

            </div>
        </div>
    </div>
</header>

<nav id="default-nav" class="bg-white border-b border-gray-200 shadow-sm relative z-40 transition-all duration-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6 lg:gap-8 py-3 overflow-x-auto whitespace-nowrap scrollbar-hide text-[13px] md:text-sm font-bold uppercase tracking-widest text-gray-800">
            @foreach($pages as $page)
            @php
            // Intercept the 'home' slug to use the root URL and exact root request match
            $url = $page->slug === 'home' ? route('home') : route('page.show', $page->slug);
            $isActive = $page->slug === 'home' ? request()->is('/') : request()->is($page->slug);
            @endphp

            <a href="{{ $url }}" class="relative group hover:text-red-600 transition-colors pb-1 {{ $isActive ? 'text-red-600' : '' }}">
                {{ $page->title }}
                <span class="absolute bottom-0 left-0 w-full h-[3px] bg-red-600 transform origin-left transition-transform duration-200 {{ $isActive ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
            @endforeach
        </div>
    </div>
</nav>

<livewire:sections.breaking-news />

<nav id="dropdown-menu" class="hidden bg-neutral-100 border-b border-gray-300 shadow-inner absolute w-full z-30 transition-all duration-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-y-6 gap-x-8 text-[13px] md:text-sm font-bold uppercase tracking-wider">
            @foreach($pages as $page)
            @php
            $url = $page->slug === 'home' ? route('home') : route('page.show', $page->slug);
            $isActive = $page->slug === 'home' ? request()->is('/') : request()->is($page->slug);
            @endphp

            <a href="{{ $url }}"
                class="block text-gray-800 hover:text-red-600 border-l-[4px] border-transparent hover:border-red-600 pl-3 py-1.5 transition-all {{ $isActive ? 'text-red-600 border-red-600 bg-white shadow-sm' : 'hover:bg-white hover:shadow-sm' }}">
                {{ $page->title }}
            </a>
            @endforeach
        </div>
    </div>
</nav>