<template>
    <side-bar/>
  <div class="product-container">
    <h2>Product List</h2>

    <div v-if="loading">Loading products...</div>
    <div v-else-if="products.length === 0">No products found.</div>

    <div v-else class="product-grid">
      <div v-for="product in products" :key="product.id" class="product-card">
        <img
          v-if="product.image"
          :src="`http://127.0.0.1:8000/storage/${product.image}`"
          alt="Product Image"
          class="product-image"
        />
        <h3>{{ product.name }}</h3>
        <p>{{ product.description }}</p>
        <strong>${{ product.price }}</strong>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import SideBar from '@/components/SideBar.vue'


const products = ref([])
const loading = ref(true)

const fetchProducts = async () => {
  try {
    const res = await axios.get('http://127.0.0.1:8000/api/products')
    products.value = res.data
  } catch (error) {
    console.error('Failed to fetch products:', error)
    products.value = []
  } finally {
    loading.value = false
  }
}

onMounted(fetchProducts)
</script>

<style scoped>
.product-container {
  padding: 1rem;
}

.product-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.product-card {
  border: 1px solid #ccc;
  border-radius: 0.5rem;
  padding: 1rem;
  width: 200px;
  background-color: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.product-image {
  width: 100%;
  height: 120px;
  object-fit: cover;
  border-radius: 0.5rem;
  margin-bottom: 0.5rem;
}
</style>
