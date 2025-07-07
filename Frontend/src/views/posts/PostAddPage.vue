<template>
  <div class="p-6 max-w-2xl mx-auto bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Add New Post</h2>

    <!-- Title -->
    <div class="mb-4">
      <label class="block mb-1 font-medium text-gray-700">Title</label>
      <input v-model="title" placeholder="Title" class="input" />
    </div>

    <!-- Date of Birth -->
    <div class="mb-4">
      <label class="block mb-1 font-medium text-gray-700">Date of birth</label>
      <BaseDatePicker
        v-model="dateOfBirth"
        :max-date="new Date()"
        format="dd-MM-yyyy"
        class="input"
      />
    </div>

    <!-- Booking Room (start - end) -->
    <div class="mb-4">
      <label class="block mb-1 font-medium text-gray-700">Booking room</label>
      <div class="flex items-center gap-2">
        <BaseDatePicker
          v-model="bookingStart"
          format="yyyy-MM-dd"
          class="input w-full"
        />
        <span class="text-gray-500">-</span>
        <BaseDatePicker
          v-model="bookingEnd"
          format="yyyy-MM-dd"
          class="input w-full"
        />
      </div>
    </div>

    <!-- Content -->
    <div class="mb-4">
      <label class="block mb-1 font-medium text-gray-700">Content</label>
      <textarea v-model="content" placeholder="Content" class="input h-24"></textarea>
    </div>

    <!-- Save Button -->
    <button @click="createPost" class="btn">Save</button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api'
import BaseDatePicker from '@/components/BaseDatePicker.vue'
const title = ref('')
const dateOfBirth = ref(new Date())
const bookingStart = ref(new Date())
const bookingEnd = ref(new Date(new Date().setMonth(new Date().getMonth() + 1)))
const content = ref('')
const router = useRouter()

const createPost = async () => {
  await api.post('/posts', {
    title: title.value,
    dateOfBirth: dateOfBirth.value,
    bookingStart: bookingStart.value,
    bookingEnd: bookingEnd.value,
    content: content.value,
  })
  router.push('/posts')
}
</script>

<style scoped>
.input {
  display: block;
  width: 100%;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 0.375rem;
  box-sizing: border-box;
}
.h-24 {
  height: 6rem;
}
.btn {
  background-color: #2563eb;
  color: white;
  padding: 0.6rem 1.2rem;
  border-radius: 0.375rem;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.btn:hover {
  background-color: #1d4ed8;
}
</style>
