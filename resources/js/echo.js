// resources/echo.js

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const scheme =
    import.meta.env.VITE_REVERB_SCHEME || (window.location.protocol === 'https:' ? 'https' : 'http');
const isSecure = scheme === 'https';
const reverbHost =
    import.meta.env.VITE_REVERB_HOST || window.location.hostname;

const wsPort = Number(
    import.meta.env.VITE_REVERB_WS_PORT ||
    import.meta.env.VITE_REVERB_PORT || 8080);
const wssPort = Number(
    import.meta.env.VITE_REVERB_WSS_PORT ||
    import.meta.env.VITE_REVERB_PORT || 443);

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: reverbHost,
    wsPort,
    wssPort,
    forceTLS: isSecure,
    encrypted: isSecure,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    activityTimeout: 30000,
    pongTimeout: 15000,
    unavailableTimeout: 10000,
});

console.log('Echo initialized successfully');