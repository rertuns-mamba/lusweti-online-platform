// 







/**
 * 1. IMPORTS & DEPENDENCIES
 */
import './bootstrap'; // Configures Axios / Echo / Reverb
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import { createApp } from 'vue';
import LivestreamRoom from './components/LivestreamRoom.vue';

// Initialize Alpine Plugins
Alpine.plugin(persist);

/**
 * 2. VUE APPLICATION MOUNTING
 * Safely initializes Vue only if the target container exists on the current page
 */
const vueAppElement = document.getElementById('vue-app');
if (vueAppElement) {
    const app = createApp({});
    app.component('livestream-room', LivestreamRoom);
    app.mount('#vue-app');
}

/**
 * 3. GLOBAL HELPERS
 * Attached to window so they are accessible by standard inline blade/HTML attributes
 */
window.loadAd = (el) => {
    if (!el || el.dataset.loaded === 'true') return;
    const content = el.querySelector('[data-ad-content]');
    if (content) content.innerHTML = content.dataset.src || '';
    el.dataset.loaded = 'true';
};

window.dropdown = () => ({
    open: false,
    toggle() { this.open = !this.open },
    close() { this.open = false }
});

window.slider = () => ({
    current: 0,
    next() { this.current++ },
    prev() { this.current-- }
});

/**
 * 4. ALPINE.JS STORE & COMPONENTS
 * Defined inside the init listener before Alpine starts
 */
