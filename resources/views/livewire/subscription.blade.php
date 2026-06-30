<div class="min-h-[80vh] flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-xl w-full bg-white border-t-8 border-[#B80000] shadow-sm">
        <div class="px-6 py-10 sm:px-12 sm:py-12">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-black mb-3">
                    Subscribe to News
                </h1>
                <p class="text-lg text-gray-700">
                    Stay updated with the latest headlines, sports updates, and exclusive content delivered directly to your inbox.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 border-l-4 border-[#B80000] bg-gray-50">
                    <p class="text-base font-bold text-black">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <form wire:submit="subscribe" class="space-y-6">
                <div class="space-y-2">
                    <label for="name" class="block text-base font-bold text-black">
                        Name
                    </label>
                    <input 
                        id="name"
                        wire:model="name" 
                        type="text" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 text-base border border-gray-400 bg-white rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black placeholder-gray-500"
                        placeholder="Your full name"
                    />
                    @error('name')
                        <p class="mt-2 text-sm font-bold text-[#B80000]">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="block text-base font-bold text-black">
                        Email Address
                    </label>
                    <input 
                        id="email"
                        wire:model="email" 
                        type="email" 
                        required 
                        autocomplete="email"
                        class="w-full px-4 py-3 text-base border border-gray-400 bg-white rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black placeholder-gray-500"
                        placeholder="you@example.com"
                    />
                    @error('email')
                        <p class="mt-2 text-sm font-bold text-[#B80000]">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="phone_number" class="block text-base font-bold text-black">
                        Phone Number
                    </label>
                    <input 
                        id="phone_number"
                        wire:model="phone_number" 
                        type="tel" 
                        required 
                        autocomplete="tel"
                        class="w-full px-4 py-3 text-base border border-gray-400 bg-white rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black placeholder-gray-500"
                        placeholder="+254 7XX XXX XXX"
                    />
                    @error('phone_number')
                        <p class="mt-2 text-sm font-bold text-[#B80000]">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-6">
                    <button 
                        type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full px-6 py-4 text-lg font-bold text-white transition-colors bg-[#B80000] hover:bg-[#8A0000] rounded-none focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span wire:loading.remove wire:target="subscribe">Subscribe now</span>
                        <span wire:loading wire:target="subscribe">Subscribing...</span>
                    </button>
                </div>
            </form>

            <div class="mt-10 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    By subscribing, you agree to receive marketing emails. You can unsubscribe at any time. Read our <a href="#" class="font-bold text-black hover:underline">Privacy Policy</a>.
                </p>
            </div>
            
        </div>
    </div>
</div>