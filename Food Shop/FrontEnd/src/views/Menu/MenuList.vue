<template>
  <div class="p-4">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold">Menu List</h2>
      <!-- <router-link
        to="/menu/add"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
      >
        + Add Menu
      </router-link> -->
    </div>

    <!-- Three-column responsive grid layout -->
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <li
        v-for="menu in menus"
        :key="menu.id"
        class="mb-6 flex justify-between items-center border-b pb-4 relative"
      >
        <!-- Left: Image + Info -->
        <div class="flex gap-4 items-center">
          <img
            v-if="menu.image"
            :src="menu.image"
            alt="Menu Image"
            class="w-24 h-24 object-cover rounded"
          />
          <div>
            <h3 class="text-lg font-semibold">{{ menu.name }}</h3>
            <p class="text-gray-600 mb-1">
              {{ menu.description || 'No description' }}
            </p>
            <p class="text-orange-600 font-bold">
              Price: ${{ parseFloat(menu.price).toFixed(2) }}
            </p>
          </div>
        </div>

        <!-- Right: Three Dot Dropdown -->
        <!-- <div class="relative">
          <button
            @click="toggleDropdown(menu.id)"
            class="text-gray-600 hover:text-gray-800 focus:outline-none"
          >
            ⋮
          </button>

          <div
            v-if="openDropdown === menu.id"
            class="absolute right-0 mt-2 w-32 bg-white border rounded shadow-md z-10"
          >
            <button
              @click="editMenu(menu.id)"
              class="block w-full text-left px-4 py-2 hover:bg-gray-100"
            >
              ✏️ Edit
            </button>
            <button
              @click="deleteMenu(menu.id)"
              class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600"
            >
              🗑️ Delete
            </button>
          </div>
        </div> -->
      </li>
    </ul>

    <div v-if="menus.length === 0" class="text-gray-500">
      No menus found.
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
  router.push(`/menu/edit/${id}`)
}

const deleteMenu = async (id) => {
  if (confirm('Are you sure you want to delete this menu?')) {
    try {
      await axios.delete(`http://localhost:8000/api/menus/${id}`)
      await fetchMenus()
    } catch (error) {
      console.error('Failed to delete menu:', error)
    }
  }
}

onMounted(fetchMenus)
</script>
