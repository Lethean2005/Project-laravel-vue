<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">✏️ Edit Post</h2>

    <div class="space-y-5 bg-white p-6 rounded-xl shadow-md border border-gray-200">
      <input
        v-model="title"
        type="text"
        placeholder="Post Title"
        class="form-input"
      />

      <textarea
        v-model="content"
        placeholder="Write your content here..."
        rows="6"
        class="form-textarea"
      ></textarea>

      <div class="flex gap-4">
        <button
          @click="updatePost"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-200"
        >
          💾 Update Post
        </button>

        <button
          @click="cancel"
          type="button"
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg shadow transition duration-200"
        >
          ✖ Cancel
        </button>
      </div>
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

onMounted(async () => {
  const res = await api.get(`/posts/${route.params.id}`);
  title.value = res.data.data.title;
  content.value = res.data.data.content;
});

const updatePost = async () => {
  if (!title.value.trim() || !content.value.trim()) return;
  await api.put(`/posts/${route.params.id}`, {
    title: title.value,
    content: content.value,
  });
  router.push("/posts");
};

const cancel = () => {
  router.push("/posts");
};
</script>

<style scoped>
.form-input,
.form-textarea {
  @apply w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200;
}
</style>
