<template>
  <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <!-- Left Side: Logo + Nav Links -->
    <div class="flex items-center space-x-6">
      <h1 class="text-2xl font-bold text-blue-600">My App</h1>
      <router-link to="/" class="nav-link">Home</router-link>
      <router-link to="/about" class="nav-link">About</router-link>
      <router-link to="/posts" class="nav-link">Post</router-link>
      <router-link to="/categories" class="nav-link">Category</router-link>
      <router-link to="/products" class="nav-link">Product</router-link>
    </div>

    <!-- Right Side: Auth Links + Profile -->
    <div class="flex items-center space-x-4 relative">
      <router-link to="/login" class="text-gray-600 hover:text-blue-600">Login</router-link>
      <router-link to="/register" class="text-gray-600 hover:text-blue-600">Register</router-link>

      <!-- Profile Dropdown -->
      <div class="flex items-center ms-3 relative">
        <div>
          <button
            @click="dropdownOpen = !dropdownOpen"
            type="button"
            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
          >
            <span class="sr-only">Open user menu</span>
            <img
              class="w-8 h-8 rounded-full"
              src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
              alt="user photo"
            />
          </button>
        </div>

        <!-- Dropdown Content -->
        <div
          v-show="dropdownOpen"
          class="absolute right-0 top-12 z-50 text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600"
          id="dropdown-user"
        >
          <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white">Neil Sims</p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300">
              neil.sims@flowbite.com
            </p>
          </div>
          <ul class="py-1" role="none">
            <li>
              <router-link
                to="/profile"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
              >
                Dashboard
              </router-link>
            </li>
            <li>
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
              >
                Settings
              </a>
            </li>
            <li>
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
              >
                Earnings
              </a>
            </li>
            <li>
              <button
                @click="logout"
                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-600"
              >
                Sign out
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '@/api';
import { useAuthStore } from '@/stores/auth';

// State for dropdown open/close
const dropdownOpen = ref(false);

// Vue Router and Auth Store
const router = useRouter();
const auth = useAuthStore();

// Logout function
const logout = async () => {
  try {
    await api.post('/logout');
  } catch (err) {
    console.warn('Logout failed or already logged out');
  }

  auth.logout();
  router.push('/login');
};
</script>

<style scoped>
.nav-link {
  @apply text-gray-700 hover:text-blue-600 font-medium;
}
</style>
