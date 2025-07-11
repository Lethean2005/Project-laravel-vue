<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📝 Add New Post</h2>

    <div class="space-y-4">
      <input
        v-model="title"
        type="text"
        placeholder="Post Title"
        class="form-input"
      />

      <textarea
        v-model="content"
        placeholder="Write your content here..."
        class="form-textarea"
        rows="6"
      ></textarea>

      <div class="flex gap-4">
        <button
          @click="createPost"
          class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition duration-200"
        >
          💾 Save Post
        </button>

        <button
          @click="cancel"
          type="button"
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow transition duration-200"
        >
          ✖ Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api'

const title = ref('')
const content = ref('')
const router = useRouter()

const createPost = async () => {
  if (!title.value.trim() || !content.value.trim()) return
  await api.post('/posts', { title: title.value, content: content.value })
  router.push('/posts')
}

const cancel = () => {
  // Clear inputs
  title.value = ''
  content.value = ''
  // Navigate back to posts list
  router.push('/posts')
}
</script>

<style scoped>
.form-input,
.form-textarea {
  @apply w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-200;
}
</style>
