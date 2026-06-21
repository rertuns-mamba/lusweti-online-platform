<div class="flex flex-col h-full">
    {{-- Messages Container --}}
    <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chat-messages">
        @forelse($messages as $message)
            <div class="flex flex-col">
                <div class="flex items-baseline gap-2">
                    <span class="font-bold text-sm text-white">{{ $message['user'] }}</span>
                    <span class="text-xs text-slate-400">{{ $message['time'] }}</span>
                </div>
                <p class="text-sm text-slate-200 mt-1">{{ $message['text'] }}</p>
            </div>
        @empty
            <div class="text-center text-slate-500 text-sm py-8">
                No messages yet. Start the conversation!
            </div>
        @endforelse
    </div>

    {{-- Message Input --}}
    @if(auth()->check())
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
    @else
    <div class="p-4 border-t border-white/5 text-center">
        <a href="{{ route('login') }}" class="text-sm text-slate-400 hover:text-white transition-colors">
            Login to chat
        </a>
    </div>
    @endif
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
