<template>
  <div class="min-h-screen flex">
    <!-- Conditionally render NavBar -->
    <NavBar v-if="!isLoginPage" />
    <main class="flex-1 ml-64 md:ml-64">
      <RouterView />
    </main>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { computed } from 'vue'
import NavBar from '@/components/NavBar.vue'

const route = useRoute()
const isLoginPage = computed(() => route.path === '/login')
</script>

<style scoped>
@media (max-width: 768px) {
  main {
    margin-left: 0 !important;
  }
}
</style>
