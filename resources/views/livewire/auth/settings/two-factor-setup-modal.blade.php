<div
    x-data="{ isOpen: false }"
    x-on:start-two-factor-setup.window="isOpen = true"
    x-on:close-two-factor-modal.window="isOpen = false"
    x-on:keydown.escape.window="if (isOpen) { isOpen = false; $wire.closeModal(); }"
    class="relative z-50 font-sans"
    style="display: none;"
    x-show="isOpen"
    role="dialog"
    aria-modal="true"
    aria-labelledby="2fa-modal-title"
>
    <div 
        x-show="isOpen"
        x-transition.opacity.duration.200ms
        class="fixed inset-0 bg-zinc-950/80 backdrop-blur-sm"
    ></div>

    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto sm:p-6">
        <div 
            x-show="isOpen"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="isOpen = false; $wire.closeModal();"
            class="w-full max-w-md bg-white border shadow-xl border-zinc-300 rounded-none dark:bg-zinc-900 dark:border-zinc-700 overflow-hidden"
        >
            <div class="p-6 sm:p-8 space-y-8">
                
                <div class="text-center space-y-2">
                    <h3 id="2fa-modal-title" class="text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                        {{ $this->modalConfig['title'] }}
                    </h3>
                    <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                        {{ $this->modalConfig['description'] }}
                    </p>
                </div>

                @error('setupData')
                    <div class="p-4 border-l-4 border-red-600 bg-red-50 dark:bg-red-900/20">
                        <p class="text-sm font-bold text-red-900 dark:text-red-200">{{ $message }}</p>
                    </div>
                @enderror

                @if ($showVerificationStep)
                    <div class="space-y-6">
                        <div class="flex flex-col items-center justify-center">
                            <label for="otp_code" class="sr-only">{{ __('OTP Code') }}</label>
                            <input
                                id="otp_code"
                                type="text"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                maxlength="6"
                                wire:model="code"
                                autofocus
                                autocomplete="one-time-code"
                                class="w-48 px-4 py-3 text-2xl font-mono font-bold tracking-[0.5em] text-center uppercase border bg-zinc-50 border-zinc-300 rounded-none focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:bg-black dark:border-zinc-700 dark:text-white dark:focus:ring-white"
                            />
                        </div>

                        <div class="flex items-center gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                            <button
                                type="button"
                                wire:click="resetVerification"
                                class="flex-1 px-4 py-3 text-sm font-bold tracking-wide uppercase transition-colors border bg-white text-zinc-900 border-zinc-300 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:bg-zinc-800 dark:text-white dark:border-zinc-600 dark:hover:bg-zinc-700"
                            >
                                {{ __('Back') }}
                            </button>

                            <button
                                type="button"
                                wire:click="confirmTwoFactor"
                                x-bind:disabled="$wire.code.length < 6"
                                class="flex-1 px-4 py-3 text-sm font-bold tracking-wide text-white uppercase transition-colors bg-zinc-900 border border-transparent hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 disabled:opacity-50 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 dark:focus:ring-white"
                            >
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </div>

                @else
                    <div class="space-y-8">
                        
                        <div class="flex justify-center">
                            <div class="relative flex items-center justify-center p-4 bg-white border aspect-square w-52 border-zinc-300 dark:border-zinc-600">
                                @empty($qrCodeSvg)
                                    <div class="absolute inset-0 flex items-center justify-center bg-zinc-100 animate-pulse dark:bg-zinc-800">
                                        <svg class="w-8 h-8 text-zinc-400 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </div>
                                @else
                                    <div class="w-full h-full dark:invert dark:brightness-150">
                                        {!! $qrCodeSvg !!}
                                    </div>
                                @endempty
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
                                </div>
                                <div class="relative flex justify-center text-xs font-bold tracking-widest uppercase">
                                    <span class="px-2 bg-white text-zinc-500 dark:bg-zinc-900 dark:text-zinc-400">
                                        {{ __('Or enter code manually') }}
                                    </span>
                                </div>
                            </div>

                            <div
                                x-data="{
                                    copied: false,
                                    copy() {
                                        navigator.clipboard.writeText('{{ $manualSetupKey }}').then(() => {
                                            this.copied = true;
                                            setTimeout(() => this.copied = false, 2000);
                                        });
                                    }
                                }"
                                class="flex items-stretch w-full border border-zinc-300 dark:border-zinc-700 bg-zinc-50 dark:bg-black"
                            >
                                @empty($manualSetupKey)
                                    <div class="flex items-center justify-center w-full p-3">
                                        <span class="text-sm text-zinc-500">{{ __('Loading...') }}</span>
                                    </div>
                                @else
                                    <input
                                        type="text"
                                        readonly
                                        value="{{ $manualSetupKey }}"
                                        class="w-full p-3 text-sm font-mono tracking-widest text-center bg-transparent outline-none text-zinc-900 dark:text-zinc-100 selection:bg-zinc-300 dark:selection:bg-zinc-700"
                                    />
                                    <button
                                        type="button"
                                        @click="copy()"
                                        class="flex items-center justify-center px-4 transition-colors border-l border-zinc-300 dark:border-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-800 focus:outline-none"
                                        :aria-label="copied ? 'Copied to clipboard' : 'Copy setup key'"
                                    >
                                        <template x-if="!copied">
                                            <svg class="w-5 h-5 text-zinc-600 dark:text-zinc-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </template>
                                        <template x-if="copied">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                        </template>
                                    </button>
                                @endempty
                            </div>
                        </div>

                        <div class="pt-2">
                            <button
                                type="button"
                                wire:click="showVerificationIfNecessary"
                                wire:loading.attr="disabled"
                                class="w-full px-4 py-3 text-sm font-bold tracking-wide text-white uppercase transition-colors bg-zinc-900 border border-transparent hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 disabled:opacity-50 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 dark:focus:ring-white dark:focus:ring-offset-zinc-900"
                            >
                                {{ $this->modalConfig['buttonText'] }}
                            </button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>