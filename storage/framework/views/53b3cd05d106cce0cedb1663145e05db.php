<div class="min-h-[calc(100vh-120px)] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 text-white selection:bg-red-600 selection:text-white">
    <div class="w-full max-w-md text-center">
        <div class="inline-block bg-red-600 text-white px-3 py-1 text-[10px] font-black tracking-[0.2em] uppercase mb-4 shadow-sm">Lusweti ID</div>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Sign in to your account</h2>
        <p class="mt-2 text-sm text-neutral-400 font-medium">Access your personalized news and settings</p>
    </div>

    <div class="mt-8 w-full max-w-md">
        <div class="bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6 relative overflow-hidden w-full">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-600 to-red-900"></div>
            
            <form wire:submit="authenticate" class="space-y-5">
                <div>
                    <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Email Address</label>
                    <input wire:model="email" id="email" type="email" autocomplete="email" required 
                           class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white placeholder-neutral-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-[11px] font-bold text-red-500 uppercase tracking-wider"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Password</label>
                    <input wire:model="password" id="password" type="password" autocomplete="current-password" required 
                           class="block w-full px-4 py-3 bg-neutral-950 border border-neutral-800 text-white placeholder-neutral-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 font-medium text-sm transition-all shadow-inner">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center cursor-pointer group">
                        <input wire:model="remember" type="checkbox" class="h-4 w-4 rounded-sm bg-neutral-950 border-neutral-700 text-red-600 focus:ring-red-600 focus:ring-offset-neutral-900 transition-colors">
                        <span class="ml-2 text-[11px] font-bold text-neutral-400 uppercase tracking-widest group-hover:text-neutral-300 transition-colors select-none">Keep me signed in</span>
                    </label>
                    <a href="/forgot-password" class="text-[11px] font-bold text-red-500 uppercase tracking-widest hover:text-red-400 transition-colors">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-red-600 hover:bg-red-700 text-white text-[12px] font-black uppercase tracking-[0.2em] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-red-600 shadow-lg shadow-red-900/20">
                    Secure Sign In
                </button>
            </form>

            <div class="relative flex py-3 items-center">
                <div class="flex-grow border-t border-neutral-800"></div>
                <span class="flex-shrink mx-4 text-neutral-600 text-[10px] font-black uppercase tracking-widest">Or continue with</span>
                <div class="flex-grow border-t border-neutral-800"></div>
            </div>

            <a href="/auth/google" class="w-full flex items-center justify-center gap-3 py-3 px-4 bg-white hover:bg-neutral-100 text-neutral-900 text-[11px] font-bold uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-white">
                <svg class="h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                </svg>
                Sign in with Google
            </a>

            <div class="text-center pt-2">
                <p class="text-[11px] font-bold text-neutral-500 uppercase tracking-widest">
                    New to Lusweti? 
                    <a href="/register" class="text-red-500 hover:text-red-400 hover:underline ml-1 transition-colors">Register Profile</a>
                </p>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>