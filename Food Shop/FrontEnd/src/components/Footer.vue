<template>
  <footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Logo / About -->
      <div>
        <h2 class="text-2xl font-bold text-white mb-2">Foodie</h2>
        <p class="text-sm text-gray-400">
          Your trusted source for quality products and exceptional service. Stay updated with the latest from our team.
        </p>
      </div>
      
      <!-- Navigation -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-3">Quick Links</h3>
        <ul class="space-y-2">
          <li><router-link to="/" class="hover:text-white transition">Home</router-link></li>
          <li><router-link to="/products" class="hover:text-white transition">Products</router-link></li>
          <li><router-link to="/categories" class="hover:text-white transition">Categories</router-link></li>
          <li><router-link to="/orders" class="hover:text-white transition">Orders</router-link></li>
          <li><router-link to="/dashboard" class="hover:text-white transition">Dashboard</router-link></li>
          <li><router-link to="/contact" class="hover:text-white transition">Contact</router-link></li>
        </ul>
      </div>
      
      <!-- Social Media & Contact -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-3">Follow Us</h3>
        <div class="flex space-x-4 mb-4">
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
          <a href="#" class="hover:text-white transition" aria-label="LinkedIn">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
          </a>
        </div>
        
        <!-- Contact Info -->
        <div>
          <p class="text-sm text-gray-400 mb-2">Contact Info:</p>
          <p class="text-sm text-gray-400 flex items-center mb-1">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
            </svg>
            info@shvshop.com
          </p>
          <p class="text-sm text-gray-400 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
            </svg>
            +1 (555) 123-4567
          </p>
        </div>
      </div>
    </div>
    
    <!-- Bottom Copyright Bar -->
    <div class="bg-gray-800 text-center text-sm text-gray-400 py-4">
      <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
        <p>© 2025 Foodie. All rights reserved.</p>
        <p class="mt-2 md:mt-0">Built with ❤️ for amazing customers</p>
      </div>
    </div>
  </footer>
</template>

<script setup>
// No JavaScript needed for this footer component
</script>

<style scoped>
/* Custom styles for smooth transitions */
.transition {
  transition: color 0.3s ease;
}

/* Hover effects for social icons */
a:hover svg {
  transform: scale(1.1);
  transition: transform 0.2s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .grid {
    gap: 2rem;
  }
}
</style>