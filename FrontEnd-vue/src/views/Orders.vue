<template>
    <side-bar/>
  <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Add New Category</h2>

    <form @submit.prevent="submitCategory">
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input v-model="form.name" type="text" class="w-full border px-3 py-2 rounded" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Slug</label>
        <input v-model="form.slug" type="text" class="w-full border px-3 py-2 rounded" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Image</label>
        <input type="file" @change="handleImageUpload" class="w-full" />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Description</label>
        <textarea v-model="form.description" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Status</label>
        <select v-model="form.status" class="w-full border px-3 py-2 rounded">
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Submit
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import SideBar from '@/components/SideBar.vue'

const form = ref({
  name: '',
  slug: '',
  image: null,
  description: '',
  status: 1,
})

const handleImageUpload = (e) => {
  form.value.image = e.target.files[0]
}

const submitCategory = async () => {
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('slug', form.value.slug)
    formData.append('image', form.value.image)
    formData.append('description', form.value.description)
    formData.append('status', form.value.status)

    const response = await axios.post('http://localhost:8000/api/categories', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })

    alert('Category added successfully!')
    // Optionally reset form here
  } catch (error) {
    console.error('Error submitting category:', error)
    alert('Failed to add category.')
  }
}
</script>

