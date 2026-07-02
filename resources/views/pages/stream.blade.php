<x-layouts.app :title="__('Stream')">
    <div x-data="livekitRoom({
        token: @js($token),
        url: @js($livekitUrl),
        isHost: @js($isHost)
    })" x-cloak
        class="relative min-h-sm mt-2  text-slate-100 font-sans antialiased selection:bg-red-500 selection:text-white">

        <header
            class="max-w-4xl mx-auto px-4  mt-4  md:py-6 py-4 rounded-t-md  border-b border-white/5 bg-slate-950 backdrop-blur-lg sticky top-0 z-40">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="text-sm font-bold tracking-tighter italic">
                        <a href="/general-sports" class="">
                            <img src="{{ asset('storage/seed-images/lusweti_edited.png') }}" alt=""
                                class="h-10 w-10 md:h-12 md:w-12  rounded-full">
                        </a>


                    </div>
                    <div class="h-4 w-px bg-white/10"></div>
                    <div class="flex items-center gap-2 px-2 py-1 bg-white/5 rounded-md border border-white/5">
                        <div :class="{
                            'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)]': connectionState === 'connected',
                            'bg-amber-500 animate-pulse': connectionState === 'connecting',
                            'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.4)]': connectionState === 'disconnected'
                        }"
                            class="w-2 h-2 rounded-full transition-all duration-300"></div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-400"
                            x-text="connectionState"></span>
                    </div>
                </div>

                <button @click="window.location.reload()"
                    class="text-[10px] font-bold tracking-widest text-slate-500 hover:text-white transition-colors uppercase bg-white/5 px-3 py-1 rounded hover:bg-white/10 border border-white/5">
                    [ RE-SYNC ]
                </button>
            </div>
        </header>



        <main class="mx-auto max-w-[1400px] px-4 md:px-6 ">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 -mb-1">

                <!-- ================================= -->
                <!-- LEFT SIDEBAR -->
                <!-- ================================= -->

                <!-- LEFT SIDEBAR -->
                <aside
                    class="hidden xl:block xl:col-span-2 sticky top-0 self-start
                   h-[calc(70vh-1rem)] overflow-y-auto
                   rounded-xl border border-slate-700 bg-slate-900">

                    <div class="p-4 md:p-10">
                        <p class="text-3xl text-red-500">Left Sidebar Content</p>

                        <!-- Your content -->
                    </div>

                </aside>



                <!-- ================================= -->
                <!-- MAIN BROADCAST AREA -->
                <!-- ================================= -->
                <section class="xl:col-span-8 space-y-8">

                    <div x-data="streamPlayer({ playbackUrl: @js($srsPlaybackUrl ?? '') })" class="pb-4">

                        <div x-ref="fullscreenTarget" id="livekitPlayer" wire:ignore @dblclick="toggleFullscreen()"
                            class="relative w-full overflow-hidden rounded border border-slate-700 bg-black shadow-2xl
           aspect-video
           min-h-[240px]
           max-h-[85vh]">
                            <div id="localVideo" class="absolute inset-0 w-full h-full">
                            </div>

                            <div id="remoteVideos" class="absolute inset-0 w-full h-full">
                            </div>
                            <div class="absolute top-5 left-3 z-20">
                                <div
                                    class="flex items-center gap-2 bg-black/70 backdrop-blur-lg px-4 py-2 rounded-full">
                                    <div class="w-3 h-3 rounded-full"
                                        :class="isLive ? 'bg-red-500 animate-pulse' : 'bg-slate-500'">
                                    </div>
                                    <span class="font-bold text-xs tracking-widest uppercase">
                                        <span x-show="isLive">Live</span>
                                        <span x-show="!isLive">Offline</span>
                                    </span>
                                </div>
                            </div>

                            <div
                                class="absolute  top-1 right-3 z-20 pointer-events-none select-none opacity-40 hover:opacity-80 transition-opacity duration-300">
                                <div
                                    class="flex items-center gap-2 bg-slate-950/40 backdrop-blur-sm p-1.5 rounded-xl border border-white/5">
                                    <img src="{{ asset('storage/seed-images/black.jpg') }}" alt="Watermark"
                                        class="h-8 w-8 md:h-16 md:w-16 rounded-lg object-cover grayscale contrast-125">
                                </div>
                            </div>

                            <div x-show="isRecording" class="absolute     top-16 right-5 z-30 ">
                                <div
                                    class="bg-red-600 px-4 py-2 rounded-full flex items-center gap-2 text-xs font-bold tracking-wider">
                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                    REC
                                </div>
                            </div>




                            <button @click="toggleFullscreen()"
                                class="absolute bottom-5 right-5 z-50 rounded-xl bg-black/70 px-5 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-black">
                                <span x-show="!isFullscreen">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>

                                </span>
                                <span x-show="isFullscreen">✕ Exit</span>
                            </button>

                        </div>
                    </div>
                </section>



                <!-- ================================= -->
                <!-- RIGHT SIDEBAR -->
                <!-- ================================= -->

                <aside
                    class="hidden xl:block xl:col-span-2 sticky top-0 self-start
                   h-[calc(70vh-1rem)] overflow-y-auto
                   rounded-xl border border-slate-700 bg-slate-900">

                    <div class="p-4 md:p-10">
                        <p class="text-3xl text-red-500">Right Sidebar</p>

                        <!-- Your content -->
                    </div>

                </aside>

            </div>

        </main>



        <template x-if="isHost">
            <div
                class="fixed left-1/2 w-[95%] max-w-4xl  py-4  md:py-6 bottom-28  md:bottom-4  z-[9999]  -translate-x-1/2 font-sans text-slate-200">

                <div
                    class="rounded-b-md border border-slate-700/80 bg-slate-950 px-6 md:px-0 shadow-2xl shadow-black/50 backdrop-blur-xl">
                    <div class="flex flex-col items-center justify-center gap-4 p-2 md:flex-row md:justify-center">



                        <div class="flex w-full flex-wrap items-center justify-center gap-2 md:w-auto md:gap-3 mx-auto">

                            @if ($isHost)
                                <button
                                    @click="if (isLive) { stopPublishing(); const xhr = new XMLHttpRequest(); xhr.open('POST', '{{ route('stream.end', $stream->uuid) }}'); xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name=csrf-token]').content); xhr.onload = function() { console.log('Stream end API response:', xhr.status); }; xhr.onerror = function() { console.error('Stream end API failed'); }; xhr.send(); } else { startPublishing(); const xhr = new XMLHttpRequest(); xhr.open('POST', '{{ route('stream.start', $stream->uuid) }}'); xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name=csrf-token]').content); xhr.onload = function() { console.log('Stream start API response:', xhr.status); }; xhr.onerror = function() { console.error('Stream start API failed'); }; xhr.send(); }"
                                    class="group relative overflow-hidden rounded-2xl px-6 py-3 font-bold text-white transition-all active:scale-95 disabled:opacity-50 sm:px-8"
                                    :class="isLive ? 'bg-red-500/10 text-red-500 hover:bg-red-500/20 ring-1 ring-red-500/50' :
                                        'bg-red-600 hover:bg-red-500 ring-1 ring-red-500'">
                                    <span class="relative z-10 flex items-center gap-2">
                                        <svg x-show="!isLive" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5.828 15H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v2m-6.828 8H12m-6 4h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2m-4 8v-8" />
                                        </svg>

                                        <svg x-show="isLive" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                                        </svg>

                                        <span x-text="isLive ? 'Stop Broadcast' : 'Go Live'"></span>
                                    </span>
                                </button>
                            @endif

                            <button @click="toggleRecording()" :disabled="!isLive"
                                class="rounded-2xl border border-slate-600/50 bg-slate-800/80 px-6 py-3 font-semibold transition hover:bg-slate-700 active:scale-95 disabled:cursor-not-allowed disabled:opacity-40 sm:px-8">
                                <span x-text="isRecording ? 'Stop Recording' : 'Record'"></span>
                            </button>


                        </div>

                        <div class="flex w-full items-center justify-center md:w-auto gap-3">

                            <div x-data="{ showParticipants: false }" class="relative flex-1 md:flex-none">
                                <button @click="showParticipants = !showParticipants"
                                    @click.outside="showParticipants = false"
                                    class="flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-600/50 bg-slate-800/80 px-4 py-3 font-semibold transition hover:bg-slate-700 active:scale-95 md:w-auto">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="hidden md:block">Users</span>
                                    <span
                                        class="flex h-6 w-6 items-center justify-center rounded-full bg-red-500/20 text-xs font-bold text-red-400"
                                        x-text="participants.length"></span>
                                </button>

                                <div x-show="showParticipants" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 scale-95" style="display: none;"
                                    class="absolute bottom-[calc(100%+1rem)] left-0 md:left-auto md:right-0 w-full md:w-72 origin-bottom md:origin-bottom-right overflow-hidden rounded-2xl border border-slate-700/80 bg-slate-900/95 shadow-2xl shadow-black backdrop-blur-xl">

                                    <div
                                        class="flex items-center justify-between border-b border-white/10 bg-slate-800/30 px-4 py-3">
                                        <h3 class="font-bold text-slate-200">Session Roster</h3>
                                        <span class="text-xs font-medium text-slate-400"><span
                                                x-text="participants.length"></span> Online</span>
                                    </div>

                                    <div
                                        class="max-h-[300px] overflow-y-auto overscroll-contain p-2 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-slate-700 [&::-webkit-scrollbar-track]:bg-transparent">
                                        <template x-for="participant in participants" :key="participant.id">
                                            <div
                                                class="group flex items-center justify-between rounded-xl px-3 py-2.5 transition hover:bg-slate-800/60">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-700/50 text-slate-400 ring-1 ring-slate-600">
                                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-sm font-medium text-slate-200"
                                                        x-text="participant.name"></span>
                                                </div>

                                                <div
                                                    class="flex items-center gap-2 rounded-full bg-emerald-500/10 px-2 py-1 ring-1 ring-emerald-500/20">
                                                    <span class="relative flex h-1.5 w-1.5">
                                                        <span
                                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                                        <span
                                                            class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    </span>
                                                    <span
                                                        class="text-[10px] font-bold uppercase tracking-wider text-emerald-400">Live</span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <template x-if="downloadUrl">
                                <div class="flex flex-1 gap-2 md:flex-none md:gap-3">
                                    <a :href="cleanAudioUrl"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-2xl bg-emerald-500/10 px-4 py-3 font-semibold text-emerald-400 ring-1 ring-emerald-500/50 transition hover:bg-emerald-500/20 active:scale-95 md:flex-none md:px-5">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                    </a>
                                    <button @click="forceDownload()"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-2xl bg-blue-600 px-4 py-3 font-semibold text-white shadow-lg shadow-blue-900/20 transition hover:bg-blue-500 active:scale-95 md:flex-none md:px-5">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <script>
            window.addEventListener('beforeunload', function() {
                // sendBeacon requires FormData or a Blob for POST requests
                let data = new FormData();
                data.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                navigator.sendBeacon('{{ route('stream.end', $stream->uuid) }}', data);
            });
        </script>

    </div>

</x-layouts.app>





{{--  <!-- Participants -->

                

                <!-- Chat -->

                <div class="bg-slate-900 rounded-3xl border border-white/5 h-[500px] flex flex-col overflow-hidden">

                    <div class="p-4 border-b border-white/5 shrink-0">
                        <h3 class="font-bold text-white">Live Chat</h3>
                    </div>
                      <div class="flex-1 min-h-0 flex flex-col">
                        @livewire('chat', ['room' => $stream->uuid])
                    </div> 


                </div>   --}}
