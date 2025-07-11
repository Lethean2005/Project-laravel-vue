<template>
  <div class="min-h-screen bg-gray-900 text-white">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
          <h1 class="text-5xl lg:text-6xl font-bold mb-6">
            About<br />
            <span class="text-orange-500">Foodie</span>
          </h1>
          <p class="text-gray-300 text-lg mb-8 max-w-md">
            Discover the story behind Cambodia's premier food delivery service. We're passionate about bringing
            authentic flavors and exceptional dining experiences directly to your doorstep.
          </p>
          <button class="bg-orange-500 hover:bg-orange-600 text-black font-semibold px-8 py-3 rounded-lg transition-colors">
            Learn More
          </button>
        </div>
        <div class="relative">
          <img
            src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400&h=400&fit=crop&crop=center"
            alt="SHV SHOP Team"
            class="rounded-2xl w-[400px] h-[400px] object-cover shadow-2xl"
          />
          <div class="absolute top-4 right-4 bg-white text-black p-4 rounded-2xl shadow-lg">
            <div class="text-sm font-semibold">Trusted by thousands</div>
            <div class="flex items-center mt-2">
              <div class="flex text-orange-500">
                <StarIcon v-for="n in 5" :key="n" class="w-4 h-4 fill-current" />
              </div>
              <span class="ml-2 text-sm font-bold">4.9/5 Rating</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-xl">
        <div class="p-8 grid lg:grid-cols-2 gap-8 items-center">
          <div>
            <h2 class="text-4xl font-bold mb-6">
              Our <span class="text-orange-500">Mission</span>
            </h2>
            <p class="text-gray-300 text-lg leading-relaxed mb-6">
              Our mission is to bring the world's finest flavors directly to your doorstep. We partner with the best
              local restaurants and chefs to deliver exceptional dining experiences that satisfy your cravings and
              exceed your expectations.
            </p>
            <p class="text-gray-300 leading-relaxed">
              Every meal is prepared with love and delivered with care, ensuring that quality and freshness are never
              compromised.
            </p>
          </div>
          <div class="relative">
            <img
              src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=300&h=300&fit=crop&crop=center"
              alt="Our Mission"
              class="rounded-xl w-[300px] h-[300px] object-cover shadow-lg"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Story Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-xl">
        <div class="p-8 grid lg:grid-cols-2 gap-8 items-center">
          <div class="order-2 lg:order-1">
            <img
              src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=300&h=300&fit=crop&crop=center"
              alt="Our Story"
              class="rounded-xl w-[300px] h-[300px] object-cover shadow-lg"
            />
          </div>
          <div class="order-1 lg:order-2">
            <h2 class="text-4xl font-bold mb-6">
              Our <span class="text-orange-500">Story</span>
            </h2>
            <p class="text-gray-300 text-lg leading-relaxed mb-6">
              Founded with a simple belief that great food brings people together, Foodie started as a small local
              delivery service in Phnom Penh, Cambodia.
            </p>
            <p class="text-gray-300 leading-relaxed mb-6">
              Today, we've grown into a trusted platform connecting food lovers with their favorite restaurants. Our
              journey is driven by passion, quality, and the joy of sharing amazing meals.
            </p>
            <div class="flex space-x-6 text-orange-500 font-semibold">
              <span>Est. 2020</span>
              <span>10,000+ Orders</span>
              <span>50+ Restaurants</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">
          Meet Our <span class="text-orange-500">Team</span>
        </h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto">
          We are a diverse team of food enthusiasts, tech innovators, and customer service experts based in Cambodia.
        </p>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div
          v-for="(member, index) in teamMembers"
          :key="index"
          class="bg-gray-800 border border-gray-700 hover:bg-gray-700 transition-colors text-center p-6 rounded-xl shadow-lg"
        >
          <div class="text-6xl mb-4">{{ member.icon }}</div>
          <h3 class="text-xl font-bold text-white mb-2">{{ member.name }}</h3>
          <p class="text-orange-500 font-semibold mb-3">{{ member.role }}</p>
          <p class="text-gray-300 text-sm">{{ member.description }}</p>
        </div>
      </div>
    </section>

    <!-- Why Choose Us -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-3xl p-8 shadow-2xl">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold mb-4 text-white">
            Why Choose <span class="text-black">Foodie?</span>
          </h2>
          <p class="text-white/90 text-lg max-w-2xl mx-auto">
            We're committed to delivering excellence in every aspect of our service
          </p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div
            v-for="(value, index) in values"
            :key="index"
            class="text-center text-white"
          >
            <div class="bg-white/20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <component :is="value.icon" class="w-6 h-6" />
            </div>
            <h3 class="font-bold text-lg mb-2">{{ value.title }}</h3>
            <p class="text-white/90 text-sm">{{ value.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">
          Our <span class="text-orange-500">Values</span>
        </h2>
      </div>
      <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
          <h3 class="text-xl font-bold text-orange-500 mb-4 flex items-center gap-2">
            <span>🌟</span>
            Quality & Freshness
          </h3>
          <p class="text-gray-300 leading-relaxed">
            We partner only with restaurants that share our commitment to using fresh, high-quality ingredients and
            maintaining the highest food safety standards.
          </p>
        </div>
        <div class="bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
          <h3 class="text-xl font-bold text-orange-500 mb-4 flex items-center gap-2">
            <span>🤝</span>
            Customer Satisfaction
          </h3>
          <p class="text-gray-300 leading-relaxed">
            Your satisfaction is our priority. We continuously improve our service based on customer feedback and strive to exceed expectations every time.
          </p>
        </div>
        <div class="bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
          <h3 class="text-xl font-bold text-orange-500 mb-4 flex items-center gap-2">
            <span>💝</span>
            Community Support
          </h3>
          <p class="text-gray-300 leading-relaxed">
            We believe in supporting local businesses and communities. By partnering with local restaurants, we help strengthen Cambodia's culinary ecosystem.
          </p>
        </div>
        <div class="bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
          <h3 class="text-xl font-bold text-orange-500 mb-4 flex items-center gap-2">
            <span>🚀</span>
            Innovation & Growth
          </h3>
          <p class="text-gray-300 leading-relaxed">
            We continuously innovate our technology and services to provide the best possible experience while growing sustainably and responsibly.
          </p>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="bg-gray-800 border border-gray-700 p-8 rounded-xl text-center shadow-xl">
        <h2 class="text-4xl font-bold mb-4">
          Get in <span class="text-orange-500">Touch</span>
        </h2>
        <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
          Have questions or feedback? We'd love to hear from you! Our customer support team is available 24/7 to assist you with any inquiries.
        </p>
        <div class="grid md:grid-cols-3 gap-6 mb-8">
          <div class="flex items-center justify-center space-x-3 text-gray-300 bg-gray-700 p-4 rounded-lg">
            <span class="text-orange-500 text-xl">📧</span>
            <span>Foodie@gmail.com</span>
          </div>
          <div class="flex items-center justify-center space-x-3 text-gray-300 bg-gray-700 p-4 rounded-lg">
            <span class="text-orange-500 text-xl">📱</span>
            <span>+855 968 118 930</span>
          </div>
          <div class="flex items-center justify-center space-x-3 text-gray-300 bg-gray-700 p-4 rounded-lg">
            <span class="text-orange-500 text-xl">📍</span>
            <span>Phnom Penh, Cambodia</span>
          </div>
        </div>
        <button class="bg-orange-500 hover:bg-orange-600 text-black font-semibold px-8 py-3 rounded-lg transition-colors">
          Contact Us
        </button>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Clock, Award, Heart, Truck, Star as StarIcon } from 'lucide-vue-next'

const teamMembers = ref([
  { 
    name: 'Master Chef', 
    role: 'Head Chef', 
    icon: '👨‍🍳', 
    description: '15+ years of culinary expertise bringing authentic flavors to life' 
  },
  { 
    name: 'Tech Team', 
    role: 'Development', 
    icon: '💻', 
    description: 'Innovative app development and seamless user experience' 
  },
  { 
    name: 'Delivery Team', 
    role: 'Logistics', 
    icon: '🚚', 
    description: 'Fast & reliable service ensuring your food arrives fresh' 
  },
])

const values = ref([
  { icon: Clock, title: 'Fast Delivery', desc: 'Average 20–30 minutes' },
  { icon: Award, title: 'Quality Food', desc: 'Fresh & delicious meals' },
  { icon: Heart, title: 'Customer Care', desc: '24/7 support service' },
  { icon: Truck, title: 'Reliable Service', desc: 'Trusted delivery partners' },
])
</script>

<style scoped>
/* Add smooth scrolling and enhanced animations */
.transition-colors {
  transition: background-color 0.3s ease, color 0.3s ease;
}

.transition-shadow {
  transition: box-shadow 0.3s ease;
}

/* Enhance hover effects */
.hover\:shadow-xl:hover {
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Custom gradient text */
.bg-gradient-to-r {
  background: linear-gradient(to right, #f97316, #dc2626);
}

/* Enhanced card styling */
.bg-gray-800 {
  background-color: #1f2937;
}

.border-gray-700 {
  border-color: #374151;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .text-5xl {
    font-size: 2.5rem;
  }
  
  .lg\:text-6xl {
    font-size: 3rem;
  }
  
  .px-6 {
    padding-left: 1rem;
    padding-right: 1rem;
  }
}
</style>