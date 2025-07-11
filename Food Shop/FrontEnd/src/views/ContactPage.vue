<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="container mx-auto px-4 py-16 max-w-7xl">
      <!-- Page Heading -->
      <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-4">Get In Touch</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Have questions or need help? We're here to assist you with all your needs.
        </p>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
        <!-- Contact Information Card -->
        <div class="lg:col-span-1">
          <div class="bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-xl shadow-xl p-8">
            <div class="mb-6">
              <h2 class="text-2xl font-bold text-white mb-3">Contact Information</h2>
              <p class="text-teal-100">
                We'll create high-quality linkable content and build at least 40 high-authority links to each asset.
              </p>
            </div>
            
            <div class="space-y-8">
              <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-teal-100 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <div>
                  <p class="font-semibold text-white">+855 88 123 4567</p>
                  <p class="text-teal-100">+8801797176686</p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-teal-100 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <div>
                  <p class="font-semibold text-white">support@shvshop.com</p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-teal-100 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <div>
                  <p class="font-semibold text-white">123 SHV Street</p>
                  <p class="text-teal-100">Sihanoukville, Cambodia</p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-teal-100 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                  <p class="font-semibold text-white">Working Hours</p>
                  <p class="text-teal-100">Monday – Saturday: 9:00 AM – 6:00 PM</p>
                  <p class="text-teal-100">Sunday: Closed</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-xl shadow-xl p-8">
            <div class="mb-8">
              <h2 class="text-3xl font-bold text-gray-900 mb-3">Send Us a Message</h2>
              <p class="text-gray-600">Fill out the form below and we'll get back to you as soon as possible.</p>
            </div>
            
            <form @submit.prevent="submitForm" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label for="name" class="text-sm font-medium text-gray-700">Your Name</label>
                  <input
                    id="name"
                    v-model="name"
                    type="text"
                    placeholder="John Trangely"
                    class="form-input h-12"
                    required
                  />
                </div>
                <div class="space-y-2">
                  <label for="email" class="text-sm font-medium text-gray-700">Your Email</label>
                  <input
                    id="email"
                    v-model="email"
                    type="email"
                    placeholder="hello@nurency.com"
                    class="form-input h-12"
                    required
                  />
                </div>
              </div>

              <div class="space-y-2">
                <label for="subject" class="text-sm font-medium text-gray-700">Your Subject</label>
                <input
                  id="subject"
                  v-model="subject"
                  type="text"
                  placeholder="I want to hire you quickly"
                  class="form-input h-12"
                />
              </div>

              <div class="space-y-2">
                <label for="message" class="text-sm font-medium text-gray-700">Message</label>
                <textarea
                  id="message"
                  v-model="message"
                  rows="6"
                  placeholder="Write here your message"
                  class="form-input resize-none"
                  required
                ></textarea>
              </div>

              <button
                type="submit"
                :disabled="loading"
                class="bg-teal-600 hover:bg-teal-700 disabled:opacity-50 text-white px-8 py-3 h-12 text-lg font-semibold rounded-lg transition-colors duration-200 flex items-center justify-center"
              >
                <div v-if="loading" class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                {{ loading ? 'Sending...' : 'Send Message' }}
              </button>

              <p v-if="successMessage" class="text-green-600 font-medium">{{ successMessage }}</p>
              <p v-if="errorMessage" class="text-red-600 font-medium">{{ errorMessage }}</p>
            </form>
          </div>
        </div>
      </div>

      <!-- Map and Locations -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
          <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <iframe
              class="w-full h-96"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3893.244850748195!2d103.54520831516918!3d10.579084462660455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3107f1aa7dd6a4a9%3A0xdba514d89b60d7f7!2sOtres%20Beach!5e0!3m2!1sen!2skh!4v1720570000000!5m2!1sen!2skh"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>

        <div>
          <div class="bg-white rounded-xl shadow-xl p-8">
            <div class="mb-6">
              <h3 class="text-2xl font-bold text-gray-900 mb-3">Our Locations</h3>
              <p class="text-gray-600">Find us in Preah Sihanouk</p>
            </div>
            
            <ul class="space-y-4">
              <li class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-700">Sihanoukville City Center</span>
              </li>
              <li class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-700">Otres Beach</span>
              </li>
              <li class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-700">Ream National Park</span>
              </li>
              <li class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-700">Sihanoukville Port</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const name = ref('')
const email = ref('')
const subject = ref('')
const message = ref('')
const loading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const submitForm = async () => {
  loading.value = true
  successMessage.value = ''
  errorMessage.value = ''
  
  try {
    const res = await fetch('http://localhost:8000/api/contacts', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        name: name.value,
        email: email.value,
        subject: subject.value,
        message: message.value
      })
    })
    
    if (!res.ok) throw new Error('Server error')
    const data = await res.json()
    successMessage.value = '✅ Message sent successfully!'
    name.value = ''
    email.value = ''
    subject.value = ''
    message.value = ''
  } catch (err) {
    errorMessage.value = '❌ Failed to send message. Please try again.'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.form-input {
  @apply w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors duration-200;
}

.container {
  @apply max-w-7xl mx-auto px-4;
}
</style>