<template>
  <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-6">
      <h1 class="text-2xl font-bold text-blue-600">My App</h1>
      <router-link to="/" class="nav-link">Home</router-link>
      <router-link to="/about" class="nav-link">About</router-link>
      <router-link to="/posts" class="nav-link">Post</router-link>
      <router-link to="/categories" class="nav-link">Category</router-link>
      <router-link to="/products" class="nav-link">Product</router-link>
    </div>

    <div class="flex items-center space-x-4">
      <router-link to="/login" class="text-gray-600 hover:text-blue-600"
        >Login</router-link
      >
      <router-link to="/register" class="text-gray-600 hover:text-blue-600"
        >Register</router-link
      >
      <button
        @click="logout"
        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
      >
        Logout
      </button>
    </div>
  </nav>
</template>

<script setup>
import { useRouter } from "vue-router";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();

const logout = async () => {
  try {
    await api.post("/logout"); // call Laravel Sanctum logout route
  } catch (err) {
    console.warn("Logout request failed or already logged out");
  }

  // Call Pinia logout to clear token and state
  auth.logout();

  // Redirect to login page
  router.push("/login");
};
</script>

<style scoped>
.nav-link {
  @apply text-gray-700 hover:text-blue-600 font-medium;
}
</style>
