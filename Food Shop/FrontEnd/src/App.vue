<template>
  <div>
    <!-- Only show NavBar if not on login page -->
    <NavBar v-if="!isLoginPage" />
    
    <RouterView />
    
    <!-- You can also hide Footer if needed -->
    <Footer />
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { computed } from 'vue'
import NavBar from '@/components/NavBar.vue'
import Footer from './components/Footer.vue'

const route = useRoute()
const isLoginPage = computed(() => route.path === '/login')
</script>
