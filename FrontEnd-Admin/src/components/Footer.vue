<template>
  <footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Logo / About -->
      <div>
        <h2 class="text-2xl font-bold text-white mb-2">SHV SHOP</h2>
        <p class="text-sm text-gray-400">
          Your trusted source for quality content and posts. Stay updated with the latest from our team.
        </p>
      </div>

      <!-- Navigation -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-3">Quick Links</h3>
        <ul class="space-y-2">
          <li><router-link to="/" class="hover:text-white transition">Home</router-link></li>
          <li><router-link to="/posts" class="hover:text-white transition">Posts</router-link></li>
          <li><router-link to="/about" class="hover:text-white transition">About</router-link></li>
          <li><router-link to="/contact" class="hover:text-white transition">Contact</router-link></li>
        </ul>
      </div>

      <!-- Social Media -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-3">Follow Us</h3>
        <div class="flex space-x-4">
          <a href="#" class="hover:text-white transition" aria-label="Facebook">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22 12.07C22 6.52 17.52 2 12 2S2 6.52 2 12.07c0 5.02 3.66 9.18 8.44 9.93v-7.02H8.08v-2.91h2.36V9.93c0-2.33 1.38-3.62 3.5-3.62.71 0 1.47.13 1.47.13v1.61h-.83c-.82 0-1.08.51-1.08 1.03v1.24h2.2l-.35 2.91h-1.85v7.02C18.34 21.25 22 17.09 22 12.07z" />
            </svg>
          </a>
          <a href="#" class="hover:text-white transition" aria-label="Twitter">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
            </svg>
          </a>
          <a href="#" class="hover:text-white transition" aria-label="Instagram">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm4.75-.75a1.25 1.25 0 110 2.5 1.25 1.25 0 010-2.5z" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="bg-gray-800 text-center text-sm text-gray-400 py-4">
      © 2025 SHV SHOP. All rights reserved.
    </div>
  </footer>
</template>

<script setup>
// No JS needed for this footer
</script>
