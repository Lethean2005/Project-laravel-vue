<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit Product</h2>

    <input v-model="name" placeholder="Product Name" class="input" />
    <textarea v-model="description" placeholder="Description" class="input h-24"></textarea>
    <input v-model.number="price" type="number" step="0.01" placeholder="Price" class="input" />

    <div v-if="existingImage" class="mb-2">
      <label class="block mb-1 font-semibold">Current Image:</label>
      <img :src="existingImage" alt="Product image" class="w-40 rounded shadow" />
    </div>

    <label class="block mb-1 font-semibold">Change Image (optional):</label>
    <input type="file" @change="handleFileChange" class="input" />

    <button @click="updateProduct" class="btn mt-4">Update</button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '@/api'

const route = useRoute()
const router = useRouter()
const productId = route.params.id

const name = ref('')
const description = ref('')
const price = ref(0)
const existingImage = ref('')
const image = ref(null)

const fetchProduct = async () => {
  try {
    const res = await api.get(`/products/${productId}`)
    const product = res.data.data || res.data
    name.value = product.name
    description.value = product.description
    price.value = product.price
    existingImage.value = product.image_url
  } catch (err) {
    console.error('Failed to fetch product:', err)
  }
}

const handleFileChange = (event) => {
  image.value = event.target.files[0]
}

const updateProduct = async () => {
  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('description', description.value)
  formData.append('price', price.value)
  if (image.value) {
    formData.append('image', image.value)
  }

  try {
    await api.post(`/products/${productId}`, formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
      params: { _method: 'PUT' }, // Laravel needs this for form PUT
    })
    router.push('/products')
  } catch (err) {
    console.error('Update failed:', err)
  }
}

onMounted(fetchProduct)
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
