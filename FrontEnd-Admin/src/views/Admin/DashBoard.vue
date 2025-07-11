<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-6">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="flex items-center justify-between mb-8">
        <div>
          <h1 class="text-sm text-gray-500 mb-1">Welcome back, Admin! 👋</h1>
          <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
        </div>
        <div class="flex items-center gap-4">
          <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>
          <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span v-if="recentOrders.length > 0" class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
          </button>
          <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
            <span class="text-white font-semibold text-sm">A</span>
          </div>
        </div>
      </div>

      <!-- Main Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Recent Orders from Cart Items -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
            <button @click="refreshOrders" class="text-sm text-blue-600 hover:text-blue-700 font-medium" :disabled="isLoading">
              🔄 {{ isLoading ? 'Loading...' : 'Refresh Orders' }}
            </button>
          </div>
          
          <!-- Loading State -->
          <div v-if="isLoading && recentOrders.length === 0" class="text-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-500">Loading orders...</p>
          </div>
          
          <!-- No Orders State -->
          <div v-else-if="recentOrders.length === 0" class="text-center py-12">
            <div class="text-6xl mb-4">📋</div>
            <h4 class="text-xl font-semibold text-gray-900 mb-2">No Recent Orders</h4>
            <p class="text-gray-500 mb-4">Orders from the cart items will appear here</p>
            <button @click="addSampleOrder" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
              Add Sample Order
            </button>
          </div>

          <!-- Orders List -->
          <div v-else class="space-y-4">
            <div v-for="order in recentOrders" :key="order.id" class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
              <div class="flex items-center gap-4">
                <!-- Product Image -->
                <div class="w-12 h-12 rounded-xl overflow-hidden bg-gradient-to-r from-orange-100 to-orange-200 flex items-center justify-center">
                  <img
                    v-if="order.product_image && order.product_image !== 'no-image'"
                    :src="getProductImageUrl(order.product_image)"
                    :alt="order.product_name"
                    class="w-full h-full object-cover"
                    @error="handleOrderImageError"
                  />
                  <span v-else class="text-2xl">🍽️</span>
                </div>
                <div>
                  <h4 class="font-medium text-gray-900">{{ order.product_name || `Product #${order.product_id}` }}</h4>
                  <p class="text-sm text-gray-500">{{ order.quantity }} item{{ order.quantity > 1 ? 's' : '' }} • {{ getTimeAgo(order.created_at) }}</p>
                  <p class="text-xs text-gray-400">Order #{{ order.id }}</p>
                </div>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-900">${{ (order.price * order.quantity).toFixed(2) }}</p>
                <span class="inline-block px-2 py-1 rounded-full text-xs font-medium" :class="getOrderStatusClass(order.status)">
                  {{ getOrderStatus(order.status) }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Statistics -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Order Statistics</h3>
            <button @click="refreshOrders" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all stats</button>
          </div>
          
          <div class="grid grid-cols-2 gap-4">
            <div class="text-center">
              <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <p class="text-2xl font-bold text-gray-900">{{ orderStats.completed }}</p>
              <p class="text-xs text-gray-500 uppercase tracking-wide">Completed</p>
            </div>
            
            <div class="text-center">
              <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <p class="text-2xl font-bold text-gray-900">{{ orderStats.pending }}</p>
              <p class="text-xs text-gray-500 uppercase tracking-wide">Pending</p>
            </div>
            
            <div class="text-center">
              <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </div>
              <p class="text-2xl font-bold text-gray-900">{{ orderStats.total }}</p>
              <p class="text-xs text-gray-500 uppercase tracking-wide">Total Orders</p>
            </div>
            
            <div class="text-center">
              <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
              </div>
              <p class="text-2xl font-bold text-gray-900">${{ orderStats.revenue.toFixed(2) }}</p>
              <p class="text-xs text-gray-500 uppercase tracking-wide">Revenue</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Revenue Card -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl p-6 text-white">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
              </svg>
            </div>
            <span class="text-sm font-medium opacity-80">REVENUE</span>
          </div>
          <p class="text-3xl font-bold mb-2">${{ orderStats.revenue.toFixed(2) }}</p>
          <p class="text-sm opacity-80">From {{ orderStats.total }} orders</p>
        </div>

        <!-- Orders Card -->
        <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-2xl p-6 text-white">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
            </div>
            <span class="text-sm font-medium opacity-80">ORDERS</span>
          </div>
          <p class="text-3xl font-bold mb-2">{{ orderStats.total }}</p>
          <p class="text-sm opacity-80">{{ orderStats.pending }} pending</p>
        </div>

        <!-- Products Card -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl p-6 text-white">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
            </div>
            <span class="text-sm font-medium opacity-80">PRODUCTS</span>
          </div>
          <p class="text-3xl font-bold mb-2">{{ uniqueProductCount }}</p>
          <p class="text-sm opacity-80">{{ totalCategories }} categories</p>
        </div>

        <!-- Average Order Card -->
        <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl p-6 text-white">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="text-sm font-medium opacity-80">AVG ORDER</span>
          </div>
          <p class="text-3xl font-bold mb-2">${{ avgOrderAmount.toFixed(2) }}</p>
          <p class="text-sm opacity-80">per order</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";

// API Configuration
const API_BASE_URL = "http://localhost:8000/api";

// Reactive data
const cartItems = ref([]);
const products = ref([]);
const isLoading = ref(false);
const orderStats = ref({
  completed: 0,
  pending: 0,
  total: 0,
  revenue: 0,
});

// Computed properties
const recentOrders = computed(() => {
  // Transform cart items to orders and get the 5 most recent
  return cartItems.value
    .slice()
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 5)
    .map((item) => {
      // Find the matching product
      const product = products.value.find(p => p.id === item.product_id);
      
      return {
        ...item,
        product_name: product ? product.name : `Product #${item.product_id}`,
        product_image: product ? product.image_url : null,
        status: Math.random() > 0.5 ? "completed" : "pending", // Random status for demo
        price: Number(item.price),
      };
    });
});

