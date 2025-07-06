<template>
  <div class="main-container">
    <side-bar />
    
    <!-- Main Content Area -->
    <div class="content-wrapper">
      <!-- Header Section -->
      <div class="header-section">
        <div class="header-content">
          <div class="breadcrumb">
            <span>Store</span>
            <span>></span>
            <span class="current-page">Categories</span>
          </div>
          
          <div class="search-container">
            <div class="search-wrapper">
              <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input 
                type="text" 
                placeholder="Search categories..." 
                class="search-input"
                v-model="searchQuery"
                @input="filterCategories"
              >
              <button v-if="searchQuery" @click="clearSearch" class="clear-search">×</button>
            </div>
          </div>
          
          <div class="user-avatar">
            <span>🤗</span>
          </div>
        </div>
      </div>
      
      <!-- Categories Header -->
      <div class="page-content">
        <div class="stats-header">
          <div class="stats-content">
            <div class="stats-left">
              <div class="stats-icon">
                <span>Cat</span>
              </div>
              <div class="stats-info">
                <h1>Categories</h1>
                <p>Manage your product categories</p>
              </div>
            </div>
            
            <div class="stats-right">
              <div class="stat-item">
                <div class="stat-number">{{ categories.length.toString().padStart(2, '0') }}</div>
                <div class="stat-label">Total Categories</div>
              </div>
              <div class="stat-item">
                <div class="stat-number">{{categories.filter(c => c.status).length.toString().padStart(2, '0')}}</div>
                <div class="stat-label">Active</div>
              </div>
              <div class="stat-item">
                <div class="stat-number">{{categories.filter(c => !c.status).length.toString().padStart(2, '0')}}
                </div>
                <div class="stat-label">Inactive</div>
              </div>
            </div>
          </div>
        </div>
        
        <h2 class="page-title">Categories</h2>
        
        <!-- Categories Grid -->
        <div class="categories-container">
          <div v-for="(category, index) in filteredCategories" :key="category.id" class="category-card"
            :class="{ 'featured-card': index === 1, selected: selectedCategory?.id === category.id }"
            @click="selectCategory(category)">
            <!-- Category Image -->
            <div class="category-image-container">
              <img v-if="category.image" :src="`http://127.0.0.1:8000/storage/${category.image}`" alt="Category Image"
                class="category-image" />
              <div v-else class="category-placeholder">
                <span>📦</span>
              </div>
            </div>
            <!-- Category Name -->
            <div class="category-name">{{ category.name }}</div>
          </div>
        </div>
        
        <!-- No Results Message -->
        <div v-if="filteredCategories.length === 0 && searchQuery" class="no-results">
          <div class="no-results-icon">🔍</div>
          <h3>No categories found</h3>
          <p>Try searching with different keywords</p>
        </div>
        
        <!-- Products Under Selected Category -->
        <div v-if="selectedCategory" class="products-container">
          <h3>Products in "{{ selectedCategory.name }}"</h3>
          <div v-if="loadingProducts" class="loading-products">
            <div class="loading-spinner"></div>
            <span>Loading products...</span>
          </div>
          <div v-else-if="products.length === 0" class="no-products">
            <div class="no-products-icon">🍽️</div>
            <p>No products found in this category</p>
          </div>
          <div v-else class="product-list">
            <div v-for="product in products" :key="product.id" class="product-card">
              <div class="product-image-wrapper">
                <img v-if="product.image" :src="`http://127.0.0.1:8000/storage/${product.image}`" alt="Product Image"
                  class="product-image" />
                <div v-else class="product-image-placeholder">🍽️</div>
              </div>
              <div class="product-details">
                <h4>{{ product.name }}</h4>
                <p>{{ product.description }}</p>
                <div class="product-meta">
                  <span class="product-rating">⭐ 4.7</span>
                  <span class="product-price">$12.99</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Empty State -->
        <div v-if="categories.length === 0" class="empty-state">
          <div class="empty-icon">
            <span>📦</span>
          </div>
          <h3 class="empty-title">No categories found</h3>
          <p class="empty-description">Start by creating your first category</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import SideBar from '@/components/SideBar.vue'

const categories = ref([])
const selectedCategory = ref(null)
const products = ref([])
const loadingProducts = ref(false)
const searchQuery = ref('')

