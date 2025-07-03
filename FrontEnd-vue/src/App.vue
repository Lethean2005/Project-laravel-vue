<template>
  <div class="h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-red-900 flex overflow-hidden">
    <!-- Left Sidebar - Fixed -->
    <div class="w-64 bg-gray-800 bg-opacity-50 backdrop-blur-sm p-6 relative rounded-r-3xl flex-shrink-0">
      <!-- Logo -->
      <div class="flex items-center mb-8 relative z-10">
        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl">
          S
        </div>
      </div>

      <!-- Navigation -->
      <nav class="space-y-2 relative z-10">
        <div class="flex items-center space-x-3 text-orange-400 bg-gray-700 bg-opacity-50 rounded-lg p-3">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
          </svg>
          <span class="font-medium">Dashboard</span>
        </div>
        
        <div class="flex items-center space-x-3 text-gray-400 hover:text-white p-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50 cursor-pointer transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span>Orders</span>
        </div>
        
        <div class="flex items-center space-x-3 text-gray-400 hover:text-white p-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50 cursor-pointer transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>Restaurants</span>
        </div>
        
        <div class="flex items-center space-x-3 text-gray-400 hover:text-white p-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50 cursor-pointer transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Finance</span>
        </div>
        
        <div class="flex items-center space-x-3 text-gray-400 hover:text-white p-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50 cursor-pointer transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span>Logout</span>
        </div>
      </nav>

      <!-- Bottom Icons -->
      <div class="absolute bottom-6 left-6 flex space-x-3 z-10">
        <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center cursor-pointer hover:bg-gray-600 transition-colors">
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center cursor-pointer hover:bg-gray-600 transition-colors">
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h10a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
      <!-- Fixed Search Bar -->
      <div class="p-8 pb-0 flex-shrink-0">
        <div class="relative">
          <input 
            type="text" 
            placeholder="Search Restaurant, Food, Cuisine or a Dish"
            class="w-full bg-gray-800 bg-opacity-40 backdrop-blur-sm text-white placeholder-gray-500 rounded-full px-6 py-4 pr-16 focus:outline-none focus:ring-2 focus:ring-orange-400 border border-gray-700 border-opacity-30"
          >
          <div class="absolute right-3 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gray-600 bg-opacity-80 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- Scrollable Content Area -->
      <div class="flex-1 overflow-y-auto px-8 py-8">
        <!-- Categories Section -->
        <div class="mb-10">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="text-white text-2xl font-bold mb-1">Categories</h2>
              <p class="text-gray-400 text-sm">
                <span class="text-orange-500 font-semibold">10+ New</span> Categories added this week
              </p>
            </div>
            <button class="flex items-center text-gray-400 hover:text-white transition-colors group">
              <span class="mr-3 text-sm">View More</span>
              <div class="w-8 h-8 bg-gray-600 bg-opacity-60 rounded-full flex items-center justify-center group-hover:bg-opacity-80 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </div>
            </button>
          </div>
          
          <div class="flex space-x-4">
            <div v-for="category in categories" :key="category.name" class="w-16 h-16 bg-gray-700 bg-opacity-40 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-60 transition-all duration-200 hover:scale-105">
              <span class="text-2xl">{{ category.icon }}</span>
            </div>
          </div>
        </div>

        <!-- Popular Dishes Section -->
        <div class="mb-10">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="text-white text-2xl font-bold mb-1">Popular Dishes</h2>
              <p class="text-gray-400 text-sm">
                <span class="text-orange-500 font-semibold">20+ New</span> dishes added this week
              </p>
            </div>
            <button class="flex items-center text-gray-400 hover:text-white transition-colors group">
              <span class="mr-3 text-sm">View More</span>
              <div class="w-8 h-8 bg-gray-600 bg-opacity-60 rounded-full flex items-center justify-center group-hover:bg-opacity-80 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </div>
            </button>
          </div>

          <div class="grid grid-cols-3 gap-6">
            <div v-for="dish in popularDishes" :key="dish.name" class="bg-gray-800 bg-opacity-40 backdrop-blur-sm rounded-2xl p-6 hover:bg-opacity-60 cursor-pointer transition-all duration-200 hover:scale-105">
              <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                <span class="text-5xl">{{ dish.icon }}</span>
              </div>
              <h3 class="text-white text-xl font-bold text-center mb-2">{{ dish.name }}</h3>
              <p class="text-gray-400 text-sm text-center mb-1">Starting from</p>
              <p class="text-white text-lg font-bold text-center mb-4">${{ dish.price }}</p>
              <div class="flex items-center justify-between text-sm">
                <div class="flex items-center text-yellow-400">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                  <span class="font-medium">{{ dish.rating }}</span>
                </div>
                <div class="text-gray-400 text-right">
                  <div class="font-medium text-white text-sm">{{ dish.sales }}</div>
                  <div class="text-xs">Total Sale</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Reports Section -->
        <div class="mb-8">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="text-white text-2xl font-bold mb-1">Order Reports</h2>
              <p class="text-gray-400 text-sm">
                <span class="text-orange-500 font-semibold">Wow!! 100+ New</span> order got this week
              </p>
            </div>
            <button class="flex items-center text-gray-400 hover:text-white transition-colors group">
              <span class="mr-3 text-sm">View More</span>
              <div class="w-8 h-8 bg-gray-600 bg-opacity-60 rounded-full flex items-center justify-center group-hover:bg-opacity-80 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </div>
            </button>
          </div>

          <div class="bg-gray-800 bg-opacity-40 backdrop-blur-sm rounded-2xl overflow-hidden">
            <div class="grid grid-cols-5 gap-6 text-gray-400 text-sm font-medium px-6 py-4 bg-gray-700 bg-opacity-30">
              <span>Customer</span>
              <span>Order number</span>
              <span>Address</span>
              <span>Amount</span>
              <span>Status</span>
            </div>
            
            <div v-for="order in orders" :key="order.id" class="grid grid-cols-5 gap-6 items-center px-6 py-4 border-b border-gray-700 border-opacity-30 last:border-b-0 hover:bg-gray-700 hover:bg-opacity-20 transition-colors">
              <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                  {{ order.customer.charAt(0) }}
                </div>
                <span class="text-white font-medium">{{ order.customer }}</span>
              </div>
              <span class="text-gray-300 text-sm">{{ order.orderNumber }}</span>
              <span class="text-gray-300 text-sm">{{ order.address }}</span>
              <span class="text-white font-semibold">${{ order.amount }}</span>
              <span :class="order.status === 'Completed' ? 'bg-green-500 text-white' : 'bg-orange-500 text-white'" class="px-3 py-1 rounded-full text-xs font-medium inline-block w-fit">
                {{ order.status }}
              </span>
            </div>
          </div>
        </div>

        <!-- Add more content to demonstrate scrolling -->
        <div class="mb-8">
          <div class="bg-gray-800 bg-opacity-40 backdrop-blur-sm rounded-2xl p-6">
            <h3 class="text-white text-xl font-bold mb-4">Additional Content</h3>
            <p class="text-gray-300 mb-4">This is additional content to demonstrate the scrolling behavior.</p>
            <div class="space-y-4">
              <div v-for="i in 10" :key="i" class="bg-gray-700 bg-opacity-40 rounded-lg p-4">
                <h4 class="text-white font-medium">Sample Item {{ i }}</h4>
                <p class="text-gray-400 text-sm">This is sample content item {{ i }} to show scrolling.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Sidebar - Scrollable -->
    <div class="w-80 bg-gray-800 bg-opacity-50 backdrop-blur-sm rounded-l-3xl flex-shrink-0 flex flex-col">
      <div class="p-6 overflow-y-auto flex-1">
        <!-- Delivery Address -->
        <div class="mb-6">
          <div class="bg-gray-700 bg-opacity-60 rounded-2xl p-5">
            <h3 class="text-white text-lg font-bold mb-4">DELIVERY ADDRESS</h3>
            <div class="flex items-start space-x-3 mb-3">
              <svg class="w-4 h-4 text-orange-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
              </svg>
              <span class="text-gray-300 text-sm leading-relaxed">Po. 1478, Street No. 52, West New York</span>
            </div>
            <div class="flex items-center space-x-3">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span class="text-gray-400 text-sm">20 min</span>
            </div>
          </div>
        </div>

        <!-- Cart -->
        <div class="mb-6">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0L17 18"/>
              </svg>
              <h3 class="text-white text-lg font-bold">Cart</h3>
            </div>
            <span class="text-gray-400 text-sm">Order ID: #1099</span>
          </div>

          <!-- Delivery Options -->
          <div class="flex space-x-1 mb-6 bg-gray-700 bg-opacity-40 rounded-xl p-1">
            <button class="flex-1 bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
              Delivery
            </button>
            <button class="flex-1 text-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-600 hover:bg-opacity-50 transition-colors">
              Dine In
            </button>
            <button class="flex-1 text-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-600 hover:bg-opacity-50 transition-colors">
              Takeaway
            </button>
          </div>

          <!-- Cart Items -->
          <div class="space-y-4 mb-6">
            <div v-for="item in cartItems" :key="item.id" class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-orange-400 rounded-xl flex items-center justify-center text-2xl">
                  {{ item.icon }}
                </div>
                <div>
                  <h4 class="text-white font-medium text-sm">{{ item.name }}</h4>
                  <p class="text-gray-400 text-xs mb-2">{{ item.description }}</p>
                  <div class="flex items-center space-x-3">
                    <button class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white text-xs hover:bg-gray-500 transition-colors">
                      −
                    </button>
                    <span class="text-white text-sm font-medium">{{ item.quantity }}</span>
                    <button class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white text-xs hover:bg-gray-500 transition-colors">
                      +
                    </button>
                  </div>
                </div>
              </div>
              <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center cursor-pointer hover:bg-gray-500 transition-colors">
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
              </div>
            </div>
          </div>

          <!-- Dashed Separator -->
          <div class="border-t border-dashed border-gray-600 mb-6"></div>

          <!-- Promotion Code -->
          <div class="flex items-center justify-between mb-6">
            <span class="text-gray-400 text-sm">Promotion Code</span>
            <button class="bg-gray-900 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-800 transition-colors">
              TRYNEW
            </button>
          </div>

          <!-- Order Summary -->
          <div class="space-y-3 mb-6">
            <div class="flex justify-between text-gray-300 text-sm">
              <span>Sub Total</span>
              <span>${{ orderSummary.subTotal }}</span>
            </div>
            <div class="flex justify-between text-gray-300 text-sm">
              <span>Delivery Charge</span>
              <span>${{ orderSummary.deliveryCharge }}</span>
            </div>
            <div class="border-t border-gray-600 pt-3">
              <div class="flex justify-between text-white font-bold text-lg">
                <span>TOTAL</span>
                <span>${{ orderSummary.total }}</span>
              </div>
            </div>
          </div>

          <!-- Confirm Order Button -->
          <button class="w-full bg-gray-900 text-white py-4 rounded-2xl font-semibold hover:bg-gray-800 transition-colors">
            Confirm Order
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const categories = ref([
  { name: 'Burger', icon: '🍔' },
  { name: 'Pizza', icon: '🍕' },
  { name: 'Cake', icon: '🎂' },
  { name: 'Sandwich', icon: '🥪' },
  { name: 'Hot Dog', icon: '🌭' },
  { name: 'Smoothie', icon: '🥤' },
  { name: 'Dessert', icon: '🍰' }
])

