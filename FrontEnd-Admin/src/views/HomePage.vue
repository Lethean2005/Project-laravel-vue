<template>
  <div class="min-h-screen bg-amber-50">
    <!-- Main Content Container -->
    <div class="flex gap-6 p-6">
      <!-- Left Column -->
      <div class="flex-1 space-y-6">
        <!-- Header -->
        <div class="bg-white px-6 py-6 rounded-3xl shadow-sm">
          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
              <!-- Hamburger Menu -->
              <button class="p-2 bg-orange-400 rounded-lg text-white hover:bg-orange-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
              
              <!-- Search Bar -->
              <div class="relative flex-1 max-w-md">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search"
                  class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-700"
                />
              </div>
            </div>
            
            <div class="flex items-center gap-3">
              <!-- User Avatar -->
              <div class="h-10 w-10 bg-orange-400 rounded-full flex items-center justify-center">
                <span class="text-white font-bold">😊</span>
              </div>
              
              <!-- Cart Icon -->
              <div class="relative">
                <button class="p-2 bg-orange-100 rounded-lg hover:bg-orange-200">
                  <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6" />
                  </svg>
                </button>
                <span class="absolute -top-2 -right-2 bg-green-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                  {{ cartItemsCount }}
                </span>
              </div>
            </div>
          </div>
          
          <!-- Breadcrumb -->
          <!-- <div class="text-sm text-gray-500 mb-4">
            <span>Store</span>
            <span class="mx-2">></span>
            <span class="text-gray-900">Bell fresh</span>
          </div> -->
        </div>

        <!-- Restaurant Banner -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-3xl p-8 text-white relative overflow-hidden">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-orange-400 rounded-2xl flex items-center justify-center">
              <span class="text-2xl font-bold text-white">Food</span>
            </div>
            <div>
              <h2 class="text-2xl font-bold">Foodie</h2>
              <p class="text-gray-300">Fresh & healthy food recipe</p>
            </div>
          </div>
          
          <div class="flex gap-8">
            <div class="text-center">
              <div class="text-3xl font-bold text-orange-400">{{ totalProducts }}</div>
              <div class="text-sm text-gray-300">Total item</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-orange-400">{{ totalCategories }}</div>
              <div class="text-sm text-gray-300">Category</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-orange-400">04</div>
              <div class="text-sm text-gray-300">Outdate</div>
            </div>
          </div>
        </div>

        <!-- Categories -->
        <div v-if="!isLoadingCategories">
          <div class="flex gap-4 overflow-x-auto pb-2">
            <button
              v-for="(category, index) in categories"
              :key="category.id"
              :class="[
                'flex flex-col items-center gap-3 rounded-2xl p-4 min-w-[120px] transition-all duration-200',
                category.active
                  ? 'bg-orange-400 text-white shadow-lg'
                  : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'
              ]"
              @click="setActiveCategory(index)"
            >
              <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-100 flex items-center justify-center">
                <img
                  v-if="category.image_url"
                  :src="getCategoryImageUrl(category.image_url)"
                  :alt="category.name"
                  class="w-full h-full object-cover"
                  @error="handleImageError"
                />
                <span v-else class="text-2xl">{{ getCategoryIcon(category.name) }}</span>
              </div>
              <span class="font-medium text-sm">{{ category.name }}</span>
            </button>
          </div>
        </div>

        <!-- Loading Categories -->
        <div v-else class="flex gap-4 pb-2">
          <div v-for="i in 4" :key="i" class="flex flex-col items-center gap-3 rounded-2xl p-4 min-w-[120px] bg-white animate-pulse">
            <div class="w-16 h-16 rounded-2xl bg-gray-200"></div>
            <div class="w-16 h-4 bg-gray-200 rounded"></div>
          </div>
        </div>

        <!-- Popular Dish -->
        <div>
          <h3 class="text-2xl font-bold text-gray-900 mb-6">Popular Dish</h3>
          
          <!-- Loading Products -->
          <div v-if="isLoadingProducts" class="grid grid-cols-4 gap-6">
            <div v-for="i in 8" :key="i" class="bg-white rounded-3xl shadow-sm overflow-hidden animate-pulse">
              <div class="p-6">
                <div class="w-full h-32 rounded-2xl bg-gray-200 mb-4"></div>
                <div class="h-4 bg-gray-200 rounded mb-2"></div>
                <div class="h-3 bg-gray-200 rounded mb-4"></div>
                <div class="flex justify-between items-center">
                  <div class="h-4 bg-gray-200 rounded w-16"></div>
                  <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Products Grid -->
          <div v-else-if="filteredProducts.length > 0" class="grid grid-cols-4 gap-6">
            <div
              v-for="(product, index) in filteredProducts"
              :key="product.id"
              :class="[
                'rounded-3xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300',
                index === 1 ? 'bg-orange-400 text-white' : 'bg-white'
              ]"
            >
              <div class="p-6">
                <div class="relative mb-4">
                  <div class="w-full h-32 rounded-2xl overflow-hidden bg-gray-100 flex items-center justify-center">
                    <img
                      v-if="product.image_url"
                      :src="getProductImageUrl(product.image_url)"
                      :alt="product.name"
                      class="w-full h-full object-cover"
                      @error="handleProductImageError"
                    />
                    <span v-else class="text-4xl">🍽️</span>
                  </div>
                </div>
                
                <h4 :class="['font-bold mb-2 text-center text-sm', index === 1 ? 'text-white' : 'text-gray-900']">
                  {{ product.name }}
                </h4>
                
                <div :class="['flex items-center justify-center gap-3 text-xs mb-4', index === 1 ? 'text-white/80' : 'text-gray-500']">
                  <span>{{ getRandomCalories() }} calories</span>
                  <span>•</span>
                  <span>{{ getRandomServings() }} persons</span>
                </div>
                
                <div class="flex justify-between items-center">
                  <span :class="['font-bold text-lg', index === 1 ? 'text-white' : 'text-gray-900']">
                    ${{ Number(product.price).toFixed(2) }}
                  </span>
                  <button 
                    :class="[
                      'rounded-full w-8 h-8 flex items-center justify-center font-bold transition-colors',
                      index === 1 
                        ? 'bg-white text-orange-400 hover:bg-gray-100' 
                        : 'bg-orange-400 text-white hover:bg-orange-500'
                    ]"
                    @click="addToCart(product)"
                  >
                    +
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-else class="text-center py-12">
            <div class="text-6xl mb-4">🍽️</div>
            <p class="text-gray-500 text-lg">No products found</p>
            <p class="text-gray-400 mt-2" v-if="searchQuery">Try adjusting your search terms</p>
          </div>
        </div>
      </div>

      <!-- Right Column - Cart -->
      <div class="w-80">
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden sticky top-6">
          <div class="p-6">
            <!-- Cart Header -->
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-xl font-bold text-gray-900">My cart</h3>
              <button class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </button>
            </div>
            
            <!-- Cart Items -->
            <div class="space-y-4 mb-6">
              <div v-for="item in cartItems" :key="item.id" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100">
                  <img
                    v-if="item.image_url"
                    :src="getProductImageUrl(item.image_url)"
                    :alt="item.name"
                    class="w-full h-full object-cover"
                  />
                  <div v-else class="w-full h-full flex items-center justify-center text-lg">🍽️</div>
                </div>
                <div class="flex-1">
                  <div class="flex items-center justify-between gap-2">
                    <span class="text-sm text-gray-600">{{ item.quantity }} ×</span>
                    <span class="font-medium text-gray-900 text-sm truncate max-w-[100px]">{{ item.name }}</span>
                    <span class="font-bold text-orange-500">${{ (item.price * item.quantity).toFixed(2) }}</span>
                    <button
                      @click="removeFromCart(item.id)"
                      class="text-red-500 hover:text-red-700 font-bold px-2 rounded"
                      title="Remove item"
                    >
                      ✕
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="border-t pt-4 space-y-3">
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Final</span>
                <span class="font-medium">${{ finalAmount.toFixed(2) }}</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Discount</span>
                <span class="text-green-500 font-medium">%{{ discount }}</span>
              </div>
              <div class="flex justify-between text-lg font-bold">
                <span>Final</span>
                <span class="text-orange-500">${{ totalAmount.toFixed(2) }}</span>
              </div>
            </div>
            
            <!-- Checkout Button -->
            <button class="w-full bg-green-500 hover:bg-green-600 text-white rounded-2xl py-4 font-medium transition-colors mt-6">
              Checkout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'

