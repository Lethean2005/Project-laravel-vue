<template>
  <div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
      <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
          <h1 class="text-2xl font-bold text-gray-900">Cart Items</h1>
          <div class="text-sm text-gray-600">
            Total Items: <span class="font-semibold text-blue-600">{{ totalQuantity }}</span>
          </div>
          <div class="text-sm text-gray-600">
            Total Price: <span class="font-semibold text-green-600">${{ totalPrice.toFixed(2) }}</span>
          </div>
          <button 
            @click="fetchCartItems"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
            :disabled="isLoading"
          >
            {{ isLoading ? 'Loading...' : 'Refresh' }}
          </button>
        </div>
      </div>

      <!-- ✅ Summary Card Section -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm text-center">
          <div class="text-2xl font-bold text-blue-600">{{ totalQuantity }}</div>
          <div class="text-sm text-gray-600">Total Items</div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm text-center">
          <div class="text-2xl font-bold text-indigo-600">{{ uniqueProductCount }}</div>
          <div class="text-sm text-gray-600">Total Products</div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm text-center">
          <div class="text-2xl font-bold text-green-600">${{ totalPrice.toFixed(2) }}</div>
          <div class="text-sm text-gray-600">Total Revenue</div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm text-center">
          <div class="text-2xl font-bold text-purple-600">${{ averageValue.toFixed(2) }}</div>
          <div class="text-sm text-gray-600">Avg Order Value</div>
        </div>
      </div>
      <!-- ✅ End Summary -->

      <div v-if="isLoading && cartItems.length === 0" class="p-12 text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
        <p class="text-gray-500">Loading cart items...</p>
      </div>

      <div v-else-if="cartItems.length === 0" class="p-12 text-center">
        <div class="text-6xl mb-4">🛒</div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Items in Cart</h3>
        <p class="text-gray-500">Your cart is empty.</p>
      </div>

      <div v-else class="overflow-x-auto bg-white rounded-lg shadow-sm">
        <table class="w-full table-auto">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="item in cartItems" :key="item.id" class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ item.id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ item.product_id }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                  {{ item.quantity }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">${{ parseFloat(item.price).toFixed(2) }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ formatDateTime(item.created_at) }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ formatDateTime(item.updated_at) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue'

// Change this URL to your backend API URL
const API_BASE_URL = "http://localhost:8000/api"

const cartItems = ref([])
const isLoading = ref(false)

// Fetch cart items from Laravel API
const fetchCartItems = async () => {
  isLoading.value = true
  try {
    const response = await fetch(`${API_BASE_URL}/cart-items`)
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    const data = await response.json()
    if (data.data && Array.isArray(data.data)) {
      cartItems.value = data.data
    } else if (Array.isArray(data)) {
      cartItems.value = data
    } else {
      cartItems.value = []
    }
  } catch (error) {
    console.error('Failed to fetch cart items:', error)
  } finally {
    isLoading.value = false
  }
}

// Total quantity
const totalQuantity = computed(() => {
  return cartItems.value.reduce((sum, item) => sum + Number(item.quantity), 0)
})

// Total price
const totalPrice = computed(() => {
  return cartItems.value.reduce((sum, item) => sum + (Number(item.price) * Number(item.quantity)), 0)
})

// ✅ Total unique products
const uniqueProductCount = computed(() => {
  const unique = new Set(cartItems.value.map(item => item.product_id))
  return unique.size
})

// ✅ Average order value
const averageValue = computed(() => {
  if (cartItems.value.length === 0) return 0
  return totalPrice.value / cartItems.value.length
})

// Format date time string
const formatDateTime = (dateStr) => {
  if (!dateStr) return ''
  const date = new Date(dateStr)
  if (isNaN(date.getTime())) return dateStr
  return date.toLocaleString()
}

onMounted(() => {
  fetchCartItems()
})
</script>
