import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '0.0.0.0',
            // Add this line to specify HMR's port, ensuring it's the same as Vite's server port
            port: 5173, 
        },
        // Add this to allow cross-origin requests
        cors: true
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template:{
                transformAssetUrls:{
                    base: null,
                    includeAbsolute: false
                }
            }
        }),
    ],
});
