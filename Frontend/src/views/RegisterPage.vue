<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-sm p-8 bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Register</h2>

      <input
        v-model="name"
        type="text"
        placeholder="Name"
        class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
      />

      <input
        v-model="email"
        type="email"
        placeholder="Email"
        class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
      />

      <input
        v-model="password"
        type="password"
        placeholder="Password"
        class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
      />

      <!-- New file input for image -->
      <input
        type="file"
        @change="onFileChange"
        accept="image/*"
        class="w-full mb-6"
      />

      <button
        @click="register"
        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
      >
        Register
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const auth = useAuthStore()

const name = ref('')
const email = ref('')
const password = ref('')
const profileImage = ref(null)  // Store the uploaded file

const onFileChange = (event) => {
  profileImage.value = event.target.files[0]  // Grab the selected file
}

const register = async () => {
  try {
    // Use FormData to send file + other data
    const formData = new FormData()
    formData.append('name', name.value)
    formData.append('email', email.value)
    formData.append('password', password.value)
    if (profileImage.value) {
      formData.append('profile_image', profileImage.value)
    }

    const res = await api.post('/register', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })

    const token = res.data.token
    auth.login(token)

    router.push('/')
  } catch (err) {
    alert('Register failed: ' + (err.response?.data?.message || err.message))
  }
}
</script>
