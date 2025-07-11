<template>
  <div>
    <h2>Your Cart</h2>
    <ul>
      <li v-for="item in cart" :key="item.menu_id">
        {{ item.name }} - Qty: {{ item.quantity }} - Price: ${{ item.price }}
        <button @click="removeItem(item.menu_id)">Remove</button>
      </li>
    </ul>
    <p>Total: ${{ totalPrice.toFixed(2) }}</p>
    <button @click="placeOrder">Place Order</button>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'

const cart = ref([
  // example cart items (you will replace with your state/store)
  { menu_id: 1, name: 'Noodles', quantity: 2, price: 10.5 },
  { menu_id: 2, name: 'Soup', quantity: 1, price: 7.25 },
])

const totalPrice = computed(() => {
  return cart.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
})

const removeItem = (menu_id) => {
  cart.value = cart.value.filter(item => item.menu_id !== menu_id)
}

const placeOrder = async () => {
  try {
    const orderItems = cart.value.map(i => ({
      menu_id: i.menu_id,
      quantity: i.quantity
    }))

    const response = await axios.post('http://localhost:8000/api/orders', {
      items: orderItems
    })
    alert('Order placed successfully')
    cart.value = [] // clear cart or redirect
  } catch (error) {
    console.error('Failed to place order', error)
  }
}
</script>
