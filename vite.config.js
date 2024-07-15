import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/media/app.js',
            ],
            refresh: true,
        }),

    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'
        },
    }
});