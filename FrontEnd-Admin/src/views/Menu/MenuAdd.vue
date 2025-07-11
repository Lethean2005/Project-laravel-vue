<template>
  <div class="p-6 max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Add New Menu</h2>

    <form @submit.prevent="addMenu" class="space-y-3">
      <input v-model="form.name" placeholder="Menu Name" class="w-full border px-3 py-2" />
      <input v-model="form.description" placeholder="Description" class="w-full border px-3 py-2" />
      <input v-model.number="form.price" placeholder="Price" class="w-full border px-3 py-2" />

      <!-- 👇 File Upload Input -->
      <input type="file" @change="handleImageUpload" class="w-full border px-3 py-2" />

      <button class="bg-green-600 text-white px-4 py-2 rounded">Add</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const categories = ref([])

const form = ref({
  name: '',
  description: '',
  price: 0,
  image: null, // will store the File object
  category_id: ''
})

// 👇 Fetch category list from backend
const getCategories = async () => {
  const res = await axios.get('http://localhost:8000/api/categories')
  categories.value = res.data
}

// 👇 Handle file selection
const handleImageUpload = (event) => {
  form.value.image = event.target.files[0]
}

// 👇 Submit form with FormData
const addMenu = async () => {
  const formData = new FormData()
  formData.append('name', form.value.name)
  formData.append('description', form.value.description)
  formData.append('price', form.value.price)
  formData.append('category_id', form.value.category_id)
  if (form.value.image) {
    formData.append('image', form.value.image)
  }

  await axios.post('http://localhost:8000/api/menus', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })

  router.push('/menu')
}

onMounted(() => {
  getCategories()
})
</script>
