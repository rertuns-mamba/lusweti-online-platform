<div 
    class="max-w-4xl bg-white border border-zinc-300 shadow-sm font-sans dark:bg-zinc-900 dark:border-zinc-700"
    wire:cloak
    x-data="{ showRecoveryCodes: false }"
>
    <div class="px-6 py-5 border-b border-zinc-200 dark:border-zinc-800">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-zinc-900 dark:text-zinc-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <h3 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                {{ __('2FA Recovery Codes') }}
            </h3>
        </div>
        <p class="mt-2 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400 max-w-prose">
            {{ __('Recovery codes let you regain access if you lose your 2FA device. Store them in a secure password manager.') }}
        </p>
    </div>

    <div class="px-6 py-5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <button
                    type="button"
                    x-show="!showRecoveryCodes"
                    @click="showRecoveryCodes = true"
                    aria-expanded="false"
                    aria-controls="recovery-codes-section"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-colors bg-zinc-900 hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 dark:focus:ring-white"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    {{ __('View recovery codes') }}
                </button>

                <button
                    type="button"
                    x-show="showRecoveryCodes"
                    @click="showRecoveryCodes = false"
                    aria-expanded="true"
                    aria-controls="recovery-codes-section"
                    x-cloak
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold transition-colors bg-white border border-zinc-300 text-zinc-900 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white dark:hover:bg-zinc-700"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    {{ __('Hide recovery codes') }}
                </button>
            </div>

            @if (filled($recoveryCodes))
                <button
                    type="button"
                    x-show="showRecoveryCodes"
                    wire:click="regenerateRecoveryCodes"
                    wire:loading.attr="disabled"
                    x-cloak
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold transition-colors bg-zinc-100 border border-zinc-200 text-zinc-900 hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 disabled:opacity-50 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white dark:hover:bg-zinc-700"
                >
                    <svg class="w-4 h-4" wire:loading.class="animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    {{ __('Regenerate codes') }}
                </button>
            @endif
        </div>

        <div
            id="recovery-codes-section"
            x-show="showRecoveryCodes"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            x-bind:aria-hidden="!showRecoveryCodes"
            class="pt-6 mt-6 border-t border-zinc-100 dark:border-zinc-800"
            x-cloak
        >
            @error('recoveryCodes')
                <div class="flex gap-3 p-4 mb-5 border-l-4 border-red-600 bg-red-50 text-red-900 dark:bg-red-900/20 dark:text-red-200" role="alert">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    <p class="text-sm font-medium">{{ $message }}</p>
                </div>
            @enderror

            @if (filled($recoveryCodes))
                <div 
                    class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 bg-zinc-50 border border-zinc-200 dark:bg-black dark:border-zinc-800"
                    role="list"
                    aria-label="{{ __('Recovery codes') }}"
                >
                    @foreach($recoveryCodes as $code)
                        <div
                            role="listitem"
                            class="px-3 py-2 font-mono text-sm tracking-widest transition-colors select-all text-zinc-800 hover:bg-zinc-200 dark:text-zinc-200 dark:hover:bg-zinc-800"
                            wire:loading.class="opacity-40 blur-[1px] transition-all duration-300"
                            wire:target="regenerateRecoveryCodes"
                        >
                            {{ $code }}
                        </div>
                    @endforeach
                </div>
                <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('Each recovery code can be used once to access your account and will be removed after use. If you need more, click Regenerate codes above.') }}
                </p>
            @endif
        </div>
    </div>
</div>