<template>
  <div class="p-6 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
      <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v9a2 2 0 01-2 2z" />
        </svg>
        Post List
      </h2>

      <router-link
        to="/posts/add"
        class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition transform active:scale-95 focus:outline-none focus:ring-4 focus:ring-indigo-300"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Post
      </router-link>
    </div>

    <!-- Search Input -->
    <div class="mb-6">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search posts..."
        class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
      />
    </div>

    <!-- Post Cards -->
    <transition-group name="fade" tag="div" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="post in paginatedPosts"
        :key="post.id"
        class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1 p-6 flex flex-col justify-between"
      >
        <div>
          <h3 class="text-xl font-bold text-gray-800 mb-3 truncate" :title="post.title">{{ post.title }}</h3>
          <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
            {{ post.content }}
          </p>
        </div>

        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
          <router-link
            :to="`/posts/edit/${post.id}`"
            class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium text-sm"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2m4 4v10a2 2 0 01-2 2H7a2 2 0 01-2-2V9m14 0h-4l-2-2H7" />
            </svg>
            Edit
          </router-link>

          <button
            @click="confirmDelete(post.id)"
            class="inline-flex items-center text-red-500 hover:text-red-700 font-medium text-sm"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
            </svg>
            Delete
          </button>
        </div>
      </div>
    </transition-group>

    <!-- Pagination -->
    <div v-if="totalPages > 1" class="flex justify-center mt-10 space-x-2">
      <button
        @click="goToPage(currentPage - 1)"
        :disabled="currentPage === 1"
        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
      >
        Prev
      </button>
      <button
        v-for="page in totalPages"
        :key="page"
        @click="goToPage(page)"
        :class="[
          'px-4 py-2 rounded',
          currentPage === page
            ? 'bg-indigo-600 text-white'
            : 'bg-gray-200 hover:bg-gray-300'
        ]"
      >
        {{ page }}
      </button>
      <button
        @click="goToPage(currentPage + 1)"
        :disabled="currentPage === totalPages"
        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
      >
        Next
      </button>
    </div>

    <!-- No posts message -->
    <div v-if="filteredPosts.length === 0" class="mt-12 text-center text-gray-500 text-lg select-none">
      No posts found. Start by adding a new post!
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();
const posts = ref([]);
const searchQuery = ref("");
const currentPage = ref(1);
const postsPerPage = 6;

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

const confirmDelete = async (postId) => {
  if (confirm("Are you sure you want to delete this post?")) {
    try {
      await api.delete(`/posts/${postId}`);
      posts.value = posts.value.filter(post => post.id !== postId);
    } catch (error) {
      alert("Failed to delete the post. Please try again.");
    }
  }
};

const filteredPosts = computed(() => {
  const q = searchQuery.value.toLowerCase();
  return posts.value.filter(
    (post) =>
      post.title.toLowerCase().includes(q) ||
      post.content.toLowerCase().includes(q)
  );
});

const paginatedPosts = computed(() => {
  const start = (currentPage.value - 1) * postsPerPage;
  return filteredPosts.value.slice(start, start + postsPerPage);
});

const totalPages = computed(() => {
  return Math.ceil(filteredPosts.value.length / postsPerPage);
});

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
