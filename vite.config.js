import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    watch: {
        usePolling: true,
        origin: 'http://192.168.0.72'
    },
    server: {
        hmr: {
            host: '192.168.0.72'
        }
    }


});
