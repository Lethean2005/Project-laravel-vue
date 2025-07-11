<template>
  <div class="min-h-screen bg-gray-900 text-white p-6">
    <div class="max-w-6xl mx-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-orange-400 uppercase tracking-wide">Menu List</h2>
        <router-link
          to="/menu/add"
          class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center gap-2 transition-colors"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          + Add Menu
        </router-link>
      </div>

      <!-- Menu List -->
      <ul class="space-y-6">
        <li
          v-for="menu in menus"
          :key="menu.id"
          class="bg-gray-800 border border-gray-700 rounded-lg p-6 hover:bg-gray-750 transition-all duration-300 relative"
        >
          <!-- Left: Image + Info -->
          <div class="flex gap-6 items-center">
            <div class="relative">
              <img
                v-if="menu.image"
                :src="menu.image"
                alt="Menu Image"
                class="w-28 h-28 object-cover rounded-full border-4 border-orange-400/20 shadow-lg"
              />
              <div v-else class="w-28 h-28 bg-gray-700 rounded-full border-4 border-orange-400/20 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              
              <!-- Decorative coffee beans -->
              <div class="absolute -top-2 -right-2 w-3 h-5 bg-amber-700 rounded-full transform rotate-12 opacity-60"></div>
              <div class="absolute -bottom-1 -left-1 w-4 h-6 bg-amber-600 rounded-full transform -rotate-12 opacity-40"></div>
              <div class="absolute top-1/2 -right-4 w-2 h-3 bg-orange-500 rounded-full opacity-50"></div>
            </div>

            <div class="flex-1">
              <h3 class="text-2xl font-bold text-white mb-2 uppercase tracking-wide">{{ menu.name }}</h3>
              <p class="text-gray-300 mb-3 leading-relaxed">
                {{ menu.description || 'No description' }}
              </p>
              
              <!-- Size options (if available) -->
              <div v-if="menu.sizes && menu.sizes.length > 0" class="flex gap-2 mb-3">
                <div
                  v-for="(size, index) in menu.sizes"
                  :key="index"
                  class="bg-gray-700 border border-orange-400/30 px-3 py-1 rounded-full text-sm font-bold"
                >
                  <span class="text-orange-400">{{ size.size }}</span>
                  <span class="text-white ml-1">{{ size.price }}₽</span>
                </div>
              </div>
              
              <p class="text-orange-400 font-bold text-xl">
                Price: ${{ parseFloat(menu.price).toFixed(2) }}
              </p>
            </div>
          </div>

          <!-- Right: Three Dot Dropdown -->
          <div class="absolute top-6 right-6">
            <button
              @click="toggleDropdown(menu.id)"
              class="text-gray-400 hover:text-white hover:bg-gray-700 p-2 rounded transition-colors"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
              </svg>
            </button>
            
            <div
              v-if="openDropdown === menu.id"
              class="absolute right-0 mt-2 w-36 bg-gray-800 border border-gray-700 rounded-lg shadow-xl z-10"
            >
              <button
                @click="editMenu(menu.id)"
                class="block w-full text-left px-4 py-3 hover:bg-gray-700 text-white flex items-center gap-2 rounded-t-lg transition-colors"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                ✏️ Edit
              </button>
              <button
                @click="deleteMenu(menu.id)"
                class="block w-full text-left px-4 py-3 hover:bg-gray-700 text-red-400 flex items-center gap-2 rounded-b-lg transition-colors"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                🗑️ Delete
              </button>
            </div>
          </div>
        </li>
      </ul>

      <!-- Empty State -->
      <div v-if="menus.length === 0" class="text-center py-16">
        <div class="text-gray-400 text-xl mb-4">No menus found.</div>
        <router-link
          to="/menu/add"
          class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Add Your First Menu
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const menus = ref([])
const openDropdown = ref(null)

const fetchMenus = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/menus')
    menus.value = response.data.data || response.data
  } catch (error) {
    console.error('Failed to fetch menus:', error)
  }
}

const toggleDropdown = (id) => {
  openDropdown.value = openDropdown.value === id ? null : id
}

const editMenu = (id) => {
  openDropdown.value = null
  router.push(`/menu/edit/${id}`)
}

const deleteMenu = async (id) => {
  if (confirm('Are you sure you want to delete this menu?')) {
    try {
      await axios.delete(`http://localhost:8000/api/menus/${id}`)
      await fetchMenus()
      openDropdown.value = null
    } catch (error) {
      console.error('Failed to delete menu:', error)
    }
  }
}

// Close dropdown when clicking outside
const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    openDropdown.value = null
  }
}

onMounted(() => {
  fetchMenus()
  document.addEventListener('click', handleClickOutside)
})
</script>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #374151;
}

::-webkit-scrollbar-thumb {
  background: #fb923c;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #f97316;
}

/* Smooth transitions */
.transition-all {
  transition: all 0.3s ease;
}

.transition-colors {
  transition: color 0.2s ease, background-color 0.2s ease;
}
</style>
