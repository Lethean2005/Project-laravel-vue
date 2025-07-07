<template>
  <div class="p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold">Post List</h2>
      <router-link
        to="/posts/add"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >Add Post</router-link
      >
    </div>

    <ul>
      <li v-for="post in posts" :key="post.id" class="mb-4 border-b pb-4">
        <h3 class="text-lg font-semibold">{{ post.title }}</h3>
        <p>{{ post.content }}</p>
        <router-link :to="`/posts/edit/${post.id}`" class="text-blue-600"
          >Edit</router-link
        >
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";
const auth = useAuthStore();
const posts = ref([]);

const fetchPosts = async () => {
  const res = await api.get("/posts");
  posts.value = res.data.data;
};

onMounted(() => {
  if (!auth.isAuthenticated) {
    router.push("/login");
  } else {
    fetchPosts();
  }
});
</script>