document.addEventListener('alpine:init', () => {

    // Global Store
    Alpine.store('nav', {
        mobileOpen: false,
        activeIndex: null,
        openMobile() {
            this.mobileOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeMobile() {
            this.mobileOpen = false;
            this.activeIndex = null;
            document.body.classList.remove('overflow-hidden');
        },
        toggleMobile() { this.mobileOpen ? this.closeMobile() : this.openMobile(); },
        setActive(i) { this.activeIndex = this.activeIndex === i ? null : i; },
        reset() { this.activeIndex = null; }
    });

    // LiveKit Room Component
    Alpine.data('livekitRoom', (config) => ({
        room: null,
        sdk: null,
        token: config.token,
        url: config.url,
        isHost: Boolean(config.isHost),
        connectionState: 'disconnected',
        isConnecting: false,
        isLive: false,
        reconnecting: false,
        participants: [],
        videoTrack: null,
        audioTrack: null,
        downloadUrl: null,
        isRecording: false,
        recordingStatus: 'Idle',
        recordingDuration: '00:00',
        recordingIntervalId: null,
        startTime: null,
        mediaRecorder: null,
        localRecordingStream: null,
        recordedChunks: [],
        cleanAudioUrl: null,
        recordingSessionId: null,
        uploadProgress: 0,
        chunksUploaded: 0,
        participantsCount: 0,
        micLevel: 0,
        mergeInProgress: false,
        cleanupInProgress: false,
        recordingDuration: '00:00:00',
        recordingIntervalId: null,
        startTime: null,

        async init() {
            try {
                this.sdk = await
                import ('https://cdn.jsdelivr.net/npm/livekit-client/dist/livekit-client.esm.mjs');
                const { Room, RoomEvent, ConnectionState, VideoPresets } = this.sdk;

                this.ConnectionState = ConnectionState;
                this.room = new Room({
                    adaptiveStream: true,
                    dynacast: true,
                    stopLocalTrackOnUnpublish: false,
                    publishDefaults: {
                        videoSimulcast: true,
                        videoCodec: 'vp8',
                        videoEncoding: VideoPresets.h720.encoding,
                    }
                });

                // --- Room Events ---
                this.room.on(RoomEvent.ConnectionStateChanged, async(state) => {
                    this.connectionState = state;
                    console.log('Connection:', state);

                    if (state === ConnectionState.Connected) {
                        if (this.reconnecting && this.isHost && this.videoTrack) {
                            await this.republishTracks();
                        }
                        this.reconnecting = false;
                    }

                    if (state === ConnectionState.Reconnecting) {
                        this.reconnecting = true;
                    }

                    if (state === ConnectionState.Disconnected) {
                        this.isLive = false;
                        this.isConnecting = false;
                        console.warn('LiveKit room disconnected. Verify your token, room name, and LiveKit server URL.');
                    }
                });

                this.room.on(RoomEvent.ConnectionError, (error) => {
                    console.error('LiveKit connection error:', error);
                });

                this.room.on(RoomEvent.TrackSubscribed, (track) => {
                    this.attachRemoteTrack(track);
                });

                this.room.on(RoomEvent.TrackUnsubscribed, (track) => {
                    track.detach().forEach(el => el.remove());
                    this.checkRemoteState();
                });

                this.room.on(RoomEvent.ParticipantConnected, (participant) => {
                    console.log('Participant joined:', participant.identity);
                    this.refreshParticipants();
                });

                this.room.on(RoomEvent.ParticipantDisconnected, (participant) => {
                    console.log('Participant left:', participant.identity);
                    this.refreshParticipants();
                });

                // --- Connect ---
                await this.room.connect(this.url, this.token);
                await Promise.resolve();
                this.refreshParticipants();
                console.log('✅ Connected');

            } catch (error) {
                console.error('INIT FAILED:', error);
            }
        },

        setupEchoListener() {
            if (window.Echo && this.recordingSessionId) {
                window.Echo.channel(`recording.${this.recordingSessionId}`)
                    .listen('.recording.ready', (event) => {
                        this.downloadUrl = event.downloadUrl;
                        this.triggerRobustDownload(event.downloadUrl, `Live-Session-${this.recordingSessionId}.webm`);
                    });
            }
        },

        refreshParticipants() {
            this.participants = [];
            this.room.remoteParticipants.forEach((participant) => {
                this.participants.push({
                    id: participant.sid,
                    name: participant.identity || participant.name || participant.sid
                });
            });
        },

        async startPublishing() {
            if (this.isConnecting || this.isLive) return;
            this.isConnecting = true;

            try {
                const { createLocalVideoTrack, createLocalAudioTrack } = this.sdk;
                await this.stopPublishing(true);

                this.videoTrack = await createLocalVideoTrack({
                    resolution: { width: 1280, height: 720, frameRate: 30 }
                });

                this.audioTrack = await createLocalAudioTrack({
                    echoCancellation: false,
                    noiseSuppression: false,
                    autoGainControl: false
                });

                this.attachLocalPreview();

                if (this.room.state !== this.ConnectionState.Connected) {
                    if (this.room.state === this.ConnectionState.Connecting) {
                        console.log('LiveKit is still connecting; waiting for connection before publishing.');
                        await new Promise((resolve, reject) => {
                            const onStateChange = (nextState) => {
                                if (nextState === this.ConnectionState.Connected) {
                                    clearTimeout(timeout);
                                    this.room.off(RoomEvent.ConnectionStateChanged, onStateChange);
                                    resolve();
                                }

                                if (nextState === this.ConnectionState.Disconnected) {
                                    clearTimeout(timeout);
                                    this.room.off(RoomEvent.ConnectionStateChanged, onStateChange);
                                    reject(new Error('LiveKit disconnected before publish'));
                                }
                            };

                            const timeout = setTimeout(() => {
                                this.room.off(RoomEvent.ConnectionStateChanged, onStateChange);
                                reject(new Error('LiveKit connect timed out before publish'));
                            }, 15000);

                            this.room.on(RoomEvent.ConnectionStateChanged, onStateChange);
                        });
                    } else {
                        await this.room.connect(this.url, this.token);
                    }
                }

                await this.room.localParticipant.publishTrack(this.videoTrack);
                await this.room.localParticipant.publishTrack(this.audioTrack);

                this.isLive = true;
                console.log('✅ LIVE');
            } catch (error) {
                console.error('START FAILED:', error);
                await this.stopPublishing(true);
            } finally {
                this.isConnecting = false;
            }
        },

        async stopPublishing(silent = false) {
            try {

                // Stop recording first
                if (this.isRecording) {

                    if (this.recordingIntervalId) {
                        clearInterval(this.recordingIntervalId);
                        this.recordingIntervalId = null;
                    }

                    if (
                        this.mediaRecorder &&
                        this.mediaRecorder.state !== 'inactive'
                    ) {
                        this.mediaRecorder.stop();
                    }

                    if (this.localRecordingStream) {
                        this.localRecordingStream
                            .getTracks()
                            .forEach(track => track.stop());

                        this.localRecordingStream = null;
                    }

                    this.isRecording = false;
                }

                // Stop LiveKit video track
                if (this.videoTrack) {

                    try {
                        await this.room.localParticipant.unpublishTrack(
                            this.videoTrack
                        );
                    } catch (e) {
                        console.warn('Video unpublish failed', e);
                    }

                    this.videoTrack.stop();

                    this.videoTrack
                        .detach()
                        .forEach(el => el.remove());

                    this.videoTrack = null;
                }

                // Stop LiveKit audio track
                if (this.audioTrack) {

                    try {
                        await this.room.localParticipant.unpublishTrack(
                            this.audioTrack
                        );
                    } catch (e) {
                        console.warn('Audio unpublish failed', e);
                    }

                    this.audioTrack.stop();

                    this.audioTrack = null;
                }

                // Reset UI state
                this.recordingDuration = '00:00:00';
                this.recordingIntervalId = null;
                this.startTime = null;

                this.clearLocalVideo();

                this.isLive = false;

                if (!silent) {
                    console.log('✅ STREAM STOPPED');
                }

            } catch (error) {

                console.error('STOP FAILED:', error);

            } finally {

                this.isConnecting = false;
            }
        },

        async republishTracks() {
            try {
                if (this.videoTrack) await this.room.localParticipant.publishTrack(this.videoTrack);
                if (this.audioTrack) await this.room.localParticipant.publishTrack(this.audioTrack);

                this.isLive = true;
                console.log('✅ TRACKS REPUBLISHED');
            } catch (e) {
                console.error('REPUBLISH FAILED', e);
            }
        },


        attachLocalPreview() {

            const container =
                document.getElementById('localVideo');

            if (!container || !this.videoTrack)
                return;

            container.innerHTML = '';

            const el =
                this.videoTrack.attach();

            el.className =
                'w-full h-full object-contain bg-black';

            el.autoplay = true;
            el.playsInline = true;
            el.muted = true;

            container.appendChild(el);
        },

        clearLocalVideo() {
            const container = document.getElementById('localVideo');
            if (container) container.innerHTML = '';
        },



        attachRemoteTrack(track) {

            if (track.kind !== 'video')
                return;

            const container =
                document.getElementById('remoteVideos');

            if (!container)
                return;

            container.innerHTML = '';

            const el =
                track.attach();

            el.className =
                'w-full h-full object-contain bg-black';

            el.autoplay = true;
            el.playsInline = true;

            container.appendChild(el);

            this.isLive = true;
        },
        checkRemoteState() {
            if (this.isHost) return;
            let hasVideo = false;

            this.room.participants.forEach(participant => {
                participant.trackPublications.forEach(pub => {
                    if (pub.kind === 'video') hasVideo = true;
                });
            });

            this.isLive = hasVideo;

            if (!hasVideo) {
                const container = document.getElementById('remoteVideos');
                if (container) {
                    container.innerHTML = `
                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                        Waiting for live stream...
                    </div>`;
                }
            }
        },

        setupAudioMeter(stream) {
            const audioContext = new AudioContext();
            const source = audioContext.createMediaStreamSource(stream);
            const analyser = audioContext.createAnalyser();
            source.connect(analyser);

            const data = new Uint8Array(analyser.frequencyBinCount);
            const loop = () => {
                analyser.getByteFrequencyData(data);
                const volume = data.reduce((a, b) => a + b) / data.length;
                this.micLevel = volume;
                requestAnimationFrame(loop);
            };
            loop();
        },

        async performRequest(url, formData) {
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (!metaTag) {
                console.error('CRITICAL ERROR: CSRF meta tag is missing. Check your layout file.');
                return;
            }

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': metaTag.content
                },
                body: formData
            });

            const data = await response.json();
            if (!response.ok) throw data;
            return data;
        },

        async toggleRecording() {
            if (!this.isRecording) {
                await this.startRecording();
            } else {
                await this.stopRecording();
            }
        },


        async startRecording() {
            try {
                // Reset state
                this.recordedChunks = [];
                this.downloadUrl = null;
                this.recordingDuration = '00:00:00';
                this.recordingStatus = 'Recording';

                // Clear old timer
                if (this.recordingIntervalId) {
                    clearInterval(this.recordingIntervalId);
                    this.recordingIntervalId = null;
                }

                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        width: 1280,
                        height: 720,
                        frameRate: 30,
                    },
                    audio: {
                        channelCount: 2,
                        echoCancellation: false,
                        noiseSuppression: false,
                        autoGainControl: false,
                    },
                });

                this.localRecordingStream = stream;

                this.mediaRecorder = new MediaRecorder(stream, {
                    mimeType: 'video/webm;codecs=vp8,opus',
                });

                this.mediaRecorder.ondataavailable = (event) => {
                    if (event.data && event.data.size > 0) {
                        this.recordedChunks.push(event.data);
                    }
                };

                this.mediaRecorder.onstop = () => {
                    try {
                        const blob = new Blob(this.recordedChunks, {
                            type: 'video/webm',
                        });

                        this.downloadUrl = URL.createObjectURL(blob);

                        this.recordingStatus = 'Ready To Download';

                        // Auto download
                        this.forceDownload();

                    } catch (error) {
                        console.error('Recording processing failed:', error);
                        this.recordingStatus = 'Processing Failed';
                    }
                };

                this.mediaRecorder.start();

                this.isRecording = true;

                this.startTime = Date.now();

                // Start duration timer
                this.recordingIntervalId = setInterval(() => {
                    const elapsed = Date.now() - this.startTime;

                    const hours = Math.floor(elapsed / 3600000);
                    const minutes = Math.floor((elapsed % 3600000) / 60000);
                    const seconds = Math.floor((elapsed % 60000) / 1000);

                    this.recordingDuration =
                        String(hours).padStart(2, '0') + ':' +
                        String(minutes).padStart(2, '0') + ':' +
                        String(seconds).padStart(2, '0');
                }, 1000);

            } catch (error) {
                console.error('Recording start failed:', error);
                this.recordingStatus = 'Failed';
            }
        },


        async stopRecording() {
            try {

                this.recordingStatus = 'Saving Recording...';

                // Stop timer
                if (this.recordingIntervalId) {
                    clearInterval(this.recordingIntervalId);
                    this.recordingIntervalId = null;
                }

                // Stop recorder
                if (
                    this.mediaRecorder &&
                    this.mediaRecorder.state !== 'inactive'
                ) {
                    this.mediaRecorder.stop();
                }

                // Stop camera/mic
                if (this.localRecordingStream) {
                    this.localRecordingStream
                        .getTracks()
                        .forEach(track => track.stop());

                    this.localRecordingStream = null;
                }

                this.isRecording = false;

            } catch (error) {
                console.error('Stop recording failed:', error);
                this.recordingStatus = 'Failed';
            }
        },

        async uploadChunk(chunk) {
            const formData = new FormData();
            formData.append('chunk', chunk);
            formData.append('sessionId', this.recordingSessionId);
            formData.append('participantId', this.room.localParticipant.sid);
            formData.append('startTime', this.startTime);

            try {
                await this.performRequest('/api/upload-chunk', formData);
            } catch (e) {
                console.error('Chunk upload failed', e);
            }
        },

        async finalizeUpload() {
            const formData = new FormData();
            formData.append('sessionId', this.recordingSessionId);
            formData.append('participantId', this.room.localParticipant.sid);
            formData.append('startTime', this.startTime);

            try {
                const data = await this.performRequest('/api/finalize-recording', formData);

                // Populate URLs returned immediately from the API
                if (data.download_url) {
                    this.cleanAudioUrl = data.download_url;
                    this.downloadUrl = data.download_url;
                    this.recordingStatus = 'Saved';

                    // Trigger download immediately
                    this.triggerRobustDownload(this.downloadUrl, `Live-Session-${this.recordingSessionId}.webm`);
                } else {
                    this.recordingStatus = 'Waiting for Processing...';
                }
            } catch (e) {
                this.recordingStatus = 'Error Finalizing';
                console.error('Finalization failed:', e);
            }
        },

        /**
         * ENGINEER CLASS DOWNLOAD:
         * Fetches the resource as a blob to force a programmatic download. 
         * Prevents the browser from opening media URLs natively in a new tab.
         */
        async triggerRobustDownload(url, filename = 'Session-Recording.webm') {
            if (!url) return;

            this.recordingStatus = 'Downloading...';

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Network response failed');

                const blob = await response.blob();
                const blobUrl = window.URL.createObjectURL(blob);

                const link = document.createElement('a');
                link.href = blobUrl;
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                setTimeout(() => window.URL.revokeObjectURL(blobUrl), 10000);
                this.recordingStatus = 'Saved & Downloaded';

            } catch (error) {
                console.warn("Blob download failed, falling back to standard anchor tag", error);

                // Fallback for CORS issues or massive files
                const link = document.createElement('a');
                link.href = url;
                link.download = filename;
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                this.recordingStatus = 'Saved';
            }
        },



        forceDownload() {

            if (!this.downloadUrl) {
                return;
            }

            const a = document.createElement('a');

            a.href = this.downloadUrl;

            a.download =
                `Recording-${new Date().toISOString().replace(/[:.]/g, '-')}.webm`;

            document.body.appendChild(a);

            a.click();

            document.body.removeChild(a);

            this.recordingStatus = 'Downloaded';

            // Cleanup memory
            URL.revokeObjectURL(this.downloadUrl);

            this.downloadUrl = null;
        }
    }));

    // Stream Player Component (Consolidated)
    Alpine.data('streamPlayer', () => ({

        streamUrl: '',
        isFullscreen: false,

        init() {
            this.registerFullscreenListeners();
        },

        /**
         * Resolve the fullscreen target.
         * Priority:
         * 1. x-ref="fullscreenTarget"
         * 2. x-ref="videoPlayer"
         * 3. #livekitPlayer
         */
        getTarget() {
            return (
                this.$refs.fullscreenTarget ||
                this.$refs.videoPlayer ||
                document.getElementById('livekitPlayer')
            );
        },

        /**
         * Enter fullscreen
         */
        async enterFullscreen() {

            const target = this.getTarget();

            if (!target) {
                console.warn('Fullscreen target not found');
                return;
            }

            try {

                if (target.requestFullscreen) {
                    await target.requestFullscreen();

                } else if (target.webkitRequestFullscreen) {
                    target.webkitRequestFullscreen();

                } else if (target.msRequestFullscreen) {
                    target.msRequestFullscreen();

                } else {
                    console.warn('Fullscreen API not supported');
                }

            } catch (error) {

                console.error('Enter fullscreen failed:', error);

            }
        },

        /**
         * Exit fullscreen
         */
        async exitFullscreen() {

            try {

                if (document.exitFullscreen) {
                    await document.exitFullscreen();

                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();

                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }

            } catch (error) {

                console.error('Exit fullscreen failed:', error);

            }
        },

        /**
         * Toggle fullscreen
         */
        async toggleFullscreen() {

            try {

                if (
                    document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.msFullscreenElement
                ) {

                    await this.exitFullscreen();

                } else {

                    await this.enterFullscreen();
                }

            } catch (error) {

                console.error('Toggle fullscreen failed:', error);

            }
        },

        /**
         * Keep Alpine state synchronized
         */
        registerFullscreenListeners() {

            const syncState = () => {

                this.isFullscreen = Boolean(
                    document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.msFullscreenElement
                );
            };

            document.addEventListener(
                'fullscreenchange',
                syncState
            );

            document.addEventListener(
                'webkitfullscreenchange',
                syncState
            );

            document.addEventListener(
                'MSFullscreenChange',
                syncState
            );
        },

        /**
         * Cleanup if Livewire destroys component
         */
        destroy() {

            document.removeEventListener(
                'fullscreenchange',
                this.syncState
            );

            document.removeEventListener(
                'webkitfullscreenchange',
                this.syncState
            );

            document.removeEventListener(
                'MSFullscreenChange',
                this.syncState
            );
        }

    }));

    // Sidebar Manager Component
    Alpine.data('sidebarManager', (config) => ({
        activeIndex: 0,
        isOpen: true,
        timer: null,
        queue: [],

        init() {
            const cfg = config || {};
            if (cfg.totalWidgets === 0) {
                this.isOpen = false;
                return;
            }
            this.buildQueue();
            this.startRotation();
        },

        buildQueue() {
            this.queue = [];
            if (!this.$el || !this.$el.children) return;

            Array.from(this.$el.children).forEach((el, idx) => {
                const dataset = el.dataset || {};
                const weight = parseInt(dataset.weight || 1, 10);
                for (let i = 0; i < weight; i++) {
                    this.queue.push(idx);
                }
            });
        },

        startRotation() {
            if (this.queue.length <= 1) return;
            this.stopRotation();

            const cfg = config || {};
            const duration = cfg.duration || 8000;
            this.timer = setInterval(() => this.rotate(), duration);
        },

        stopRotation() {
            if (this.timer) {
                clearInterval(this.timer);
            }
        },

        rotate() {
            if (this.queue.length === 0) return;
            this.queue.push(this.queue.shift());
            this.activeIndex = this.queue[0];
            this.trackImpression();
        },

        trackImpression() {
            if (!this.$el || !this.$el.children) return;

            const el = this.$el.children[this.activeIndex];
            if (!el || !el.dataset || !el.dataset.id) return;

            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

            fetch('/widget/impression', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ widget_id: el.dataset.id })
            }).catch((err) => console.error('Impression tracking failed:', err));
        },

        closeSidebar() {
            this.isOpen = false;
            this.stopRotation();
        }
    }));

    // Social Dock Component
    Alpine.data('socialDock', () => ({
        activeIndex: null,
        setFocus(i) { this.activeIndex = i; },
        reset() { this.activeIndex = null; },
        getStyle(i) {
            if (this.activeIndex === null) return '';
            const d = Math.abs(i - this.activeIndex);
            return d === 0 ? 'transform: scale(1.4);' : (d === 1 ? 'transform: scale(1.2);' : '');
        }
    }));

});

/**
 * 5. VUE.JS & EVENT LISTENERS
 * Listeners registered globally outside of Alpine's init flow
 */
document.addEventListener('livewire:navigated', () => {
    // Mount Vue App
    const streamContainer = document.getElementById('vue-stream-app');
    if (streamContainer && !streamContainer.__vue_app__) {
        const app = createApp(LivestreamRoom, {
            token: streamContainer.dataset.token,
            url: streamContainer.dataset.url,
            isHost: streamContainer.dataset.host === 'true',
            title: streamContainer.dataset.title,
            description: streamContainer.dataset.description,
        });
        app.mount(streamContainer);
        streamContainer.__vue_app__ = app;
    }
});

document.addEventListener('track-ga-event', (event) => {
    if (window.trackEvent && event.detail) {
        window.trackEvent(event.detail.name, event.detail.params);
    }
});

/**
 * 6. INITIALIZATION
 * Start Alpine after everything is fully loaded and structured
 */
window.Alpine = Alpine;
Alpine.start();