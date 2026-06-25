<div class="min-h-[calc(100vh-120px)] flex flex-col justify-center py-12 sm:px-6 lg:px-8  text-white selection:bg-red-600 selection:text-white"
     x-data="{ ... }"> <div class="sm:mx-auto w-full max-w-md text-center px-4">
        <div class="inline-block bg-red-600 text-white px-3 py-1 text-[10px] font-black tracking-[0.2em] uppercase mb-4 shadow-sm">LUSWETI ID</div>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Create an Engineer Profile</h2>
    </div>

    <div class="mt-8 sm:mx-auto w-full max-w-md px-4 sm:px-0">
        <div class="bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-600 to-red-900"></div>
            
            <form wire:submit="register" class="space-y-5">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Full Name</label>
                        <input wire:model="name" id="name" type="text" required 
                               class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                    </div>

                     <div>
                        <label for="phone_number" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Phone Number</label>
                        <input wire:model="phone_number" id="phone_number" type="tel" required 
                               class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Email Address</label>
                    <input wire:model="email" id="email" type="email" required 
                           class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Security Key</label>
                    <input wire:model="password" type="password" id="password" required 
                           class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner placeholder-neutral-600" placeholder="Minimum 8 characters">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Confirm Key</label>
                    <input wire:model="password_confirmation" type="password" id="password_confirmation" required 
                           class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-red-600 hover:bg-red-700 text-white text-[12px] font-black uppercase tracking-[0.2em] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-red-600 mt-2 shadow-lg shadow-red-900/20">
                    Initialize Profile
                </button>
            </form>

            <div class="relative flex py-1 items-center">
                <div class="flex-grow border-t border-neutral-800"></div>
                <span class="flex-shrink mx-4 text-neutral-600 text-[10px] font-black uppercase tracking-widest">OR</span>
                <div class="flex-grow border-t border-neutral-800"></div>
            </div>

            <a href="/auth/google" class="w-full flex items-center justify-center gap-3 py-3 px-4 bg-white hover:bg-neutral-100 text-neutral-900 text-[11px] font-bold uppercase tracking-widest transition-colors">
                Continue with Google
            </a>

            <div class="text-center pt-2">
                <p class="text-[11px] font-bold text-neutral-500 uppercase tracking-widest">
                    Already operational? 
                    <a href="/login" class="text-red-500 hover:text-red-400 hover:underline ml-1 transition-colors">Authenticate</a>
                </p>
            </div>
        </div>
    </div>
</div>