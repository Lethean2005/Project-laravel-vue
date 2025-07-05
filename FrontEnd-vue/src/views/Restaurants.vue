<template>
  <div class="dashboard-wrapper">
    <side-bar />
    
    <!-- Enhanced main content with restaurant interface -->
    <div class="main-content p-4">
      <!-- Restaurant Header -->
      <div class="header mb-6">
        <div class="restaurant-info">
          <h1 class="text-3xl font-bold mb-2">Pakecho Restaurant Dashboard</h1>
          <p class="text-gray-400">{{ currentDate }}</p>
        </div>
        <div class="search-bar">
          <input 
            type="text" 
            placeholder="Search menu here..." 
            v-model="searchQuery"
            class="search-input"
          >
          <span class="search-icon">🔍</span>
        </div>
      </div>

      <div class="dashboard-content">
        <!-- Left Section: Menu -->
        <div class="menu-section">
          <!-- Category Tabs -->
          <div class="category-tabs mb-6">
            <div 
              v-for="category in categories" 
              :key="category.name"
              :class="['category-tab', { active: activeCategory === category.name }]"
              @click="activeCategory = category.name"
            >
              <span class="category-icon">{{ category.icon }}</span>
              <span>{{ category.name }}</span>
            </div>
          </div>

          <!-- Menu Items Grid -->
          <div class="menu-grid">
            <div 
              v-for="item in filteredMenuItems" 
              :key="item.id"
              class="menu-item"
              @click="addToOrder(item)"
            >
              <div class="item-image">
                <img :src="item.image" :alt="item.name">
              </div>
              <div class="item-info">
                <h3 class="font-semibold mb-2">{{ item.name }}</h3>
                <div class="item-footer">
                  <span class="price font-bold">${{ item.price.toFixed(2) }}</span>
                  <span class="items-count text-sm text-gray-400">{{ item.items }} Items</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Section: Order Summary -->
        <div class="order-section">
          <div class="order-panel">
            <div class="order-header mb-6">
              <h2 class="text-xl font-bold">Current Order</h2>
              <span class="table-info text-gray-400">Table 31</span>
              <button class="add-on-btn">🔧 Add-On</button>
            </div>

            <div class="order-items mb-6">
              <div v-if="orderItems.length === 0" class="empty-order">
                <p class="text-gray-400 text-center">No items in order yet</p>
              </div>
              <div v-else>
                <div v-for="orderItem in orderItems" :key="orderItem.id" class="order-item">
                  <div class="order-item-image">
                    <img :src="orderItem.image" :alt="orderItem.name">
                  </div>
                  <div class="order-item-details">
                    <h4 class="font-medium">{{ orderItem.name }}</h4>
                    <p class="text-gray-400 text-sm">{{ orderItem.description }}</p>
                    <div class="quantity-price">
                      <div class="quantity-controls">
                        <button @click="decreaseQuantity(orderItem)" class="qty-btn">-</button>
                        <span class="quantity">{{ orderItem.quantity }}</span>
                        <button @click="increaseQuantity(orderItem)" class="qty-btn">+</button>
                      </div>
                      <span class="price font-bold">${{ (orderItem.price * orderItem.quantity).toFixed(2) }}</span>
                    </div>
                  </div>
                  <button @click="removeFromOrder(orderItem.id)" class="remove-btn">×</button>
                </div>
              </div>
            </div>

            <div v-if="orderItems.length > 0" class="order-summary">
              <div class="summary-line">
                <span>Sub Total</span>
                <span>${{ subTotal.toFixed(2) }}</span>
              </div>
              <div class="summary-line">
                <span>Tax (10%)</span>
                <span>${{ tax.toFixed(2) }}</span>
              </div>
              <div class="summary-line total">
                <span class="font-bold">Total</span>
                <span class="font-bold">${{ total.toFixed(2) }}</span>
              </div>
              <button class="print-bill-btn mt-4">🖨️ Process Order</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import SideBar from '@/components/SideBar.vue'

// Reactive data
const activeCategory = ref('Burger')
const searchQuery = ref('')
const currentDate = ref('Augustus 21, 2022')

const categories = [
  { name: 'Burger', icon: '🍔' },
  { name: 'Noodles', icon: '🍜' },
  { name: 'Drinks', icon: '🥤' },
  { name: 'Desserts', icon: '🍰' }
]

const menuItems = ref([
  {
    id: 1,
    name: 'Original Burger',
    price: 5.99,
    items: 11,
    category: 'Burger',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 2,
    name: 'Double Burger',
    price: 10.99,
    items: 13,
    category: 'Burger',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 3,
    name: 'Cheese Burger',
    price: 6.99,
    items: 9,
    category: 'Burger',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 4,
    name: 'Double Cheese Burger',
    price: 12.99,
    items: 8,
    category: 'Burger',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 5,
    name: 'Spicy Burger',
    price: 5.99,
    items: 6,
    category: 'Burger',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 6,
    name: 'Special Black Burger',
    price: 7.99,
    items: 12,
    category: 'Burger',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 7,
    name: 'Chicken Noodles',
    price: 8.50,
    items: 7,
    category: 'Noodles',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 8,
    name: 'Beef Noodles',
    price: 9.99,
    items: 5,
    category: 'Noodles',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 9,
    name: 'Cola',
    price: 2.99,
    items: 20,
    category: 'Drinks',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 10,
    name: 'Orange Juice',
    price: 3.99,
    items: 15,
    category: 'Drinks',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 11,
    name: 'Chocolate Cake',
    price: 4.99,
    items: 8,
    category: 'Desserts',
    image: '/placeholder.svg?height=120&width=120'
  },
  {
    id: 12,
    name: 'Ice Cream',
    price: 3.50,
    items: 12,
    category: 'Desserts',
    image: '/placeholder.svg?height=120&width=120'
  }
])