const API_BASE_URL = "http://localhost:8000/api"

const categories = ref([])
const products = ref([])
const cartItems = ref([])
const searchQuery = ref('')
const selectedCategoryId = ref(null)
const isLoadingCategories = ref(true)
const isLoadingProducts = ref(true)
const discount = ref(10)

const totalCategories = computed(() => categories.value.length)
const totalProducts = computed(() => products.value.length)

const filteredProducts = computed(() => {
  let filtered = products.value

  if (searchQuery.value) {
    filtered = filtered.filter(product =>
      product.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      (product.description && product.description.toLowerCase().includes(searchQuery.value.toLowerCase()))
    )
  }

  if (selectedCategoryId.value) {
    filtered = filtered.filter(product => product.category_id === selectedCategoryId.value)
  }

  return filtered.slice(0, 8)
})

const cartItemsCount = computed(() => {
  return cartItems.value.reduce((total, item) => total + item.quantity, 0)
})

const finalAmount = computed(() => {
  return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0)
})

const totalAmount = computed(() => {
  const discountAmount = finalAmount.value * (discount.value / 100)
  return finalAmount.value - discountAmount
})

const getCategoryImageUrl = (imagePath) => {
  if (!imagePath) return null
  if (imagePath.startsWith("http")) return imagePath
  if (imagePath.startsWith("public/")) {
    return window.location.origin + "/" + imagePath.replace("public/", "storage/")
  }
  if (imagePath.startsWith("category_images/")) {
    return window.location.origin + "/storage/" + imagePath
  }
  if (imagePath.startsWith("categories/")) {
    return window.location.origin + "/storage/" + imagePath
  }
  return window.location.origin + "/storage/category_images/" + imagePath
}

