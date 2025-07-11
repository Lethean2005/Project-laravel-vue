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
        class="w-full mb-6 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
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

const register = async () => {
  try {
    const res = await api.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value
    })

    const token = res.data.token
    auth.login(token) // ✅ Use the store to login

    router.push('/') // Redirect after registration
  } catch (err) {
    alert('Register failed: ' + (err.response?.data?.message || err.message))
  }
}
</script>
