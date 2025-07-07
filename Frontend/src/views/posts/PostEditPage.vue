<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Post</h2>

    <div class="space-y-4">
      <input
        v-model="title"
        type="text"
        placeholder="Title"
        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />

      <textarea
        v-model="content"
        placeholder="Content"
        rows="5"
        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      ></textarea>

      <button
        @click="updatePost"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow"
      >
        Update
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "@/api";

const route = useRoute();
const router = useRouter();

const title = ref("");
const content = ref("");

// Load post data when component mounts
onMounted(async () => {
  try {
    const res = await api.get(`/posts/${route.params.id}`);
    // Adjust depending on your API response structure:
    // If API returns post directly in res.data:
    title.value = res.data.title;
    content.value = res.data.content;

    // If API returns { data: post } then use:
    // title.value = res.data.data.title;
    // content.value = res.data.data.content;
  } catch (error) {
    console.error("Failed to fetch post:", error);
  }
});

// Send updated post data to backend
const updatePost = async () => {
  try {
    await api.put(`/posts/${route.params.id}`, {
      title: title.value,
      content: content.value,
    });
    router.push("/posts"); // Redirect after update
  } catch (error) {
    console.error("Failed to update post:", error);
  }
};
</script>
