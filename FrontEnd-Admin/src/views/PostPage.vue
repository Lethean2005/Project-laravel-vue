<template>
  <div class="posts">
    <h2 class="text-2xl font-bold mb-4">Create New Post</h2>
    <div class="form">
      <input
        v-model="title"
        placeholder="Title"
        class="border border-gray-300 p-2 rounded"
      />
      <textarea
        v-model="content"
        placeholder="Content"
        class="border border-gray-300 p-2 rounded h-24"
      ></textarea>
      <button
        @click="createPost"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Add Post
      </button>
      <p v-if="message" class="success text-green-600 mt-2">{{ message }}</p>
    </div>

    <h2 class="text-xl font-semibold mt-8 mb-4">Post List</h2>
    <ul>
      <li v-for="post in posts" :key="post.id" class="mb-6 border-b pb-4">
        <h3 class="text-lg font-semibold">{{ post.title }}</h3>
        <p>{{ post.content }}</p>

        <div class="mt-2">
          <button @click="editPost(post)" class="text-blue-600 mr-2">Edit</button>
          <button @click="cancelEdit" v-if="editId === post.id" class="text-gray-500">Cancel</button>
        </div>

        <div v-if="editId === post.id" class="mt-2">
          <input v-model="editTitle" class="border p-2 mb-2 w-full" />
          <textarea v-model="editContent" class="border p-2 mb-2 w-full h-24"></textarea>
          <button @click="updatePost" class="bg-green-600 text-white px-4 py-1 rounded">Update</button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import api from '@/api'

const posts = ref([])
const title = ref('')
const content = ref('')
const message = ref('')

const editId = ref(null)
const editTitle = ref('')
const editContent = ref('')

const auth = useAuthStore()
const router = useRouter()

onMounted(() => {
  if (!auth.isAuthenticated) {
    router.push('/login')
  } else {
    fetchPosts()
  }
})

const fetchPosts = async () => {
  try {
    const res = await api.get('/posts')
    posts.value = res.data.data
  } catch (error) {
    console.error('Failed to load posts:', error)
  }
}

const createPost = async () => {
  if (!title.value || !content.value) {
    alert('Title and content are required.')
    return
  }

  try {
    const res = await api.post('/posts', {
      title: title.value,
      content: content.value
    })

    posts.value.unshift(res.data.data)
    title.value = ''
    content.value = ''
    message.value = res.data.message || 'Post created successfully!'
  } catch (error) {
    alert('Failed to create post: ' + (error.response?.data?.message || error.message))
  }
}

const editPost = (post) => {
  editId.value = post.id
  editTitle.value = post.title
  editContent.value = post.content
}

const cancelEdit = () => {
  editId.value = null
  editTitle.value = ''
  editContent.value = ''
}

const updatePost = async () => {
  try {
    const res = await api.put(`/posts/${editId.value}`, {
      title: editTitle.value,
      content: editContent.value
    })

    const updated = res.data.data
    const index = posts.value.findIndex(p => p.id === editId.value)
    if (index !== -1) {
      posts.value[index] = updated
    }

    cancelEdit()
    message.value = res.data.message || 'Post updated successfully!'
  } catch (error) {
    alert('Failed to update post: ' + (error.response?.data?.message || error.message))
  }
}
</script>

<style scoped>
.posts {
  padding: 2rem;
  max-width: 700px;
  margin: auto;
}
.form {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  margin-bottom: 2rem;
}
.success {
  color: green;
}
</style>
