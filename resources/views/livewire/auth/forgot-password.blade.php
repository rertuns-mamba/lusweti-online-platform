<div class="min-h-[calc(100vh-120px)] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-neutral text-white selection:bg-red-600 selection:text-white">
    
    <div class="w-full max-w-md text-center">
        <div class="inline-block bg-neutral-800 text-neutral-300 px-3 py-1 text-[10px] font-black tracking-[0.2em] uppercase mb-4 shadow-sm border border-neutral-700">SYSTEM RECOVERY</div>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Reset Credentials</h2>
    </div>

    <div class="mt-8 w-full max-w-md">
        <div class="bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6 relative overflow-hidden w-full">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-neutral-500 to-neutral-700"></div>

            @if ($statusMessage)
                <div class="p-4 bg-emerald-950/30 border-l-2 border-emerald-500 text-[11px] uppercase font-bold tracking-widest text-emerald-400 flex items-center gap-3">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $statusMessage }}
                </div>
            @endif

            <form wire:submit="sendResetLink" class="space-y-6">
                <div>
                    <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Linked Account Email</label>
                    <input wire:model="email" id="email" type="email" required 
                           class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                    @error('email') <p class="mt-2 text-[11px] font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-neutral-800 hover:bg-neutral-700 text-white text-[12px] font-black uppercase tracking-[0.2em] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-neutral-500 border border-neutral-700">
                    Transmit Reset Link
                </button>
            </form>
            
            <div class="text-center pt-4 border-t border-neutral-800">
                <a href="/login" class="text-[11px] font-bold text-neutral-500 uppercase tracking-widest hover:text-neutral-300 transition-colors flex items-center justify-center gap-2">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Abort & Return to Login
                </a>
            </div>
        </div>
    </div>
</div>