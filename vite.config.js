import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import sass from 'sass';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
	vue(),
    ],
    css: {
    	preprocessorOptions: {
      		sass: {
        		implementation: sass,
      		},
    	},
    },
});
