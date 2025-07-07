<!-- views/ProductPage.vue -->
<template>
  <div>
    <h2>Product Page</h2>
    <h2>Double Count:{{ store.db_count }}</h2>
    <button @click="store.increment" class="btn">Add Notification</button>
    {{ store }}
  </div>
</template>

<script setup>
import { useNotificationStore } from '@/stores/notification'
const store = useNotificationStore()
</script>

<style scoped>
.btn {
  margin-top: 1rem;
  padding: 10px 20px;
  background: #2196f3; 
  color: white;
  border: none;
  cursor: pointer;
}
</style>
