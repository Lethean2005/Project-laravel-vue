<template>
  <div class="restaurant-container">
    <!-- Header Section -->
    <div class="header-section">
      <div class="restaurant-info">
        <h1 class="restaurant-name">Product Management</h1>
        <p class="restaurant-date">{{ currentDate }}</p>
      </div>
      <div class="search-section">
        <div class="search-wrapper">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.35-4.35"/>
          </svg>
          <input 
            v-model="searchQuery"
            type="text" 
            placeholder="Search menu here..."
            class="search-input"
          />
        </div>
      </div>
    </div>

    <!-- Category Tabs with Images -->
    <div class="category-tabs">
      <button 
        v-for="category in categories" 
        :key="category.id"
        @click="selectedCategory = category.id"
        :class="['category-tab', { active: selectedCategory === category.id }]"
      >
        <div class="category-image-wrapper">
          <img 
            v-if="category.image_url"
            :src="getCategoryImageUrl(category.image_url)"
            :alt="category.name"
            class="category-image"
            @error="handleImageError"
          />
          <span v-else class="category-icon-fallback">{{ getCategoryIcon(category.name) }}</span>
        </div>
        <span class="category-name">{{ category.name }}</span>
      </button>
    </div>

    <!-- Products Grid -->
    <div class="products-grid" v-if="filteredProducts.length > 0">
      <div 
        v-for="product in filteredProducts" 
        :key="product.id"
        class="product-card"
      >
        <div class="product-image-container">
          <img 
            :src="getImageUrl(product.image_url) || '/placeholder.svg?height=200&width=200'"
            :alt="product.name"
            class="product-image"
            @error="handleProductImageError"
          />
          <!-- Admin Edit Overlay (only visible to admins) -->
          <div v-if="auth.isAuthenticated" class="product-edit-overlay" @click="selectProduct(product)">
            <svg class="edit-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path d="m18 2 4 4-14 14H4v-4L18 2z"/>
              <path d="M14.5 5.5 18.5 9.5"/>
            </svg>
            <span class="edit-text">Edit</span>
          </div>
        </div>
        <div class="product-info">
          <h3 class="product-name">{{ product.name }}</h3>
          <p class="product-description">{{ product.description }}</p>
          <div class="product-footer">
            <span class="product-price">${{ Number(product.price).toFixed(2) }}</span>
            <!-- <span class="product-count">{{ getRandomItemCount() }} items</span> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div v-else-if="!isLoading" class="empty-state">
      <div class="empty-icon">🍽️</div>
      <p class="empty-text">No products found</p>
      <p class="empty-subtext" v-if="selectedCategory">
        No items available in {{ getCategoryName(selectedCategory) }} category
      </p>
      <p class="empty-subtext" v-else-if="searchQuery">
        Try adjusting your search terms
      </p>
      <p class="empty-subtext" v-else>
        Add some products to get started
      </p>
    </div>

    <!-- Loading State -->
    <div v-if="isLoading" class="loading-state">
      <div class="loading-spinner"></div>
      <p class="loading-text">Loading delicious menu...</p>
    </div>

    <!-- Enhanced Floating Action Buttons (Admin Only) -->
    <div v-if="auth.isAuthenticated" class="floating-buttons">
      <!-- Category Management Button -->
      <div class="floating-btn-wrapper">
        <router-link
          to="/categories"
          class="floating-btn category-btn"
          title="Manage Categories"
        >
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="btn-icon">
            <rect x="3" y="3" width="7" height="7"/>
            <rect x="14" y="3" width="7" height="7"/>
            <rect x="14" y="14" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/>
          </svg>
        </router-link>
        <span class="btn-tooltip">Categories</span>
      </div>

      <!-- Add Product Button -->
      <div class="floating-btn-wrapper">
        <router-link
          to="/products/add"
          class="floating-btn add-btn"
          title="Add New Product"
        >
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="btn-icon">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
        </router-link>
        <span class="btn-tooltip">Add Product</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();

const products = ref([]);
const categories = ref([]);
const selectedCategory = ref(null);
const searchQuery = ref('');
const isLoading = ref(true);

const currentDate = computed(() => {
  return new Date().toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  });
});

