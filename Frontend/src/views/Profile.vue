<template>
  <div class="max-w-xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6">User Profile</h2>

    <form @submit.prevent="updateProfile">
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Email</label>
        <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Bio</label>
        <textarea v-model="form.bio" class="w-full border rounded px-3 py-2" rows="4"></textarea>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">New Password (optional)</label>
        <input v-model="form.password" type="password" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Confirm Password</label>
        <input v-model="form.password_confirmation" type="password" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Profile Image</label>
        <input type="file" @change="onFileChange" accept="image/*" class="mb-2" />

        <!-- Preview new selected image -->
        <img
          v-if="previewImage"
          :src="previewImage"
          alt="Image Preview"
          class="w-32 h-32 object-cover rounded border mb-2"
        />

        <!-- Show current image if no new preview -->
        <img
          v-else-if="form.profile_image_url"
          :src="form.profile_image_url"
          alt="Current Profile"
          class="w-32 h-32 object-cover rounded border mb-2"
        />
      </div>

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        :disabled="loading"
      >
        {{ loading ? 'Saving...' : 'Save Changes' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/api'

const form = ref({
  name: '',
  email: '',
  bio: '',
  password: '',
  password_confirmation: '',
  profile_image_url: '',
})

const selectedFile = ref(null)
const previewImage = ref(null)
const loading = ref(false)

// Fetch user data
const fetchProfile = async () => {
  try {
    const res = await api.get('/profile')
    form.value.name = res.data.name
    form.value.email = res.data.email
    form.value.bio = res.data.bio || ''
    form.value.profile_image_url = res.data.profile_image_url || null
  } catch (err) {
    console.error('Failed to fetch profile:', err)
  }
}

// Handle image selection
const onFileChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    selectedFile.value = file
    previewImage.value = URL.createObjectURL(file)
  }
}

// Submit profile update
const updateProfile = async () => {
  loading.value = true

  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('email', form.value.email)
    formData.append('bio', form.value.bio)

    if (form.value.password) {
      formData.append('password', form.value.password)
      formData.append('password_confirmation', form.value.password_confirmation)
    }

    if (selectedFile.value) {
      formData.append('profile_image', selectedFile.value)
    }

    await api.post('/profile?_method=PUT', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    })

    alert('Profile updated successfully')
    selectedFile.value = null
    previewImage.value = null
    await fetchProfile()
  } catch (err) {
    console.error('Failed to update profile:', err)
    alert('Failed to update profile')
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchProfile()
})
</script>
