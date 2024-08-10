import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/assets/dist/css/style.css',     // Add your custom css file
                'public/assets/dist/js/app.js',         // Add your custom js file
            ],
            refresh: true,
        }),
    ],
});
