<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Add New Product</h2>

    <input v-model="name" placeholder="Product Name" class="input" />
    <textarea v-model="description" placeholder="Description" class="input h-24"></textarea>
    <input v-model.number="price" type="number" step="0.01" placeholder="Price" class="input" />
    <input type="file" @change="handleFileChange" class="input" />

    <button @click="createProduct" class="btn">Save</button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api' // your axios instance

const name = ref('')
const description = ref('')
const price = ref(0)
const image = ref(null)
const router = useRouter()

const handleFileChange = (event) => {
  image.value = event.target.files[0]
}

const createProduct = async () => {
  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('description', description.value)
  formData.append('price', price.value)
  if (image.value) {
    formData.append('image', image.value)
  }

  try {
    await api.post('/products', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })
    router.push('/products')
  } catch (error) {
    if (error.response?.data) {
      alert('Error: ' + JSON.stringify(error.response.data))
    } else {
      console.error('Unknown error:', error)
    }
  }
}
</script>

<style scoped>
.input {
  display: block;
  width: 100%;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 0.375rem;
}
.btn {
  background-color: #2563eb;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  cursor: pointer;
}
</style>
