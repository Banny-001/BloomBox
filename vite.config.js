import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'
import laravel from 'laravel-vite-plugin'  // Make sure this is imported

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/js/admin-dash/src/main.js',  
      refresh: true,
    }),
    vue(),  // Vue plugin
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './resources/js'),  // Resolve alias for your JS files
    },
  },
})