const orderItems = ref([])

// Computed properties
const filteredMenuItems = computed(() => {
  return menuItems.value.filter(item => {
    const matchesCategory = item.category === activeCategory.value
    const matchesSearch = item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    return matchesCategory && matchesSearch
  })
})

const subTotal = computed(() => {
  return orderItems.value.reduce((sum, item) => sum + (item.price * item.quantity), 0)
})

const tax = computed(() => {
  return subTotal.value * 0.1
})

const total = computed(() => {
  return subTotal.value + tax.value
})

// Methods
const addToOrder = (item) => {
  const existingItem = orderItems.value.find(orderItem => orderItem.id === item.id)
  if (existingItem) {
    existingItem.quantity++
  } else {
    orderItems.value.push({
      id: item.id,
      name: item.name,
      description: '',
      price: item.price,
      quantity: 1,
      image: item.image
    })
  }
}

const removeFromOrder = (itemId) => {
  orderItems.value = orderItems.value.filter(item => item.id !== itemId)
}

const increaseQuantity = (item) => {
  item.quantity++
}

const decreaseQuantity = (item) => {
  if (item.quantity > 1) {
    item.quantity--
  } else {
    removeFromOrder(item.id)
  }
}
</script>

<style scoped>
.dashboard-wrapper {
  display: flex;
  min-height: 100vh;
  background-color: #0f0f0f;
}

.main-content {
  margin-left: 25px;
  flex: 1;
  background-color: #0f0f0f;
  color: white;
  min-height: 100vh;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.restaurant-info h1 {
  background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.search-bar {
  position: relative;
  min-width: 300px;
}

.search-input {
  width: 100%;
  padding: 12px 40px 12px 16px;
  border: 2px solid #2a2a2a;
  border-radius: 25px;
  background-color: #2a2a2a;
  color: white;
  outline: none;
  transition: all 0.3s ease;
}

.search-input:focus {
  border-color: #ff6b6b;
  box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
}

.search-input::placeholder {
  color: #888;
}

.search-icon {
  position: absolute;
  right: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
}

.dashboard-content {
  display: grid;
  grid-template-columns: 1fr 400px;
  gap: 2rem;
  height: calc(100vh - 200px);
}

.menu-section {
  overflow-y: auto;
}

.category-tabs {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.category-tab {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 20px;
  border-radius: 25px;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
  background-color: #2a2a2a;
}

.category-tab:hover {
  background-color: #3a3a3a;
  transform: translateY(-2px);
}

.category-tab.active {
  background-color: #ff6b6b;
  border-color: #ff6b6b;
  box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
}

.category-icon {
  font-size: 18px;
}

.menu-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 1.5rem;
}

.menu-item {
  background-color: #2a2a2a;
  border-radius: 15px;
  padding: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.menu-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
  border-color: #ff6b6b;
}

.item-image {
  width: 100%;
  height: 120px;
  margin-bottom: 1rem;
  border-radius: 10px;
  overflow: hidden;
  background-color: #3a3a3a;
}

.item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.item-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.price {
  color: #ff6b6b;
  font-size: 1.1rem;
}

.order-section {
  background-color: #2a2a2a;
  border-radius: 15px;
  height: fit-content;
  max-height: calc(100vh - 200px);
  overflow-y: auto;
}

.order-panel {
  padding: 1.5rem;
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.add-on-btn {
  background-color: #3a3a3a;
  border: none;
  padding: 8px 12px;
  border-radius: 8px;
  color: white;
  cursor: pointer;
  font-size: 12px;
  transition: all 0.3s ease;
}

.add-on-btn:hover {
  background-color: #4a4a4a;
}

.empty-order {
  padding: 2rem;
  text-align: center;
}

.order-item {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #3a3a3a;
  position: relative;
}

.order-item-image {
  width: 60px;
  height: 60px;
  border-radius: 8px;
  overflow: hidden;
  background-color: #3a3a3a;
  flex-shrink: 0;
}

.order-item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.order-item-details {
  flex: 1;
}

.quantity-price {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 0.5rem;
}

.quantity-controls {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.qty-btn {
  width: 24px;
  height: 24px;
  border: none;
  border-radius: 4px;
  background-color: #ff6b6b;
  color: white;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: bold;
}

.qty-btn:hover {
  background-color: #ff5252;
}

.quantity {
  min-width: 20px;
  text-align: center;
  font-weight: bold;
}

.remove-btn {
  position: absolute;
  top: 0;
  right: 0;
  width: 20px;
  height: 20px;
  border: none;
  border-radius: 50%;
  background-color: #ff4444;
  color: white;
  cursor: pointer;
  font-size: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.remove-btn:hover {
  background-color: #ff2222;
}

.order-summary {
  border-top: 1px solid #3a3a3a;
  padding-top: 1rem;
}

.summary-line {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
}

.summary-line.total {
  font-size: 1.1rem;
  border-top: 1px solid #3a3a3a;
  padding-top: 0.5rem;
  margin-top: 0.5rem;
}

.print-bill-btn {
  width: 100%;
  background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
  border: none;
  padding: 1rem;
  border-radius: 12px;
  color: white;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

.print-bill-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
}

/* Responsive Design */
@media (max-width: 1200px) {
  .dashboard-content {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .order-section {
    max-height: 400px;
  }
}

@media (max-width: 768px) {
  .main-content {
    margin-left: 0;
    padding: 1rem;
  }
  
  .header {
    flex-direction: column;
    align-items: stretch;
  }
  
  .search-bar {
    min-width: auto;
  }
  
  .menu-grid {
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 1rem;
  }
}
</style>