const filteredProducts = computed(() => {
  let filtered = products.value;
  
  // Filter by search query
  if (searchQuery.value) {
    filtered = filtered.filter(product => 
      product.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      (product.description && product.description.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
  }
  
  // Filter by selected category
  if (selectedCategory.value) {
    filtered = filtered.filter(product => 
      product.category_id === selectedCategory.value
    );
  }
  
  return filtered;
});

// Get category image URL with proper path handling
const getCategoryImageUrl = (imagePath) => {
  if (!imagePath) return null;
  if (imagePath.startsWith("http")) return imagePath;
  if (imagePath.startsWith("public/")) {
    return window.location.origin + "/" + imagePath.replace("public/", "storage/");
  }
  if (imagePath.startsWith("category_images/")) {
    return window.location.origin + "/storage/" + imagePath;
  }
  if (imagePath.startsWith("categories/")) {
    return window.location.origin + "/storage/" + imagePath;
  }
  return window.location.origin + "/storage/category_images/" + imagePath;
};

// Get category icon based on category name (fallback)
const getCategoryIcon = (categoryName) => {
  const iconMap = {
    'burger': '🍔',
    'burgers': '🍔',
    'noodles': '🍜',
    'noodle': '🍜',
    'pasta': '🍝',
    'drinks': '🥤',
    'drink': '🥤',
    'beverages': '🥤',
    'desserts': '🍰',
    'dessert': '🍰',
    'sweets': '🍭',
    'pizza': '🍕',
    'salad': '🥗',
    'salads': '🥗',
    'sandwich': '🥪',
    'sandwiches': '🥪',
    'coffee': '☕',
    'tea': '🍵'
  };
  
  const key = categoryName.toLowerCase();
  return iconMap[key] || '🍽️';
};

// Get category name by ID
const getCategoryName = (categoryId) => {
  const category = categories.value.find(cat => cat.id === categoryId);
  return category ? category.name : '';
};

// Handle category image error
const handleImageError = (event) => {
  console.log('Category image failed to load:', event.target.src);
};

// Handle product image error
const handleProductImageError = (event) => {
  console.log('Product image failed to load:', event.target.src);
  event.target.src = '/placeholder.svg?height=200&width=200';
};

// Converts relative image paths to full URLs for display
const getImageUrl = (imagePath) => {
  if (!imagePath) return null;
  if (imagePath.startsWith("http")) return imagePath;
  if (imagePath.startsWith("public/")) {
    return window.location.origin + "/" + imagePath.replace("public/", "storage/");
  }
  if (imagePath.startsWith("product_images/")) {
    return window.location.origin + "/storage/" + imagePath;
  }
  return window.location.origin + "/storage/product_images/" + imagePath;
};

const getRandomItemCount = () => {
  return Math.floor(Math.random() * 15) + 5;
};

// Only allow admin to edit products (removed automatic navigation)
const selectProduct = (product) => {
  if (auth.isAuthenticated) {
    router.push(`/products/edit/${product.id}`);
  }
};

// Fetch categories from API
const fetchCategories = async () => {
  try {
    const res = await api.get("/categories");
    categories.value = Array.isArray(res.data) ? res.data : res.data.data;
    
    if (categories.value.length > 0) {
      selectedCategory.value = categories.value[0].id;
    }
  } catch (error) {
    console.error("Failed to fetch categories:", error);
    categories.value = [
      { id: 1, name: 'Burger', image_url: null },
      { id: 2, name: 'Noodles', image_url: null },
      { id: 3, name: 'Drinks', image_url: null },
      { id: 4, name: 'Desserts', image_url: null }
    ];
    selectedCategory.value = 1;
  }
};

// Fetch products from API
const fetchProducts = async () => {
  try {
    const res = await api.get("/products");
    products.value = Array.isArray(res.data) ? res.data : res.data.data;
  } catch (e) {
    console.error("Failed to load products:", e);
  }
};

onMounted(async () => {
  isLoading.value = true;
  try {
    await Promise.all([fetchCategories(), fetchProducts()]);
  } finally {
    isLoading.value = false;
  }
});
</script>

<style scoped>
.restaurant-container {
  min-height: 100vh;
  background: #1a1d23;
  color: white;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  padding: 1.5rem;
}

/* Header Section */
.header-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.restaurant-info {
  flex: 1;
}

.restaurant-name {
  font-size: 1.75rem;
  font-weight: bold;
  color: white;
  margin: 0;
  line-height: 1.2;
}

.restaurant-date {
  font-size: 0.9rem;
  color: #8b949e;
  margin: 0.25rem 0 0 0;
}

.search-section {
  flex: 1;
  max-width: 400px;
}

.search-wrapper {
  position: relative;
  width: 100%;
}

.search-icon {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  width: 18px;
  height: 18px;
  color: #8b949e;
  stroke-width: 2;
}

.search-input {
  width: 100%;
  background: #2d3748;
  border: 1px solid #4a5568;
  border-radius: 12px;
  padding: 0.75rem 1rem 0.75rem 3rem;
  color: white;
  font-size: 0.9rem;
  transition: all 0.2s ease;
}

.search-input:focus {
  outline: none;
  border-color: #e53e3e;
  background: #374151;
}

.search-input::placeholder {
  color: #8b949e;
}

/* Category Tabs */
.category-tabs {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
  overflow-x: auto;
  padding-bottom: 0.5rem;
}

.category-tab {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  background: transparent;
  border: 2px solid #4a5568;
  border-radius: 12px;
  padding: 0.75rem 1.25rem;
  color: #8b949e;
  cursor: pointer;
  transition: all 0.2s ease;
  white-space: nowrap;
  min-width: fit-content;
}

.category-tab:hover {
  border-color: #e53e3e;
  color: white;
}

.category-tab.active {
  border-color: #e53e3e;
  background: rgba(229, 62, 62, 0.1);
  color: white;
}

.category-image-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: 8px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.1);
}

