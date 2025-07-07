<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Add New Product</h2>

    <!-- Product Name -->
    <input v-model="name" placeholder="Product Name" class="input" />

    <!-- Description -->
    <textarea v-model="description" placeholder="Description" class="input h-24"></textarea>

    <!-- Price -->
    <input v-model.number="price" type="number" step="0.01" placeholder="Price" class="input" />

    <!-- Category Dropdown -->
    <select v-model="categoryId" class="input">
      <option disabled value="">Select a Category</option>
      <option v-for="category in categories" :key="category.id" :value="category.id">
        {{ category.name }}
      </option>
    </select>

    <!-- Image Upload -->
    <input type="file" @change="handleFileChange" class="input" />

    <!-- Submit Button -->
    <button @click="createProduct" class="btn">Save</button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api'

// Fields
const name = ref('')
const description = ref('')
const price = ref(0)
const image = ref(null)
const categoryId = ref('')
const categories = ref([])

const router = useRouter()

// Load all categories on form load
const fetchCategories = async () => {
  try {
    const res = await api.get('/categories')
    categories.value = res.data.data || res.data // supports both {data:[]} or []
  } catch (error) {
    console.error('Failed to fetch categories:', error)
  }
}

const handleFileChange = (event) => {
  image.value = event.target.files[0]
}

const createProduct = async () => {
  if (!name.value || !categoryId.value) {
    alert('Please enter product name and select a valid category.')
    return
  }

  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('description', description.value)
  formData.append('price', price.value)
  formData.append('category_id', Number(categoryId.value))
  if (image.value) {
    formData.append('image', image.value)
  }

  try {
    await api.post('/products', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    })
    router.push('/products')
  } catch (error) {
    console.error(error)
    if (error.response?.data) {
      alert('Error: ' + JSON.stringify(error.response.data))
    } else {
      alert('An unexpected error occurred.')
    }
  }
}

onMounted(() => {
  fetchCategories()
})
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
