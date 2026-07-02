<div class="min-h-screen flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-100 font-sans text-black selection:bg-[#B80000] selection:text-white">
    <div class="w-full max-w-3xl">
        
        <div class="mb-10 text-left">
            <h2 class="text-4xl font-bold text-black mb-2 tracking-tight">Edit Your Profile</h2>
            <p class="text-lg text-gray-700">Update your account information and security settings.</p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
            <div class="mb-8 p-4 border-l-4 border-[#B80000] bg-white shadow-sm">
                <p class="text-base font-bold text-black flex items-center gap-3">
                    <svg class="h-5 w-5 text-[#B80000]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <?php echo e(session('status')); ?>

                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('password_status')): ?>
            <div class="mb-8 p-4 border-l-4 border-[#B80000] bg-white shadow-sm">
                <p class="text-base font-bold text-black flex items-center gap-3">
                    <svg class="h-5 w-5 text-[#B80000]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <?php echo e(session('password_status')); ?>

                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="space-y-10">
            <div class="bg-white border-t-8 border-[#B80000] shadow-sm p-6 sm:p-10">
                <h3 class="text-2xl font-bold text-black mb-8">Personal Information</h3>
                
                <form wire:submit="updateProfile" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-base font-bold text-black">Full Name</label>
                            <input wire:model="name" id="name" type="text" required 
                                   class="block w-full px-4 py-3 bg-white border border-gray-400 text-black rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm font-bold text-[#B80000]"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="space-y-2">
                            <label for="phone_number" class="block text-base font-bold text-black">Phone Number</label>
                            <input wire:model="phone_number" id="phone_number" type="tel" 
                                   class="block w-full px-4 py-3 bg-white border border-gray-400 text-black rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm font-bold text-[#B80000]"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-base font-bold text-black">Email Address</label>
                        <input wire:model="email" id="email" type="email" required 
                               class="block w-full px-4 py-3 bg-white border border-gray-400 text-black rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm font-bold text-[#B80000]"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-[#B80000] hover:bg-[#8A0000] text-white text-lg font-bold transition-colors rounded-none focus:outline-none focus:ring-4 focus:ring-gray-300">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white border-t-8 border-gray-800 shadow-sm p-6 sm:p-10">
                <h3 class="text-2xl font-bold text-black mb-8">Security Settings</h3>
                
                <form wire:submit="updatePassword" class="space-y-6">
                    <div class="space-y-2 max-w-md">
                        <label for="current_password" class="block text-base font-bold text-black">Current Password</label>
                        <input wire:model="current_password" id="current_password" type="password" 
                               class="block w-full px-4 py-3 bg-white border border-gray-400 text-black rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm font-bold text-[#B80000]"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="new_password" class="block text-base font-bold text-black">New Password</label>
                            <input wire:model="new_password" id="new_password" type="password" 
                                   class="block w-full px-4 py-3 bg-white border border-gray-400 text-black rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm font-bold text-[#B80000]"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="space-y-2">
                            <label for="new_password_confirmation" class="block text-base font-bold text-black">Confirm New Password</label>
                            <input wire:model="new_password_confirmation" id="new_password_confirmation" type="password" 
                                   class="block w-full px-4 py-3 bg-white border border-gray-400 text-black rounded-none focus:outline-none focus:border-black focus:ring-1 focus:ring-black">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-gray-900 hover:bg-black text-white text-lg font-bold transition-colors rounded-none focus:outline-none focus:ring-4 focus:ring-gray-300">
                            Update password
                        </button>
                    </div>
                </form>
            </div>

            <div class="pt-6 border-t border-gray-300">
                <a href="/account" class="text-base font-bold text-black hover:underline flex items-center gap-2 w-fit">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Return to Account Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\auth\profile-edit.blade.php ENDPATH**/ ?>