const getProductImageUrl = (imagePath) => {
  if (!imagePath) return null
  if (imagePath.startsWith("http")) return imagePath
  if (imagePath.startsWith("public/")) {
    return window.location.origin + "/" + imagePath.replace("public/", "storage/")
  }
  if (imagePath.startsWith("product_images/")) {
    return window.location.origin + "/storage/" + imagePath
  }
  return window.location.origin + "/storage/product_images/" + imagePath
}

const getCategoryIcon = (categoryName) => {
  const iconMap = {
    'burger': '🍔',
    'burgers': '🍔',
    'pizza': '🍕',
    'salad': '🥗',
    'salads': '🥗',
    'drinks': '🥤',
    'drink': '🥤',
    'noodles': '🍜',
    'pasta': '🍝',
    'dessert': '🍰',
    'desserts': '🍰',
    'coffee': '☕',
    'sandwich': '🥪',
    'chicken': '🍗',
    'seafood': '🦐'
  }

  const key = categoryName.toLowerCase()
  return iconMap[key] || '🍽️'
}

const getRandomCalories = () => Math.floor(Math.random() * 200) + 100
const getRandomServings = () => Math.floor(Math.random() * 4) + 2

const handleImageError = (event) => {
  console.log('Category image failed to load:', event.target.src)
}

const handleProductImageError = (event) => {
  console.log('Product image failed to load:', event.target.src)
  event.target.src = '/placeholder.svg?height=200&width=200'
}

const fetchCategories = async () => {
  try {
    isLoadingCategories.value = true
    const res = await axios.get(`${API_BASE_URL}/categories`)
    console.log("Categories API Response:", res.data)

    const rawCategories = res.data.data || res.data
    categories.value = rawCategories.map((cat, index) => ({
      ...cat,
      image_url: cat.image ? `${API_BASE_URL.replace("/api", "")}/storage/${cat.image}` : null,
      active: index === 0
    }))
    if (categories.value.length > 0) {
      selectedCategoryId.value = categories.value[0].id
    }
  } catch (error) {
    console.error('Failed to fetch categories:', error)
  } finally {
    isLoadingCategories.value = false
  }
}

const fetchProducts = async () => {
  try {
    isLoadingProducts.value = true
    const res = await axios.get(`${API_BASE_URL}/products`)
    console.log("Products API Response:", res.data)

    const rawProducts = res.data.data || res.data
    products.value = rawProducts.map(p => ({
      ...p,
      image_url: p.image ? `${API_BASE_URL.replace("/api", "")}/storage/${p.image}` : null
    }))
  } catch (error) {
    console.error('Failed to fetch products:', error)
  } finally {
    isLoadingProducts.value = false
  }
}

const setActiveCategory = (index) => {
  categories.value.forEach((cat, i) => {
    cat.active = i === index
  })
  selectedCategoryId.value = categories.value[index].id
}

const addToCart = async (product) => {
  const existingItem = cartItems.value.find(item => item.id === product.id)

  if (existingItem) {
    existingItem.quantity += 1
  } else {
    cartItems.value.push({
      id: product.id,
      name: product.name,
      price: Number(product.price),
      quantity: 1,
      image_url: product.image_url
    })
  }

  saveCartToLocalStorage()

  try {
    await axios.post(`${API_BASE_URL}/cart-items`, {
      product_id: product.id,
      quantity: 1,
      price: product.price
    })
    console.log('✔ Cart item stored in backend')
  } catch (error) {
    console.error('❌ Failed to store cart item:', error)
  }

  console.log('Added to cart:', product.name)
}

const removeFromCart = (productId) => {
  const index = cartItems.value.findIndex(item => item.id === productId)
  if (index !== -1) {
    cartItems.value.splice(index, 1)
    saveCartToLocalStorage()
  }
}

const saveCartToLocalStorage = () => {
  localStorage.setItem('cartItems', JSON.stringify(cartItems.value))
}

const loadCartFromLocalStorage = () => {
  const saved = localStorage.getItem('cartItems')
  if (saved) {
    try {
      cartItems.value = JSON.parse(saved)
    } catch {
      cartItems.value = []
    }
  }
}

onMounted(async () => {
  loadCartFromLocalStorage()
  await Promise.all([fetchCategories(), fetchProducts()])
})

watch(cartItems, () => {
  saveCartToLocalStorage()
}, { deep: true })
</script>

<style scoped>
/* Add any of your styles here */
</style>
