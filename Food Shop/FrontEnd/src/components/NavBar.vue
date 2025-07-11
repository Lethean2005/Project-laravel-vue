<template>
  <nav
    class="bg-white/80 backdrop-blur-xl border-b border-gray-100/50 px-8 py-4 flex justify-between items-center sticky top-0 z-50 shadow-[0_4px_20px_rgba(0,0,0,0.05)]"
  >
    <!-- Logo + Nav Links -->
    <div class="flex items-center gap-12">
      <h1
        class="text-3xl font-bold tracking-tight bg-gradient-to-r from-violet-600 to-indigo-500 bg-clip-text text-transparent select-none"
      >
        Foodie
      </h1>

      <div class="hidden md:flex items-center gap-10">
        <router-link
          to="/"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Home
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>

        <router-link
          to="/about"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          About
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>

        <!-- <router-link
          to="/posts"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Posts
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>

        
        <router-link
          to="/categories"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Category
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>

        <router-link
          to="/products"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Products
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>
        <router-link
          to="/menu"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Menu
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link> -->
         <router-link
          to="/menu"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Menu
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>

        <router-link
          to="/contect"
          class="group relative font-medium text-gray-800 hover:text-violet-600 transition-colors duration-200 ease-out"
          active-class="text-violet-600"
        >
          Contact
          <span
            class="absolute bottom-0 left-0 w-0 h-0.5 bg-violet-500 rounded-full transition-all duration-300 ease-out group-hover:w-full"
          ></span>
        </router-link>
      </div>
    </div>

    <!-- User Dropdown -->
    <div class="relative">
      <button
        @click="toggleDropdown"
        class="flex items-center gap-2 text-violet-600 font-medium px-4 py-2 rounded-lg hover:bg-violet-50/50 transition-all duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-violet-300"
      >
        User
        <svg
          class="w-4 h-4 transform transition-transform duration-200"
          :class="{ 'rotate-180': isDropdownOpen }"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 9l-7 7-7-7"
          ></path>
        </svg>
      </button>

      <div
        v-if="isDropdownOpen"
        class="absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-md border border-gray-100/50 rounded-lg shadow-[0_10px_20px_rgba(0,0,0,0.1)] z-50 overflow-hidden"
      >
        <router-link
          to="/login"
          class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600 transition-all duration-150 ease-out"
          @click="closeDropdown"
        >
          Login
        </router-link>
        <router-link
          to="/register"
          class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600 transition-all duration-150 ease-out"
          @click="closeDropdown"
        >
          Register
        </router-link>
        <button
          @click="logout"
          class="block w-full text-left px-4 py-3 text-red-500 hover:bg-red-50/50 hover:text-red-600 transition-all duration-150 ease-out"
        >
          Logout
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();
const isDropdownOpen = ref(false);

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const closeDropdown = () => {
  isDropdownOpen.value = false;
};

const logout = async () => {
  try {
    await api.post("/logout");
  } catch (err) {
    console.warn("Logout request failed or already logged out");
  }

  auth.logout();
  router.push("/login");
  closeDropdown();
};
</script>

<style scoped>
.router-link-active:not(.router-link-exact-active) {
  color: #7C3AED; /* Violet-600 */
}

.router-link-active {
  font-weight: 600;
}
</style>
