<template>
  <div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Menu</h2>

    <form @submit.prevent="updateMenu" class="space-y-4">
      <input
        v-model="form.name"
        placeholder="Menu Name"
        class="w-full border px-3 py-2 rounded"
        required
      />

      <input
        v-model="form.description"
        placeholder="Description"
        class="w-full border px-3 py-2 rounded"
      />

      <input
        v-model.number="form.price"
        placeholder="Price"
        type="number"
        min="0"
        step="0.01"
        class="w-full border px-3 py-2 rounded"
        required
      />

      <!-- Image preview and file input -->
      <div>
        <input type="file" @change="handleImageChange" class="w-full border px-3 py-2 rounded" />
        <div v-if="form.image_preview" class="mt-2">
          <img
            :src="form.image_preview"
            alt="Preview"
            class="w-32 h-32 rounded object-cover border"
          />
        </div>
      </div>

      <button class="bg-blue-600 text-white px-4 py-2 rounded" type="submit">
        Update
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const form = ref({
  name: '',
  description: '',
  price: 0,
  image: null, // file object
  image_preview: '', // image url string
})

// Fetch menu by ID
const getMenu = async () => {
  try {
    const res = await axios.get(`http://localhost:8000/api/menus/${route.params.id}`)
    form.value.name = res.data.name
    form.value.description = res.data.description
    form.value.price = res.data.price
    form.value.image_preview = res.data.image
    form.value.image = null
  } catch (error) {
    console.error('Failed to fetch menu:', error)
  }
}

// Handle image file input change
const handleImageChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.value.image = file
    form.value.image_preview = URL.createObjectURL(file)
  }
}

// Submit updated menu
const updateMenu = async () => {
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('description', form.value.description)
    formData.append('price', form.value.price)
    if (form.value.image) {
      formData.append('image', form.value.image)
    }

    // Use POST with _method=PUT for Laravel compatibility
    await axios.post(
      `http://localhost:8000/api/menus/${route.params.id}?_method=PUT`,
      formData,
      { headers: { 'Content-Type': 'multipart/form-data' } }
    )

    alert('Menu updated successfully!')
    router.push('/menu')
  } catch (error) {
    console.error('Failed to update menu:', error)
  }
}

onMounted(() => {
  getMenu()
})
</script>
