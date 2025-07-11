<template>
  <div class="flex h-screen overflow-hidden">
    <!-- Desktop Sidebar -->
    <aside
      class="fixed inset-y-0 left-0 w-64 bg-white/90 backdrop-blur-xl border-r border-gray-100/50
             flex flex-col justify-between px-6 py-8 z-50 shadow-[4px_0_20px_rgba(0,0,0,0.05)]"
    >
      <!-- Logo + Nav Links -->
      <div class="flex flex-col gap-10">
        <!-- ‣ Brand ------------------------------------------------------------ -->
        <h1
          class="text-3xl font-bold tracking-tight bg-gradient-to-r from-violet-600 to-indigo-500
                 bg-clip-text text-transparent select-none"
        >
          Foodie&nbsp;
        </h1>
        <!-- ‣ Primary nav ------------------------------------------------------- -->
        <nav class="flex flex-col gap-3">
          <router-link
            to="/dashboard"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Dashboard
          </router-link>
          <router-link
            to="/"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Home
          </router-link>
          <router-link
            to="/about"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            About
          </router-link>
          <!-- <router-link
            to="/posts"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Posts
          </router-link> -->
          <router-link
            to="/categories"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Category
          </router-link>
          <router-link
            to="/products"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Products
          </router-link>
          <router-link
            to="/menu"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Menu
          </router-link>
          <router-link
            to="/orders"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Order
          </router-link>
          <router-link
            to="/contact"
            class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                   hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
            active-class="sidebar-active"
          >
            Contact
          </router-link>
        </nav>
      </div>
      <!-- User Dropdown -->
      <div class="relative">
        <button
          @click="toggleDropdown"
          class="flex items-center gap-2 w-full justify-between text-violet-600 font-medium
                 px-3 py-2 rounded-lg hover:bg-violet-50/50 transition-all duration-200 ease-out
                 focus:outline-none focus:ring-2 focus:ring-violet-300"
        >
          Admin
          <svg
            class="w-4 h-4 transform transition-transform duration-200"
            :class="{ 'rotate-180': isDropdownOpen }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 9l-7 7-7-7"
            />
          </svg>
        </button>
        <div
          v-if="isDropdownOpen"
          class="absolute left-0 bottom-12 w-full bg-white/95 backdrop-blur-md
                 border border-gray-100/50 rounded-lg shadow-[0_10px_20px_rgba(0,0,0,0.1)] z-50
                 overflow-hidden"
        >
          <router-link
            to="/login"
            class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600
                   transition-all duration-150 ease-out"
            @click="closeDropdown"
          >
            Login
          </router-link>
          <router-link
            to="/register"
            class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600
                   transition-all duration-150 ease-out"
            @click="closeDropdown"
          >
            Register
          </router-link>
          <button
            @click="logout"
            class="block w-full text-left px-4 py-3 text-red-500 hover:bg-red-50/50
                   hover:text-red-600 transition-all duration-150 ease-out"
          >
            Logout
          </button>
        </div>
      </div>
    </aside>

    <!-- Mobile Header (only visible on mobile) -->
    <div class="md:hidden bg-white shadow-sm p-4 flex items-center justify-between sticky top-0 z-20 w-full">
      <button 
        @click="toggleMobileSidebar"
        class="text-gray-600 hover:text-violet-600"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
      <h1 class="text-lg font-bold bg-gradient-to-r from-violet-600 to-indigo-500 bg-clip-text text-transparent">SHV SHOP</h1>
      <div class="w-6"></div> <!-- Spacer for centering -->
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div 
      v-if="isMobileSidebarOpen"
      class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-30"
      @click="toggleMobileSidebar"
    ></div>

    <!-- Mobile Sidebar -->
    <aside 
      v-if="isMobileSidebarOpen"
      class="md:hidden fixed inset-y-0 left-0 w-64 bg-white/90 backdrop-blur-xl border-r border-gray-100/50
             flex flex-col justify-between px-6 py-8 z-40 shadow-[4px_0_20px_rgba(0,0,0,0.05)]"
    >
      <!-- Logo with close button -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold tracking-tight bg-gradient-to-r from-violet-600 to-indigo-500 bg-clip-text text-transparent select-none">
          SHV&nbsp;SHOP
        </h1>
        <button @click="toggleMobileSidebar" class="text-gray-600 hover:text-violet-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="flex flex-col gap-3 flex-1">
        <router-link
          to="/"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          Home
        </router-link>
        <router-link
          to="/about"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          About
        </router-link>
        <router-link
          to="/posts"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          Posts
        </router-link>
        <router-link
          to="/categories"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          Category
        </router-link>
        <router-link
          to="/products"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          Products
        </router-link>
        <router-link
          to="/menu"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          Menu
        </router-link>
        <router-link
          to="/contect"
          class="group relative px-3 py-2 rounded-lg font-medium text-gray-800
                 hover:text-violet-600 hover:bg-violet-50/50 transition-all duration-200 ease-out"
          active-class="sidebar-active"
          @click="closeMobileSidebar"
        >
          Contact
        </router-link>
      </nav>
      
      <!-- User Section -->
      <div class="relative mt-4">
        <button
          @click="toggleMobileDropdown"
          class="flex items-center gap-2 w-full justify-between text-violet-600 font-medium
                 px-3 py-2 rounded-lg hover:bg-violet-50/50 transition-all duration-200 ease-out
                 focus:outline-none focus:ring-2 focus:ring-violet-300"
        >
          User
          <svg
            class="w-4 h-4 transform transition-transform duration-200"
            :class="{ 'rotate-180': isMobileDropdownOpen }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 9l-7 7-7-7"
            />
          </svg>
        </button>
        <div
          v-if="isMobileDropdownOpen"
          class="absolute left-0 bottom-12 w-full bg-white/95 backdrop-blur-md
                 border border-gray-100/50 rounded-lg shadow-[0_10px_20px_rgba(0,0,0,0.1)] z-50
                 overflow-hidden"
        >
          <router-link
            to="/login"
            class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600
                   transition-all duration-150 ease-out"
            @click="closeMobileSidebar"
          >
            Login
          </router-link>
          <router-link
            to="/register"
            class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600
                   transition-all duration-150 ease-out"
            @click="closeMobileSidebar"
          >
            Register
          </router-link>
          <router-link
            to="/dashboard"
            class="block px-4 py-3 text-gray-800 hover:bg-violet-50/50 hover:text-violet-600
                   transition-all duration-150 ease-out"
            @click="closeMobileSidebar"
          >
            Dashboard
          </router-link>
          <button
            @click="logoutMobile"
            class="block w-full text-left px-4 py-3 text-red-500 hover:bg-red-50/50
                   hover:text-red-600 transition-all duration-150 ease-out"
          >
            Logout
          </button>
        </div>
      </div>
    </aside>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isDropdownOpen = ref(false)
const isMobileSidebarOpen = ref(false)
const isMobileDropdownOpen = ref(false)

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value
}

const closeDropdown = () => {
  isDropdownOpen.value = false
}

const logout = async () => {
  try {
    console.log('Logging out...')
  } catch (err) {
    console.warn('Logout request failed or already logged out')
  }
  router.push('/login')
  closeDropdown()
}

const toggleMobileSidebar = () => {
  isMobileSidebarOpen.value = !isMobileSidebarOpen.value
  if (!isMobileSidebarOpen.value) {
    isMobileDropdownOpen.value = false
  }
}

const closeMobileSidebar = () => {
  isMobileSidebarOpen.value = false
  isMobileDropdownOpen.value = false
}

const toggleMobileDropdown = () => {
  isMobileDropdownOpen.value = !isMobileDropdownOpen.value
}

const logoutMobile = async () => {
  await logout()
}
</script>

<style scoped>
.sidebar-active {
  @apply text-violet-600 font-semibold bg-violet-50/50 border-l-4 border-violet-600;
}

@media (max-width: 768px) {
  aside:not(.md\:hidden) {
    display: none;
  }
}
</style>