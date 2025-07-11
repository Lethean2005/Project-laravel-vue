<template>
  <div class="categorylist-container">
    <div class="categorylist-header">
      <h2 class="categorylist-title">Category List</h2>
      <router-link to="/categories/add" class="categorylist-add-btn">
        Add Category
      </router-link>
    </div>
    <ul class="categorylist-ul">
      <li v-for="category in categories" :key="category.id" class="category-card">
        <!-- Show Image if Available -->
        <img v-if="category.image_url" :src="category.image_url" alt="Category Image" class="category-image" />

        <div class="category-card-content">
          <h3 class="category-card-title">{{ category.name }}</h3>
        </div>
        <div class="dropdown-wrapper">
          <button class="dropdown-trigger" @click="toggleDropdown(category.id)">⋮</button>
          <div v-if="openDropdown === category.id" class="dropdown-menu">
            <router-link :to="`/categories/edit/${category.id}`" class="dropdown-item">
              ✏️ Edit
            </router-link>
            <button class="dropdown-item delete" @click="handleDelete(category.id)">
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
import axios from "axios";
import { useRouter } from "vue-router";

const categories = ref([]);
const openDropdown = ref(null);
const router = useRouter();

// API base URL - adjust to your backend URL
const API_BASE_URL = "http://localhost:8000/api";

const fetchCategories = async () => {
  try {
    const res = await axios.get(`${API_BASE_URL}/categories`);
    console.log("API Response:", res.data);

    // If your API returns categories inside 'data' key, otherwise adjust
    const rawCategories = res.data.data || res.data;

    // Fix image URL for display (adjust your storage path if needed)
    categories.value = rawCategories.map(cat => ({
      ...cat,
      image_url: cat.image ? `${API_BASE_URL.replace("/api", "")}/storage/${cat.image}` : null,
    }));

  } catch (error) {
    console.error("Failed to fetch categories:", error);
  }
};

const toggleDropdown = (id) => {
  openDropdown.value = openDropdown.value === id ? null : id;
};

const handleDelete = async (id) => {
  if (confirm("Are you sure you want to delete this category?")) {
    try {
      await axios.delete(`${API_BASE_URL}/categories/${id}`);
      categories.value = categories.value.filter(cat => cat.id !== id);
      openDropdown.value = null;
    } catch (error) {
      console.error("Failed to delete category:", error);
    }
  }
};

onMounted(() => {
  fetchCategories();
});
</script>

<style scoped>
/* Your existing styles from your code, copy them here */
.categorylist-container {
  padding: 2rem;
  max-width: 1200px;
  margin: 2.5rem auto;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.categorylist-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #f1f5f9;
}

.categorylist-title {
  font-size: 1.8rem;
  font-weight: 600;
  color: #1e293b;
  margin: 0;
}

.categorylist-add-btn {
  background: #3b82f6;
  color: #fff;
  font-weight: 500;
  padding: 0.75rem 1.5rem;
  border-radius: 0.5rem;
  text-decoration: none;
  transition: all 0.2s ease;
  font-size: 0.9rem;
}

.categorylist-add-btn:hover {
  background: #2563eb;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.categorylist-ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
}

.category-card {
  background: #ffffff;
  border-radius: 1rem;
  padding: 1.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  border: 1px solid #f1f5f9;
  position: relative;
  transition: all 0.2s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.category-card:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  transform: translateY(-2px);
  border-color: #e2e8f0;
}

.category-image {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid #f8fafc;
  margin-bottom: 1rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.category-card-content {
  flex: 1;
  width: 100%;
}

.category-card-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: #1e293b;
  margin: 0;
  line-height: 1.4;
}

.dropdown-wrapper {
  position: absolute;
  top: 1rem;
  right: 1rem;
}

.dropdown-trigger {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  font-size: 1.2rem;
  color: #64748b;
  cursor: pointer;
  padding: 0.25rem 0.5rem;
  border-radius: 0.375rem;
  transition: all 0.2s ease;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.dropdown-trigger:hover {
  background-color: #f1f5f9;
  border-color: #cbd5e1;
  color: #475569;
}

.dropdown-menu {
  position: absolute;
  right: 0;
  top: 2rem;
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 0.5rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  z-index: 100;
  min-width: 140px;
  overflow: hidden;
}

.dropdown-item {
  display: block;
  padding: 0.75rem 1rem;
  color: #374151;
  text-decoration: none;
  font-size: 0.875rem;
  transition: background 0.15s ease;
  width: 100%;
  text-align: left;
  background: transparent;
  border: none;
  cursor: pointer;
  border-bottom: 1px solid #f9fafb;
}

.dropdown-item:last-child {
  border-bottom: none;
}

.dropdown-item:hover {
  background-color: #f9fafb;
}

.dropdown-item.delete {
  color: #dc2626;
}

.dropdown-item.delete:hover {
  background-color: #fef2f2;
}

/* Responsive Design */
@media (max-width: 768px) {
  .categorylist-container {
    padding: 1rem;
    margin: 1rem;
  }

  .categorylist-ul {
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1rem;
  }

  .category-card {
    padding: 1rem;
  }

  .category-image {
    width: 60px;
    height: 60px;
  }

  .categorylist-header {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }

  .categorylist-add-btn {
    text-align: center;
  }
}

@media (max-width: 480px) {
  .categorylist-ul {
    grid-template-columns: 1fr;
  }
}
</style>
