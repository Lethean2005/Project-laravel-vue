<template>
  <div class="categorylist-container">
    <div class="categorylist-header">
      <h2 class="categorylist-title">Category List</h2>
      <router-link to="/categories/add" class="categorylist-add-btn">
        Add Category
      </router-link>
    </div>

    <ul class="categorylist-ul">
      <li
        v-for="category in categories"
        :key="category.id"
        class="category-card"
      >
        <div class="category-card-content">
          <h3 class="category-card-title">{{ category.name }}</h3>
        </div>

        <div class="dropdown-wrapper">
          <button class="dropdown-trigger" @click="toggleDropdown(category.id)">
            ⋮
          </button>
          <div
            v-if="openDropdown === category.id"
            class="dropdown-menu"
          >
            <router-link
              :to="`/categories/edit/${category.id}`"
              class="dropdown-item"
            >
              ✏️ Edit
            </router-link>
            <button
              class="dropdown-item delete"
              @click="handleDelete(category.id)"
            >
              🗑️ Delete
            </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";

const auth = useAuthStore();
const categories = ref([]);
const router = useRouter();
const openDropdown = ref(null); // Track dropdown open state

const fetchCategories = async () => {
  try {
    const res = await api.get("/categories");
    categories.value = res.data.data;
  } catch (error) {
    console.error("Failed to fetch categories:", error);
  }
};

const toggleDropdown = (id) => {
  openDropdown.value = openDropdown.value === id ? null : id;
};

const handleDelete = async (id) => {
  const confirmed = confirm("Are you sure you want to delete this category?");
  if (confirmed) {
    try {
      await api.delete(`/categories/${id}`);
      categories.value = categories.value.filter((cat) => cat.id !== id);
      openDropdown.value = null;
    } catch (error) {
      console.error("Failed to delete category:", error);
    }
  }
};

onMounted(() => {
  if (!auth.isAuthenticated) {
    router.push("/login");
  } else {
    fetchCategories();
  }
});
</script>

<style scoped>
.categorylist-container {
  padding: 2rem;
  max-width: 1200px;
  margin: 2.5rem auto;
  background: rgba(255, 255, 255, 0.7);
  border-radius: 2rem;
  box-shadow: 0 8px 32px rgba(31, 41, 55, 0.1);
  backdrop-filter: blur(10px);
}
.categorylist-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}
.categorylist-title {
  font-size: 2rem;
  font-weight: 700;
  color: #2563eb;
  text-shadow: 0 2px 8px #dbeafe;
}
.categorylist-add-btn {
  background: linear-gradient(90deg, #2563eb, #38bdf8);
  color: #fff;
  font-weight: 600;
  padding: 0.6rem 1.5rem;
  border-radius: 1.2rem;
  text-decoration: none;
  transition: 0.3s;
}
.categorylist-add-btn:hover {
  background: linear-gradient(90deg, #1d4ed8, #0ea5e9);
  transform: translateY(-2px) scale(1.04);
  box-shadow: 0 4px 18px rgba(59, 130, 246, 0.18);
}
.categorylist-ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.category-card {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  background: rgba(255, 255, 255, 0.85);
  border-radius: 1.5rem;
  margin-bottom: 1.5rem;
  padding: 1.5rem 2rem;
  box-shadow: 0 4px 16px rgba(37, 99, 235, 0.08);
  border: 1.5px solid rgba(59, 130, 246, 0.09);
  position: relative;
}
.category-card:hover {
  box-shadow: 0 8px 32px rgba(37, 99, 235, 0.13);
  transform: translateY(-2px) scale(1.01);
}
.category-card-content {
  flex: 1;
}
.category-card-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 0.5rem;
}
.dropdown-wrapper {
  position: relative;
}
.dropdown-trigger {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #1e293b;
  cursor: pointer;
  padding: 0.3rem;
  border-radius: 0.4rem;
}
.dropdown-trigger:hover {
  background-color: #f1f5f9;
}
.dropdown-menu {
  position: absolute;
  right: 0;
  top: 2rem;
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 0.5rem;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
  z-index: 100;
  min-width: 120px;
}
.dropdown-item {
  display: block;
  padding: 0.6rem 1rem;
  color: #1e293b;
  text-decoration: none;
  font-size: 0.95rem;
  transition: background 0.2s;
  width: 100%;
  text-align: left;
  background: transparent;
  border: none;
  cursor: pointer;
}
.dropdown-item:hover {
  background-color: #f3f4f6;
}
.dropdown-item.delete {
  color: #dc2626;
}
</style>