.category-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 6px;
}

.category-icon-fallback {
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.category-name {
  font-size: 0.9rem;
  font-weight: 500;
}

/* Products Grid */
.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.product-card {
  background: #2d3748;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  border: 1px solid #4a5568;
}

.product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
  border-color: #e53e3e;
}

.product-image-container {
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: #374151;
  position: relative;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.product-card:hover .product-image {
  transform: scale(1.05);
}

/* Admin Edit Overlay */
.product-edit-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.3s ease;
  cursor: pointer;
  backdrop-filter: blur(2px);
}

.product-card:hover .product-edit-overlay {
  opacity: 1;
}

.edit-icon {
  width: 24px;
  height: 24px;
  color: white;
  stroke-width: 2;
  margin-bottom: 0.5rem;
}

.edit-text {
  color: white;
  font-size: 0.9rem;
  font-weight: 500;
}

.product-info {
  padding: 1.25rem;
}

.product-name {
  font-size: 1.1rem;
  font-weight: 600;
  color: white;
  margin: 0 0 0.5rem 0;
  line-height: 1.3;
}

.product-description {
  font-size: 0.85rem;
  color: #8b949e;
  margin: 0 0 1rem 0;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.product-price {
  font-size: 1.1rem;
  font-weight: bold;
  color: #e53e3e;
}

.product-count {
  font-size: 0.8rem;
  color: #8b949e;
}

/* Loading State */
.loading-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 4rem 2rem;
  color: #8b949e;
}

.loading-spinner {
  width: 40px;
  height: 40px;
  border: 3px solid #4a5568;
  border-top: 3px solid #e53e3e;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 1rem;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading-text {
  font-size: 1rem;
  color: white;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: #8b949e;
}

.empty-icon {
  font-size: 4rem;
  margin-bottom: 1rem;
}

.empty-text {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: white;
}

.empty-subtext {
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
}

/* Enhanced Floating Action Buttons */
.floating-buttons {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  z-index: 1000;
}

.floating-btn-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.floating-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 64px;
  height: 64px;
  border-radius: 50%;
  color: white;
  text-decoration: none;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.floating-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: inherit;
  border-radius: inherit;
  transition: transform 0.3s ease;
}

.floating-btn:hover::before {
  transform: scale(1.1);
}

.category-btn {
  background: linear-gradient(135deg, #4f46e5, #3b82f6);
}

.category-btn:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 16px 40px rgba(79, 70, 229, 0.4);
}

.add-btn {
  background: linear-gradient(135deg, #ef4444, #dc2626);
}

.add-btn:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 16px 40px rgba(239, 68, 68, 0.4);
}

.btn-icon {
  width: 28px;
  height: 28px;
  stroke-width: 2.5;
  position: relative;
  z-index: 2;
}

.btn-tooltip {
  position: absolute;
  right: 80px;
  background: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 500;
  white-space: nowrap;
  opacity: 0;
  transform: translateX(10px);
  transition: all 0.3s ease;
  pointer-events: none;
  backdrop-filter: blur(10px);
}

.floating-btn-wrapper:hover .btn-tooltip {
  opacity: 1;
  transform: translateX(0);
}

.btn-tooltip::after {
  content: '';
  position: absolute;
  top: 50%;
  right: -6px;
  transform: translateY(-50%);
  width: 0;
  height: 0;
  border-left: 6px solid rgba(0, 0, 0, 0.8);
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
}

/* Responsive Design */
@media (max-width: 768px) {
  .restaurant-container {
    padding: 1rem;
  }
  
  .header-section {
    flex-direction: column;
    align-items: stretch;
  }
  
  .search-section {
    max-width: none;
  }
  
  .products-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
  }
  
  .category-tabs {
    gap: 0.5rem;
  }
  
  .category-tab {
    padding: 0.6rem 1rem;
    gap: 0.5rem;
  }
  
  .category-image-wrapper {
    width: 28px;
    height: 28px;
  }
  
  .restaurant-name {
    font-size: 1.5rem;
  }
  
  .floating-buttons {
    bottom: 1rem;
    right: 1rem;
  }
  
  .floating-btn {
    width: 56px;
    height: 56px;
  }
  
  .btn-icon {
    width: 24px;
    height: 24px;
  }
  
  .btn-tooltip {
    display: none;
  }
}

@media (max-width: 480px) {
  .products-grid {
    grid-template-columns: 1fr;
  }
  
  .category-tabs {
    flex-wrap: wrap;
  }
  
  .floating-btn {
    width: 52px;
    height: 52px;
  }
  
  .btn-icon {
    width: 22px;
    height: 22px;
  }
}
</style>