const popularDishes = ref([
  {
    name: 'Hamburger',
    icon: '🍔',
    price: '10.00',
    rating: '4.5',
    sales: '1350'
  },
  {
    name: 'Pizza',
    icon: '🍕',
    price: '25.00',
    rating: '4.1',
    sales: '1100'
  },
  {
    name: 'Sushi',
    icon: '🍣',
    price: '15.00',
    rating: '4.1',
    sales: '1100'
  }
])

const orders = ref([
  {
    id: 1,
    customer: 'Jameed Jhon',
    orderNumber: '018472320073',
    address: 'Karang Tengah Hills',
    amount: '120.45',
    status: 'Completed'
  },
  {
    id: 2,
    customer: 'Peter Parker',
    orderNumber: '019788448047',
    address: 'City Center, CA',
    amount: '140.45',
    status: 'Pending'
  }
])

const cartItems = ref([
  {
    id: 1,
    name: 'Pepperoni Pizza',
    description: 'Thin Crust',
    icon: '🍕',
    quantity: 2
  },
  {
    id: 2,
    name: 'Cheese Burger',
    description: 'Whole wheat bun',
    icon: '🍔',
    quantity: 2
  }
])

const orderSummary = ref({
  subTotal: '155.20',
  deliveryCharge: '10',
  total: '165.20'
})
</script>

<style scoped>
/* Custom scrollbar for the content area */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: rgba(55, 65, 81, 0.3);
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: rgba(156, 163, 175, 0.5);
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: rgba(156, 163, 175, 0.7);
}
</style>