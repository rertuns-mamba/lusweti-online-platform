<section class="w-full max-w-5xl font-sans bg-white border border-red-200 dark:bg-zinc-900 dark:border-red-900/50">
    <div class="grid grid-cols-1 gap-6 p-6 border-t-4 border-red-600 md:grid-cols-3 md:gap-8 md:p-8">
        
        <div class="space-y-2 md:col-span-2">
            <h2 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
                {{ __('Delete Account') }}
            </h2>
            <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400 max-w-prose">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>

        <div class="flex items-start md:justify-end">
            <button 
                type="button" 
                data-test="delete-user-button"
                x-data
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold tracking-wide text-white uppercase transition-colors bg-red-700 border border-transparent hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 dark:focus:ring-offset-zinc-900"
            >
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                {{ __('Delete account') }}
            </button>
        </div>
    </div>

    <livewire:pages::settings.delete-user-modal />
</section>