// Computed property for filtered categories
const filteredCategories = computed(() => {
  if (!searchQuery.value) {
    return categories.value
  }
  return categories.value.filter(category =>
    category.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const fetchCategories = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/categories')
    categories.value = response.data
  } catch (error) {
    console.error('Error fetching categories:', error)
  }
}

const fetchProductsByCategory = async (categoryId) => {
  loadingProducts.value = true
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/categories/${categoryId}/products`)
    products.value = response.data
  } catch (error) {
    console.error('Error fetching products:', error)
    products.value = []
  } finally {
    loadingProducts.value = false
  }
}

const selectCategory = (category) => {
  selectedCategory.value = category
  fetchProductsByCategory(category.id)
}

const filterCategories = () => {
  // This function is called on input, but the filtering is handled by the computed property
}

const clearSearch = () => {
  searchQuery.value = ''
}

onMounted(fetchCategories)
</script>

<style scoped>
/* Enhanced styles with better visual appeal */
.main-container {
  display: flex;
  min-height: 100vh;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  position: relative;
  overflow: hidden;
}

/* Floating decorative elements */
.main-container::before {
  content: '';
  position: absolute;
  top: 10%;
  right: 15%;
  width: 40px;
  height: 40px;
  background: linear-gradient(45deg, #4ade80, #22c55e);
  border-radius: 50% 0;
  transform: rotate(45deg);
  animation: float 6s ease-in-out infinite;
  z-index: 1;
}

.main-container::after {
  content: '';
  position: absolute;
  top: 20%;
  right: 25%;
  width: 25px;
  height: 25px;
  background: linear-gradient(45deg, #22c55e, #16a34a);
  border-radius: 50% 0;
  transform: rotate(45deg);
  animation: float 8s ease-in-out infinite reverse;
  z-index: 1;
}

@keyframes float {
  0%, 100% { transform: rotate(45deg) translateY(0px); }
  50% { transform: rotate(45deg) translateY(-20px); }
}

.content-wrapper {
  flex: 1;
  padding: 1rem;
}

.header-section {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
  border: 1px solid rgba(255, 255, 255, 0.18);
  padding: 2rem;
  margin-bottom: 1.5rem;
  border-radius: 24px;
  position: relative;
  overflow: hidden;
}

.header-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);
  border-radius: 24px 24px 0 0;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 64rem;
  margin: 0 auto;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.875rem;
  color: #64748b;
  font-weight: 500;
}

.breadcrumb span:not(.current-page) {
  transition: color 0.2s;
}

.breadcrumb span:not(.current-page):hover {
  color: #3b82f6;
}

.current-page {
  color: #1e293b;
  font-weight: 700;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.search-container {
  flex: 1;
  max-width: 28rem;
  margin: 0 2rem;
}

.search-wrapper {
  position: relative;
  background: linear-gradient(135deg, #f8fafc, #f1f5f9);
  border-radius: 20px;
  border: 2px solid transparent;
  background-clip: padding-box;
  transition: all 0.3s ease;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.search-wrapper:focus-within {
  border-color: #3b82f6;
  box-shadow: 0 8px 32px rgba(59, 130, 246, 0.2);
  transform: translateY(-2px);
}

.search-icon {
  position: absolute;
  left: 1.25rem;
  top: 50%;
  transform: translateY(-50%);
  width: 1.25rem;
  height: 1.25rem;
  color: #64748b;
  transition: color 0.2s;
}

.search-wrapper:focus-within .search-icon {
  color: #3b82f6;
}

.search-input {
  width: 100%;
  padding: 1rem 3.5rem 1rem 3.25rem;
  background-color: transparent;
  border-radius: 20px;
  border: none;
  outline: none;
  transition: all 0.2s;
  font-size: 0.875rem;
  color: #1e293b;
  font-weight: 500;
}

.search-input::placeholder {
  color: #94a3b8;
  font-weight: 400;
}

.clear-search {
  position: absolute;
  right: 1rem;
  top: 50%;
  transform: translateY(-50%);
  width: 2rem;
  height: 2rem;
  background: #ef4444;
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.clear-search:hover {
  background: #dc2626;
  transform: translateY(-50%) scale(1.1);
}

.user-avatar {
  width: 3rem;
  height: 3rem;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.3rem;
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
  transition: all 0.3s ease;
  cursor: pointer;
}

.user-avatar:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 12px 32px rgba(59, 130, 246, 0.5);
}

.page-content {
  padding: 2rem;
  max-width: 64rem;
  margin: 0 auto;
}

.stats-header {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  padding: 2.5rem;
  margin-bottom: 2.5rem;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  position: relative;
  overflow: hidden;
}

.stats-header::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 6px;
  background: linear-gradient(90deg, #f59e0b, #ef4444, #8b5cf6, #3b82f6);
  border-radius: 24px 24px 0 0;
}

.stats-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.stats-left {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.stats-icon {
  width: 5rem;
  height: 5rem;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 800;
  font-size: 1.5rem;
  box-shadow: 0 12px 32px rgba(59, 130, 246, 0.4);
  position: relative;
}

.stats-icon::after {
  content: '';
  position: absolute;
  inset: -2px;
  background: linear-gradient(45deg, #3b82f6, #8b5cf6, #06b6d4);
  border-radius: 22px;
  z-index: -1;
  opacity: 0.7;
}

.stats-info h1 {
  font-size: 2rem;
  font-weight: 800;
  margin: 0 0 0.5rem 0;
  background: linear-gradient(135deg, #1e293b, #475569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.stats-info p {
  color: #64748b;
  margin: 0;
  font-weight: 500;
  font-size: 1rem;
}

.stats-right {
  display: flex;
  gap: 3rem;
}

.stat-item {
  text-align: center;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.5);
  border-radius: 16px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  min-width: 100px;
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 900;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1;
  margin-bottom: 0.5rem;
}

.stat-label {
  color: #64748b;
  font-size: 0.875rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.page-title {
  font-size: 1.75rem;
  font-weight: 800;
  margin-bottom: 2rem;
  background: linear-gradient(135deg, #1e293b, #475569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.categories-container {
  display: flex;
  gap: 1.5rem;
  overflow-x: auto;
  padding: 1.5rem 0;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.categories-container::-webkit-scrollbar {
  display: none;
}

.category-card {
  flex: 0 0 auto;
  width: 130px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 24px;
  padding: 1.5rem;
  text-align: center;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  position: relative;
  overflow: hidden;
}

.category-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
  transition: left 0.5s;
}

.category-card:hover::before {
  left: 100%;
}

.category-card:hover {
  transform: translateY(-12px) scale(1.05);
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
  border-color: rgba(59, 130, 246, 0.5);
}

.featured-card,
.category-card.selected {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  border-color: #2563eb;
  color: white;
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 20px 60px rgba(59, 130, 246, 0.5);
}

.category-image-container {
  margin-bottom: 1.25rem;
  display: flex;
  justify-content: center;
}

.category-image {
  width: 65px;
  height: 65px;
  border-radius: 20px;
  object-fit: cover;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s ease;
}

.category-card:hover .category-image {
  transform: scale(1.1);
}

.category-placeholder {
  width: 65px;
  height: 65px;
  background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  color: #64748b;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s ease;
}

.category-card:hover .category-placeholder {
  transform: scale(1.1);
}

.featured-card .category-placeholder,
.category-card.selected .category-placeholder {
  background: rgba(255, 255, 255, 0.2);
  color: white;
}

.category-name {
  font-size: 0.9rem;
  font-weight: 700;
  line-height: 1.2;
  color: inherit;
  text-transform: capitalize;
}

.no-results {
  text-align: center;
  padding: 4rem 2rem;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.no-results-icon {
  font-size: 4rem;
  margin-bottom: 1rem;
  opacity: 0.7;
}

.no-results h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 0.5rem;
}

.no-results p {
  color: #64748b;
  font-weight: 500;
}

.products-container {
  margin-top: 3rem;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  padding: 2.5rem;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.products-container h3 {
  font-size: 1.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, #1e293b, #475569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 2rem;
}

.loading-products {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  padding: 3rem;
  color: #64748b;
  font-weight: 500;
}

.loading-spinner {
  width: 2rem;
  height: 2rem;
  border: 3px solid #e2e8f0;
  border-top: 3px solid #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.no-products {
  text-align: center;
  padding: 3rem;
  color: #64748b;
}

.no-products-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.7;
}

.product-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 2rem;
}

.product-card {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.product-image-wrapper {
  height: 200px;
  overflow: hidden;
  position: relative;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.product-card:hover .product-image {
  transform: scale(1.1);
}

.product-image-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  color: #64748b;
}

.product-details {
  padding: 1.5rem;
}

.product-details h4 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1e293b;
  margin: 0 0 0.75rem 0;
}

.product-details p {
  color: #64748b;
  font-size: 0.875rem;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.product-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.product-rating {
  font-size: 0.875rem;
  font-weight: 600;
  color: #f59e0b;
}

.product-price {
  font-size: 1.125rem;
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.empty-icon {
  width: 8rem;
  height: 8rem;
  background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 2rem;
  font-size: 3rem;
  color: #64748b;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.empty-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e293b;
  margin: 0 0 1rem 0;
}

.empty-description {
  color: #64748b;
  margin: 0;
  font-weight: 500;
  font-size: 1.1rem;
}

@media (max-width: 768px) {
  .header-content {
    flex-direction: column;
    gap: 1.5rem;
  }
  
  .search-container {
    margin: 0;
    max-width: 100%;
  }
  
  .stats-content {
    flex-direction: column;
    gap: 2rem;
  }
  
  .stats-right {
    justify-content: center;
    gap: 1.5rem;
  }
  
  .categories-container {
    gap: 1rem;
  }
  
  .category-card {
    width: 110px;
    padding: 1.25rem;
  }
  
  .category-image,
  .category-placeholder {
    width: 55px;
    height: 55px;
  }
  
  .product-list {
    grid-template-columns: 1fr;
  }
}
</style>