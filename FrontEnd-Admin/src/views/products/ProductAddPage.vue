<template>
  <div class="min-h-screen bg-gradient-to-br from-teal-400 to-cyan-500 p-6 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-2xl w-full">
      <!-- Header -->
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Add New Product</h2>
        <button class="text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Tabs -->
      <div class="flex border-b border-gray-200 mb-6">
        <button class="px-4 py-2 text-teal-600 border-b-2 border-teal-600 font-medium">
          Options
        </button>
        <button class="px-4 py-2 text-gray-500 hover:text-gray-700 transition-colors">
          Documents
        </button>
        <button class="px-4 py-2 text-gray-500 hover:text-gray-700 transition-colors">
          Advanced
        </button>
      </div>

      <form @submit.prevent="createProduct" class="space-y-6">
        <!-- Product Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
          <input 
            v-model="name" 
            placeholder="Enter product name" 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 outline-none"
            required
          />
        </div>

        <!-- Category and Priority Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Category Dropdown -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <select 
              v-model="categoryId" 
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 outline-none bg-white"
              required
            >
              <option disabled value="">Select a Category</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>

          <!-- Price -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
            <input 
              v-model.number="price" 
              type="number" 
              step="0.01" 
              placeholder="0.00" 
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 outline-none"
              required
            />
          </div>
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
          <textarea 
            v-model="description" 
            placeholder="Enter product description" 
            rows="4"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 outline-none resize-none"
          ></textarea>
        </div>

        <!-- Image Upload -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
          <div 
            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-teal-400 transition-colors duration-200"
            @dragover.prevent
            @drop.prevent="handleDrop"
          >
            <div v-if="!image && !imagePreview" class="space-y-4">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div>
                <p class="text-gray-600 font-medium">Drag files for upload</p>
                <p class="text-gray-400 text-sm mt-1">or browse</p>
              </div>
              <input 
                type="file" 
                @change="handleFileChange" 
                class="hidden" 
                ref="fileInput"
                accept="image/*"
              />
              <button 
                type="button"
                @click="$refs.fileInput.click()"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors"
              >
                Browse Files
              </button>
            </div>
            
            <!-- Image Preview -->
            <div v-else class="space-y-4">
              <img 
                :src="imagePreview" 
                alt="Preview" 
                class="mx-auto h-32 w-32 object-cover rounded-lg border-2 border-gray-200"
              />
              <div>
                <p class="text-gray-700 font-medium">{{ image?.name }}</p>
                <button 
                  type="button"
                  @click="removeImage"
                  class="text-red-500 hover:text-red-700 text-sm mt-2 transition-colors"
                >
                  Remove Image
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
          <button 
            type="button"
            @click="$router.push('/products')"
            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors"
          >
            Cancel
          </button>
          <button 
            type="submit"
            :disabled="isSubmitting"
            class="px-6 py-3 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center space-x-2"
          >
            <svg v-if="isSubmitting" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>{{ isSubmitting ? 'Saving...' : 'Save Product' }}</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api'

// Fields
const name = ref('')
const description = ref('')
const price = ref(0)
const image = ref(null)
const imagePreview = ref(null)
const categoryId = ref('')
const categories = ref([])
const isSubmitting = ref(false)
const router = useRouter()

// Load all categories on form load
const fetchCategories = async () => {
  try {
    const res = await api.get('/categories')
    categories.value = res.data.data || res.data // supports both {data:[]} or []
  } catch (error) {
    console.error('Failed to fetch categories:', error)
  }
}

const handleFileChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    image.value = file
    const reader = new FileReader()
    reader.onload = (e) => {
      imagePreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const handleDrop = (event) => {
  const files = event.dataTransfer.files
  if (files.length > 0) {
    const file = files[0]
    if (file.type.startsWith('image/')) {
      image.value = file
      const reader = new FileReader()
      reader.onload = (e) => {
        imagePreview.value = e.target.result
      }
      reader.readAsDataURL(file)
    }
  }
}

const removeImage = () => {
  image.value = null
  imagePreview.value = null
}

const createProduct = async () => {
  if (!name.value || !categoryId.value) {
    alert('Please enter product name and select a valid category.')
    return
  }

  isSubmitting.value = true

  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('description', description.value)
  formData.append('price', price.value)
  formData.append('category_id', Number(categoryId.value))
  if (image.value) {
    formData.append('image', image.value)
  }

  try {
    await api.post('/products', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    })
    router.push('/products')
  } catch (error) {
    console.error(error)
    if (error.response?.data) {
      alert('Error: ' + JSON.stringify(error.response.data))
    } else {
      alert('An unexpected error occurred.')
    }
  } finally {
    isSubmitting.value = false
  }
}

onMounted(() => {
  fetchCategories()
})
</script>

<style scoped>
/* Custom focus styles */
input:focus, select:focus, textarea:focus {
  box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
}

/* Smooth transitions */
* {
  transition: all 0.2s ease;
}

/* Loading animation */
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.animate-spin {
  animation: spin 1s linear infinite;
}
</style>
