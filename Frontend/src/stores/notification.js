import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useNotificationStore = defineStore('notification', () => {
  const count = ref(0)
  const db_count = ref(0)

  function increment() {
    count.value++
    db_count.value = count.value*2
  }

  function reset() {
    count.value = 0
  }

  return { count, increment, reset,db_count }
})
