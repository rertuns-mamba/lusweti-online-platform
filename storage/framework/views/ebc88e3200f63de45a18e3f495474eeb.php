<div class="flex flex-col h-full">
    
    <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chat-messages">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="flex flex-col">
                <div class="flex items-baseline gap-2">
                    <span class="font-bold text-sm text-white"><?php echo e($message['user']); ?></span>
                    <span class="text-xs text-slate-400"><?php echo e($message['time']); ?></span>
                </div>
                <p class="text-sm text-slate-200 mt-1"><?php echo e($message['text']); ?></p>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="text-center text-slate-500 text-sm py-8">
                No messages yet. Start the conversation!
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->check()): ?>
    <div class="p-4 border-t border-white/5">
        <form wire:submit="sendMessage" class="flex gap-2">
            <input
                type="text"
                wire:model="message"
                placeholder="Type a message..."
                class="flex-1 bg-slate-800/50 border border-white/10 rounded-lg px-4 py-2 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-white/30"
                maxlength="500"
            >
            <button
                type="submit"
                class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-lg text-sm font-bold transition-colors"
            >
                Send
            </button>
        </form>
    </div>
    <?php else: ?>
    <div class="p-4 border-t border-white/5 text-center">
        <a href="<?php echo e(route('login')); ?>" class="text-sm text-slate-400 hover:text-white transition-colors">
            Login to chat
        </a>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<script>
    // Auto-scroll to bottom when new messages are added
    document.addEventListener('chat-message-added', () => {
        const container = document.getElementById('chat-messages');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });

    // Scroll to bottom on initial load
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('chat-messages');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\frontend\chat.blade.php ENDPATH**/ ?>