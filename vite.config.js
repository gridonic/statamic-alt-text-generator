import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';

export default defineConfig({
  build: {
    manifest: false,
    outDir: 'dist',
    assetsDir: '',
    rollupOptions: {
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/js/alt-text-generator.js',
        'resources/css/alt-text-generator.css',
      ],
    }),
    vue(),
  ],

});
