<x-layouts.app :title="__('Stream')">
    <div x-data="livekitRoom({
    token: @js($token),
    url: @js($livekitUrl),
    isHost: @js($isHost)
})"
    x-cloak
    class="relative min-h-sm mt-4 text-slate-100 font-sans antialiased selection:bg-red-500 selection:text-white">

    <header class="max-w-5xl mx-auto   border-b border-white/5 bg-slate-950 backdrop-blur-lg sticky top-0 z-40">
        <div class="px-4   py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="text-sm font-bold tracking-tighter italic">
                    <img src="/seed-images/pro-image.jpeg" alt=""
                        class="h-10 w-10 md:h-16 md:w-16 lg:h-20 lg:w-20 rounded-full"><span
                        class="text-red-500">live</span>
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

    <main class="mx-auto max-w-5xl  py- pb-36">
        {{-- max-w-[1600px]  --}}

        <div class="grid grid-cols-1  gap-6">
            {{-- xl:grid-cols-12 --}}

            <!-- ================================= -->
            <!-- MAIN BROADCAST AREA -->
            <!-- ================================= -->

            <section class="xl:col-span-9 space-y-4">


                <div x-data="streamPlayer">

                    <div x-ref="fullscreenTarget" id="livekitPlayer" @dblclick="toggleFullscreen()"
                        class="relative h-[420px] md:h-[560px] w-full overflow-hidden rounded- border border-slate-700 bg-black shadow-2xl">

                        <div id="localVideo" class="absolute inset-0 z-0"></div>

                        <div id="remoteVideos" class="absolute inset-0 z-10"></div>

                        <!-- Live Badge -->

                        <div class="absolute top-5 left-5 z-50">

                            <div class="flex items-center gap-2 bg-black/70 backdrop-blur-lg px-4 py-2 rounded-full">

                                <div class="w-3 h-3 rounded-full"
                                    :class="isLive
                                        ?
                                        'bg-red-500 animate-pulse' :
                                        'bg-slate-500'">
                                </div>

                                <span class="font-bold text-xs tracking-widest uppercase">

                                    <span x-show="isLive">
                                        Live
                                    </span>

                                    <span x-show="!isLive">
                                        Offline
                                    </span>

                                </span>

                            </div>

                        </div>

                        <!-- Recording Badge -->

                        <div x-show="isRecording" class="absolute top-5 right-5 z-20">

                            <div class="bg-red-600 px-4 py-2 rounded-full flex items-center gap-2">

                                <div class="w-2 h-2 bg-white rounded-full animate-pulse">
                                </div>

                                REC
                            </div>

                        </div>



                        <button @click="toggleFullscreen()"
                            class="absolute bottom-5 right-5 z-50 rounded-xl
           bg-black/70 px-5 py-3 text-sm font-semibold
           text-white backdrop-blur transition
           hover:bg-black">

                            <span x-show="!isFullscreen">
                                ⛶ Fullscreen
                            </span>

                            <span x-show="isFullscreen">
                                ✕ Exit
                            </span>

                        </button>


                    </div>
                </div>

                <!-- Analytics Row -->

                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                    <div class="rounded-2xl border border-red-50 bg-slate-900 p-5 shadow-lg">

                        <p class="text-xs text-slate-400 uppercase">
                            Status
                        </p>

                        <p class="font-bold text-lg" x-text="recordingStatus">
                        </p>

                    </div>

                    <div class="rounded-2xl border border border-red-50 bg-slate-900 p-5 shadow-lg">

                        <p class="text-xs text-slate-400 uppercase">
                            Duration
                        </p>

                        <p class="font-bold text-lg font-mono" x-text="recordingDuration">
                        </p>

                    </div>

                    <div class="rounded-2xl border border border-red-50 bg-slate-900 p-5 shadow-lg">

                        <p class="text-xs text-slate-400 uppercase">
                            Participants
                        </p>

                        <p class="font-bold text-lg" x-text="participants.length">
                        </p>

                    </div>

                    <div class="rounded-2xl border border border-red-50 bg-slate-900 p-5 shadow-lg">

                        <p class="text-xs text-slate-400 uppercase">
                            Connection
                        </p>

                        <p class="font-bold text-lg" x-text="connectionState">
                        </p>

                    </div>

                </div>

            </section>

            <!-- ================================= -->
            <!-- RIGHT SIDEBAR -->
            <!-- ================================= -->

            {{-- <aside class="xl:col-span-3 space-y-4">

                <!-- Participants -->

                <div class="bg-slate-900 rounded-3xl border border-white/5">

                    <div class="p-4 border-b border-white/5">

                        <h3 class="font-bold">

                            Participants

                            <span class="text-red-500" x-text="participants.length">
                            </span>

                        </h3>

                    </div>

                    <div class="max-h-[250px] overflow-y-auto">

                        <template x-for="participant in participants" :key="participant.id">

                            <div class="p-4 flex justify-between border-b border-white/5">

                                <span x-text="participant.name">
                                </span>

                                <span class="text-green-400">
                                    Online
                                </span>

                            </div>

                        </template>

                    </div>

                </div>

                <!-- Chat -->

                <div class="bg-slate-900 rounded-3xl border border-white/5 h-[500px] flex flex-col overflow-hidden">

                    <div class="p-4 border-b border-white/5 shrink-0">
                        <h3 class="font-bold text-white">Live Chat</h3>
                    </div>
                      <div class="flex-1 min-h-0 flex flex-col">
                        @livewire('chat', ['room' => $stream->uuid])
                    </div> 


                </div>

            </aside> --}}

        </div>

    </main>


    <template x-if="isHost">

        <div class="fixed bottom-6 left-1/2 z-[9999] w-[95%] max-w-5xl -translate-x-1/2">

            <div
                class="rounded-3xl border border-slate-700/80
               bg-slate-900/90 backdrop-blur-xl
               shadow-2xl">

                <div class="flex flex-col md:flex-row items-center justify-between gap-5 p-5">

                    <!-- LEFT -->

                    <div class="flex items-center gap-6">

                        <div class="flex items-center gap-2">

                            <div class="h-3 w-3 rounded-full"
                                :class="isLive ? 'bg-red-500 animate-pulse' : 'bg-slate-500'">
                            </div>

                            <span class="font-semibold" x-text="isLive ? 'LIVE' : 'OFFLINE'">
                            </span>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-400">
                                Recording
                            </p>

                            <p class="font-mono" x-text="recordingDuration">
                            </p>

                        </div>

                    </div>

                    <!-- CENTER -->

                    <div class="flex items-center gap-3">

                        <button @click="isLive ? stopPublishing() : startPublishing()" :disabled="isConnecting"
                            class="rounded-xl bg-red-600 px-8 py-3 font-bold text-white transition hover:bg-red-500 disabled:opacity-50">

                            <span x-text="isLive ? 'Stop Broadcast' : 'Go Live'">
                            </span>

                        </button>

                        <button @click="toggleRecording()" :disabled="!isLive"
                            class="rounded-xl border border-slate-600 bg-slate-800 px-8 py-3 font-bold hover:bg-slate-700 disabled:opacity-40">

                            <span x-text="isRecording ? 'Stop Recording' : 'Record'">
                            </span>

                        </button>

                        <button @click="toggleFullscreen()"
                            class="rounded-xl border border-slate-600 bg-slate-800 px-6 py-3 hover:bg-slate-700">

                            Fullscreen

                        </button>

                    </div>

                    <!-- RIGHT -->

                    <template x-if="downloadUrl">

                        <div class="flex gap-3">

                            <a :href="cleanAudioUrl"
                                class="rounded-xl bg-emerald-600 px-5 py-3 font-semibold text-white hover:bg-emerald-500">

                                Audio

                            </a>

                            <button @click="forceDownload()"
                                class="rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-500">

                                Download

                            </button>

                        </div>

                    </template>

                </div>

            </div>

        </div>
    </template>


</div>


</x-layouts.app>
