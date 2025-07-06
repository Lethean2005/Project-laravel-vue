<template>
  <form @submit.prevent="submitForm" class="product-form" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name</label>
      <input
        id="name"
        v-model="form.name"
        type="text"
        required
        placeholder="Product name"
      />
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input
        id="price"
        v-model.number="form.price"
        type="number"
        step="0.01"
        min="0"
        required
        placeholder="Product price"
      />
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea
        id="description"
        v-model="form.description"
        placeholder="Product description"
        rows="3"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="category">Category</label>
      <select id="category" v-model="form.category_id" required>
        <option disabled value="">Select category</option>
        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
          {{ cat.name }}
        </option>
      </select>
    </div>

    <div class="form-group">
      <label for="image">Product Image</label>
      <input type="file" id="image" @change="handleImageUpload" accept="image/*" />
    </div>

    <button type="submit">Save Product</button>
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const form = ref({
  name: '',
  price: null,
  description: '',
  category_id: ''
})

const imageFile = ref(null)
const categories = ref([])

const fetchCategories = async () => {
  try {
    const res = await axios.get('http://127.0.0.1:8000/api/categories')
    categories.value = res.data
  } catch (e) {
    console.error('Failed to load categories', e)
  }
}

const handleImageUpload = (event) => {
  imageFile.value = event.target.files[0]
}

const submitForm = async () => {
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('price', form.value.price)
    formData.append('description', form.value.description)
    formData.append('category_id', form.value.category_id)

    if (imageFile.value) {
      formData.append('image', imageFile.value)
    }

    await axios.post('http://127.0.0.1:8000/api/products', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    })

    alert('Product saved successfully!')

    // Reset form
    form.value = {
      name: '',
      price: null,
      description: '',
      category_id: ''
    }
    imageFile.value = null
  } catch (error) {
    console.error('Failed to save product', error)
    alert('Something went wrong while saving.')
  }
}

onMounted(fetchCategories)
</script>

<style scoped>
.product-form {
  max-width: 400px;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  background-color: #fff;
  padding: 1.5rem;
  border-radius: 0.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.form-group {
  display: flex;
  flex-direction: column;
}

label {
  font-weight: 600;
  margin-bottom: 0.25rem;
}

input,
textarea,
select {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 0.375rem;
  font-size: 1rem;
}

button {
  padding: 0.75rem;
  background-color: #3b82f6;
  color: white;
  font-weight: 600;
  border: none;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

button:hover {
  background-color: #2563eb;
}
</style>
