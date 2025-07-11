<template>
  <div class="categoryadd-container">
    <h2 class="categoryadd-title">Add New Category</h2>

    <!-- Category Name -->
    <input
      v-model="name"
      placeholder="Category Name"
      class="categoryadd-input"
      :disabled="loading"
    />
    <div v-if="nameError" style="color: red; font-size: 0.95rem;">{{ nameError }}</div>

    <!-- Image Upload -->
    <input
      type="file"
      @change="onFileChange"
      accept="image/*"
      class="categoryadd-input"
      :disabled="loading"
    />

    <div v-if="submitError" style="color: red; font-size: 0.95rem;">{{ submitError }}</div>

    <button @click="onSubmit" class="categoryadd-btn" :disabled="loading">
      {{ loading ? 'Saving...' : 'Save' }}
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import api from '@/api'

// Validation schema
const schema = yup.object({
  name: yup.string().required('Category name is required').min(2, 'Too short'),
})

const { handleSubmit } = useForm({ validationSchema: schema })
const { value: name, errorMessage: nameError } = useField('name')

// States
const loading = ref(false)
const submitError = ref('')
const image = ref(null)
const router = useRouter()

const onFileChange = (event) => {
  const file = event.target.files[0]
  if (file && file.type.startsWith('image/')) {
    image.value = file
  } else {
    image.value = null
    alert('Please upload a valid image file')
  }
}

const onSubmit = handleSubmit(async (values) => {
  loading.value = true
  submitError.value = ''

  try {
    const formData = new FormData()
    formData.append('name', values.name)
    if (image.value) {
      formData.append('image', image.value)
    }

    const response = await api.post('/categories', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    })

    console.log('API response:', response)
    router.push('/categories')
  } catch (error) {
    console.error('Failed to create category:', error)
    if (error?.response?.status === 401) {
      router.push('/login')
    } else {
      submitError.value = error?.response?.data?.message || 'Failed to create category'
    }
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
/* Keep your styles the same */
.categoryadd-container {
  padding: 2.5rem 2rem;
  max-width: 1000px;
  margin: 3rem auto;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 2rem;
  box-shadow: 0 8px 32px 0 rgba(31, 41, 55, 0.12);
  backdrop-filter: blur(10px);
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}
.categoryadd-title {
  font-size: 2rem;
  font-weight: 700;
  color: #2563eb;
  letter-spacing: 1px;
  text-shadow: 0 2px 8px #dbeafe;
  margin-bottom: 1.5rem;
  text-align: center;
}
.categoryadd-input {
  width: 100%;
  padding: 1rem 1.2rem;
  border-radius: 1.2rem;
  border: 1.5px solid rgba(59, 130, 246, 0.13);
  background: rgba(255, 255, 255, 0.7);
  font-size: 1.1rem;
  color: #1e293b;
  box-shadow: 0 2px 8px 0 rgba(59, 130, 246, 0.06);
  transition: border 0.2s, box-shadow 0.2s;
  outline: none;
  margin-bottom: 0;
}
.categoryadd-input:focus {
  border: 1.5px solid #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.13);
  background: rgba(255, 255, 255, 0.95);
}
.categoryadd-btn {
  background: linear-gradient(90deg, #2563eb 0%, #38bdf8 100%);
  color: #fff;
  font-weight: 600;
  font-size: 1.1rem;
  padding: 0.8rem 0;
  border: none;
  border-radius: 1.2rem;
  box-shadow: 0 2px 10px 0 rgba(59, 130, 246, 0.1);
  cursor: pointer;
  transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
  margin-top: 0.5rem;
}
.categoryadd-btn:hover {
  background: linear-gradient(90deg, #1d4ed8 0%, #0ea5e9 100%);
  transform: translateY(-2px) scale(1.03);
  box-shadow: 0 4px 18px 0 rgba(59, 130, 246, 0.18);
}
</style>
