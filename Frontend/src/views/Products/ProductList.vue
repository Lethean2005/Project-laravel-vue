<template>
  <div class="p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold">Product List</h2>
      <router-link
        to="/products/add"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Add Product
      </router-link>
    </div>

    <ul v-if="products.length">
      <li
        v-for="product in products"
        :key="product.id"
        class="mb-6 border rounded-lg p-4 shadow"
      >
        <img
          v-if="product.image_url"
          :src="product.image_url"
          alt="Product Image"
          class="w-full max-w-xs object-cover h-48 rounded mb-4"
        />

        <h3 class="text-xl font-semibold">{{ product.name }}</h3>
        <p class="text-gray-700">{{ product.description }}</p>
        <p class="text-gray-900 font-bold mt-2">
          ${{ Number(product.price).toFixed(2) }}
        </p>

        <router-link
          :to="`/products/edit/${product.id}`"
          class="text-blue-600 hover:underline inline-block mt-2"
        >
          Edit
        </router-link>
      </li>
    </ul>

    <p v-else class="text-gray-500">No products found.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();
const products = ref([]);

// Converts relative image paths to full URLs for display
const getImageUrl = (imagePath) => {
  if (!imagePath) return null;
  if (imagePath.startsWith("http")) return imagePath; // full URL already
  if (imagePath.startsWith("public/")) {
    // Replace 'public/' with 'storage/' for Laravel storage link
    return (
      window.location.origin + "/" + imagePath.replace("public/", "storage/")
    );
  }
  if (imagePath.startsWith("product_images/")) {
    return window.location.origin + "/storage/" + imagePath;
  }
  // fallback if just filename
  return window.location.origin + "/storage/product_images/" + imagePath;
};

const fetchProducts = async () => {
  try {
    const res = await api.get("/products");
    // Accept raw array or { data: [...] }
    products.value = Array.isArray(res.data) ? res.data : res.data.data;
  } catch (e) {
    console.error("Failed to load products:", e);
  }
};

onMounted(() => {
  if (!auth.isAuthenticated) {
    router.push("/login");
  } else {
    fetchProducts();
  }
});
</script>
