<x-layouts.app :title="__('Stream')">
<div
    x-data="livekitRoom({ 
        token: @js($token), 
        url: @js($livekitUrl), 
        isHost: @js($isHost) 
    })"
    x-cloak
    class="relative min-h-screen bg-slate-700 text-slate-100 font-sans antialiased selection:bg-red-500 selection:text-white">

    <header class="max-w-[1600px] mx-auto px-4 lg:px-6 rounded-b-lg border-b border-white/5 bg-slate-950 backdrop-blur-lg sticky top-0 z-40">
        <div class=" px-4 sm:px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="text-sm font-bold tracking-tighter italic">
                    <img src="/seed-images/pro-image.jpeg" alt="" class="h-10 w-10 md:h-16 md:w-16 lg:h-20 lg:w-20 rounded-full"><span class="text-red-500">live</span>
                </div>
                <div class="h-4 w-px bg-white/10"></div>
                <div class="flex items-center gap-2 px-2 py-1 bg-white/5 rounded-md border border-white/5">
                    <div :class="{
                        'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)]': connectionState === 'connected',
                        'bg-amber-500 animate-pulse': connectionState === 'connecting',
                        'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.4)]': connectionState === 'disconnected'
                    }" class="w-2 h-2 rounded-full transition-all duration-300"></div>
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-400" x-text="connectionState"></span>
                </div>
            </div>

            <button @click="window.location.reload()" class="text-[10px] font-bold tracking-widest text-slate-500 hover:text-white transition-colors uppercase bg-white/5 px-3 py-1 rounded hover:bg-white/10 border border-white/5">
                [ RE-SYNC ]
            </button>
        </div>
    </header>

    <main class="max-w-[1600px] mx-auto   py-0.5">

        <div
            class="grid grid-cols-1 xl:grid-cols-12 gap-6">

            <!-- ================================= -->
            <!-- MAIN BROADCAST AREA -->
            <!-- ================================= -->

            <section
                class="xl:col-span-9 space-y-4">


                <div
                    x-data="streamPlayer">

                    <div
                        x-ref="fullscreenTarget"
                        id="livekitPlayer"
                        @dblclick="toggleFullscreen()"
                        class="relative aspect-video rounded-3xl overflow-hidden bg-black">



                        <div
                            id="localVideo"
                            class="w-full h-full">
                        </div>

                        <div
                            id="remoteVideos"
                            class="w-full h-full">
                        </div>

                        <!-- Live Badge -->

                        <div
                            class="absolute top-5 left-5 z-20">

                            <div
                                class="flex items-center gap-2 bg-black/70 backdrop-blur-lg px-4 py-2 rounded-full">

                                <div
                                    class="w-3 h-3 rounded-full"
                                    :class="isLive
                                ? 'bg-red-500 animate-pulse'
                                : 'bg-slate-500'">
                                </div>

                                <span
                                    class="font-bold text-xs tracking-widest uppercase">

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

                        <div
                            x-show="isRecording"
                            class="absolute top-5 right-5 z-20">

                            <div
                                class="bg-red-600 px-4 py-2 rounded-full flex items-center gap-2">

                                <div
                                    class="w-2 h-2 bg-white rounded-full animate-pulse">
                                </div>

                                REC
                            </div>

                        </div>



                        <button
                            @click="toggleFullscreen()"
                            class="absolute bottom-5 right-5 z-30">

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

                <div
                    class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <div
                        class="bg-slate-900 rounded-2xl p-4 border border-white/5">

                        <p class="text-xs text-slate-400 uppercase">
                            Status
                        </p>

                        <p
                            class="font-bold text-lg"
                            x-text="recordingStatus">
                        </p>

                    </div>

                    <div
                        class="bg-slate-900 rounded-2xl p-4 border border-white/5">

                        <p class="text-xs text-slate-400 uppercase">
                            Duration
                        </p>

                        <p
                            class="font-bold text-lg font-mono"
                            x-text="recordingDuration">
                        </p>

                    </div>

                    <div
                        class="bg-slate-900 rounded-2xl p-4 border border-white/5">

                        <p class="text-xs text-slate-400 uppercase">
                            Participants
                        </p>

                        <p
                            class="font-bold text-lg"
                            x-text="participants.length">
                        </p>

                    </div>

                    <div
                        class="bg-slate-900 rounded-2xl p-4 border border-white/5">

                        <p class="text-xs text-slate-400 uppercase">
                            Connection
                        </p>

                        <p
                            class="font-bold text-lg"
                            x-text="connectionState">
                        </p>

                    </div>

                </div>

            </section>

            <!-- ================================= -->
            <!-- RIGHT SIDEBAR -->
            <!-- ================================= -->

            <aside
                class="xl:col-span-3 space-y-4">

                <!-- Participants -->

                <div
                    class="bg-slate-900 rounded-3xl border border-white/5">

                    <div
                        class="p-4 border-b border-white/5">

                        <h3
                            class="font-bold">

                            Participants

                            <span
                                class="text-red-500"
                                x-text="participants.length">
                            </span>

                        </h3>

                    </div>

                    <div
                        class="max-h-[250px] overflow-y-auto">

                        <template
                            x-for="participant in participants"
                            :key="participant.id">

                            <div
                                class="p-4 flex justify-between border-b border-white/5">

                                <span
                                    x-text="participant.name">
                                </span>

                                <span
                                    class="text-green-400">
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
                        @livewire('sections.chat', ['room' => $stream->uuid])
                    </div>

                </div>

            </aside>

        </div>

    </main>
    <template x-if="isHost">
        <div class="fixed bottom-0 left-0 right-0 z-50 bg-slate-950/90 backdrop-blur-2xl border-t border-white/10 p-4">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row gap-6 items-center">

                <div class="flex gap-6 w-full md:w-auto">
                    <div class="flex flex-col">
                        <span class="text-[9px] uppercase tracking-widest text-slate-500 mb-1">Status</span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full" :class="isLive ? 'bg-red-500 animate-pulse' : 'bg-slate-700'"></div>
                            <span class="text-sm font-bold" x-text="isLive ? 'LIVE_MODE' : 'READY'"></span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[9px] uppercase tracking-widest text-slate-500 mb-1">Clock</span>
                        <span class="text-sm font-mono font-medium text-slate-300" x-text="recordingDuration"></span>
                    </div>
                </div>

                <div class="flex-1 flex gap-2 w-full md:w-auto">
                    <button
                        @click="isLive ? stopPublishing() : startPublishing()"
                        :disabled="isConnecting"
                        class="flex-1 md:flex-none md:w-32 px-4 py-3 rounded-lg font-black text-[10px] uppercase tracking-widest transition-all active:scale-95 disabled:opacity-50"
                        :class="isLive ? 'bg-white text-black hover:bg-slate-200' : 'bg-red-600 text-white hover:bg-red-500'">
                        <span x-text="isLive ? 'END' : 'BROADCAST'"></span>
                    </button>

                    <button
                        @click="toggleRecording()"
                        :disabled="!isLive"
                        class="flex-1 md:flex-none md:w-32 px-4 py-3 rounded-lg font-bold text-[10px] uppercase tracking-widest transition-all border disabled:opacity-30"
                        :class="isRecording ? 'bg-red-500/20 text-red-400 border-red-500/30' : 'bg-slate-800/50 text-slate-300 border-white/10 hover:bg-slate-800'">
                        <span x-text="isRecording ? 'STOP REC' : 'RECORD'"></span>
                    </button>
                </div>

                <template x-if="downloadUrl">
                    <div class="flex gap-2 w-full md:w-auto">
                        <a :href="cleanAudioUrl" class="px-4 py-3 rounded-lg bg-emerald-900/30 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-900/50 text-[10px] font-bold uppercase tracking-widest transition-all">Audio</a>
                        <button @click="forceDownload()" class="flex-1 px-4 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-500 text-[10px] font-bold uppercase tracking-widest transition-all shadow-[0_0_20px_rgba(37,99,235,0.3)]">Download Video</button>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>

</x-layouts.app>