const totalCategories = computed(() => 5); // Placeholder
const uniqueProductCount = computed(() => {
  const unique = new Set(cartItems.value.map(item => item.product_id));
  return unique.size;
});

const avgOrderAmount = computed(() => {
  return orderStats.value.total > 0
    ? orderStats.value.revenue / orderStats.value.total
    : 0;
});

// Helper functions
function getTimeAgo(dateString) {
  const date = new Date(dateString);
  const now = new Date();
  const diffSeconds = Math.floor((now - date) / 1000);
  if (diffSeconds < 60) return `${diffSeconds} sec ago`;
  if (diffSeconds < 3600) return `${Math.floor(diffSeconds / 60)} min ago`;
  if (diffSeconds < 86400) return `${Math.floor(diffSeconds / 3600)} hrs ago`;
  return `${Math.floor(diffSeconds / 86400)} days ago`;
}

function getOrderStatus(status) {
  if (status === "completed") return "Completed";
  if (status === "pending") return "Pending";
  return "Unknown";
}

function getOrderStatusClass(status) {
  if (status === "completed") return "bg-green-100 text-green-800";
  if (status === "pending") return "bg-yellow-100 text-yellow-800";
  return "bg-gray-100 text-gray-800";
}

function getProductImageUrl(url) {
  if (!url) return null;
  return url.startsWith("http") ? url : `http://localhost:8000/storage/${url}`;
}

function handleOrderImageError(event) {
  event.target.src = "https://via.placeholder.com/48?text=No+Image";
}

// API functions
async function fetchCartItems() {
  isLoading.value = true;
  try {
    const response = await fetch(`${API_BASE_URL}/cart-items`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    if (data.data && Array.isArray(data.data)) {
      cartItems.value = data.data;
    } else if (Array.isArray(data)) {
      cartItems.value = data;
    } else {
      cartItems.value = [];
    }
    processOrders();
  } catch (error) {
    console.error("Error fetching cart items:", error);
    // Fallback to localStorage
    const storedItems = localStorage.getItem("cartItems");
    if (storedItems) {
      cartItems.value = JSON.parse(storedItems);
      processOrders();
    }
  } finally {
    isLoading.value = false;
  }
}

async function fetchProducts() {
  try {
    const response = await fetch(`${API_BASE_URL}/products`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    if (data.data && Array.isArray(data.data)) {
      products.value = data.data;
    } else if (Array.isArray(data)) {
      products.value = data;
    } else {
      products.value = [];
    }
  } catch (error) {
    console.error("Error fetching products:", error);
  }
}

function processOrders() {
  // Compute stats from cart items
  let completed = 0;
  let pending = 0;
  let revenue = 0;

  const orders = recentOrders.value;
  orders.forEach((order) => {
    if (order.status === "completed") completed++;
    if (order.status === "pending") pending++;
  });

  // Calculate total revenue from all cart items
  revenue = cartItems.value.reduce((sum, item) => {
    return sum + (Number(item.price) * item.quantity);
  }, 0);

  orderStats.value = {
    completed,
    pending,
    total: cartItems.value.length,
    revenue,
  };
}

async function refreshOrders() {
  await Promise.all([fetchCartItems(), fetchProducts()]);
}

function addSampleOrder() {
  // Add a dummy sample order to demonstrate
  const sampleItem = {
    id: Math.floor(Math.random() * 100000),
    product_id: Math.floor(Math.random() * 10) + 1,
    quantity: Math.floor(Math.random() * 5) + 1,
    price: (Math.random() * 20 + 5).toFixed(2),
    created_at: new Date().toISOString(),
    updated_at: new Date().toISOString(),
  };

  cartItems.value.unshift(sampleItem);
  processOrders();
  localStorage.setItem("cartItems", JSON.stringify(cartItems.value));
}

// Lifecycle hook
onMounted(async () => {
  await Promise.all([fetchCartItems(), fetchProducts()]);
});
</script>

<style scoped>
/* Add any scoped styles here if needed */
</style>