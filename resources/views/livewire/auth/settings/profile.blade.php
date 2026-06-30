<section class="w-full max-w-5xl font-sans bg-white border border-zinc-200 dark:bg-zinc-900 dark:border-zinc-800">
    @include('partials.settings-heading')

    <h2 class="sr-only">{{ __('Profile settings') }}</h2>

    <div class="grid grid-cols-1 gap-6 p-6 border-t border-zinc-200 md:grid-cols-3 md:gap-8 md:p-8 dark:border-zinc-800">
        
        <div class="space-y-1">
            <h3 class="text-lg font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
                {{ __('Profile') }}
            </h3>
            <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400 max-w-xs">
                {{ __('Update your name and email address') }}
            </p>
        </div>

        <div class="md:col-span-2">
            <form wire:submit="updateProfileInformation" class="space-y-6">
                
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-bold tracking-wide text-zinc-900 uppercase dark:text-zinc-200">
                        {{ __('Name') }}
                    </label>
                    <input 
                        id="name"
                        wire:model="name" 
                        type="text" 
                        required 
                        autofocus 
                        autocomplete="name"
                        class="w-full px-4 py-3 text-sm border bg-zinc-50 border-zinc-300 rounded-none focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:bg-black dark:border-zinc-700 dark:text-white dark:focus:ring-white"
                    />
                    @error('name')
                        <p class="mt-2 text-xs font-semibold tracking-wide text-red-600 uppercase dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="email" class="block text-sm font-bold tracking-wide text-zinc-900 uppercase dark:text-zinc-200">
                        {{ __('Email') }}
                    </label>
                    <input 
                        id="email"
                        wire:model="email" 
                        type="email" 
                        required 
                        autocomplete="email"
                        class="w-full px-4 py-3 text-sm border bg-zinc-50 border-zinc-300 rounded-none focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:bg-black dark:border-zinc-700 dark:text-white dark:focus:ring-white"
                    />
                    @error('email')
                        <p class="mt-2 text-xs font-semibold tracking-wide text-red-600 uppercase dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                    @if ($this->hasUnverifiedEmail)
                        <div class="p-4 mt-4 border border-zinc-200 bg-zinc-100 dark:bg-zinc-800/60 dark:border-zinc-700">
                            <p class="text-sm text-zinc-800 dark:text-zinc-200">
                                {{ __('Your email address is unverified.') }}
                                <button 
                                    wire:click.prevent="resendVerificationNotification"
                                    class="inline-flex font-bold tracking-wide text-zinc-900 underline transition-colors hover:text-zinc-600 dark:text-white dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:focus:ring-white"
                                >
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-3 text-sm font-bold text-green-700 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <button 
                        type="submit" 
                        data-test="update-profile-button"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center w-full px-6 py-3 text-sm font-bold tracking-wide text-white uppercase transition-colors bg-zinc-900 border border-transparent sm:w-auto hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 dark:focus:ring-white dark:focus:ring-offset-zinc-900 disabled:opacity-50"
                    >
                        <span wire:loading.remove wire:target="updateProfileInformation">{{ __('Save') }}</span>
                        <span wire:loading wire:target="updateProfileInformation">{{ __('Saving...') }}</span>
                    </button>

                    <span 
                        x-data="{ shown: false, timeout: null }"
                        x-on:profile-updated.window="clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);"
                        x-show="shown"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="text-sm font-bold text-zinc-600 dark:text-zinc-400"
                        style="display: none;"
                    >
                        {{ __('Saved.') }}
                    </span>
                </div>
            </form>
        </div>
    </div>

    @if ($this->showDeleteUser)
        <div class="mt-10">
            <livewire:pages::settings.delete-user-form />
        </div>
    @endif
</section>