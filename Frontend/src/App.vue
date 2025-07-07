<template>
  <div>
    <NavBar />
     <RouterView />
  </div>
</template>

<script setup>
import NavBar from '@/components/NavBar.vue'

</script>

<!-- <template>
  <div class="p-6 max-w-md mx-auto">
    <label class="block font-semibold mb-2">Select a Date Range</label>

    <div class="relative">
      <VueDatePicker
        v-model="dateRange"
        :range="true"
        :enable-time-picker="false"
        placeholder="Select date range"
        :input-props="{ readonly: true }"
        @input="onInput"
        class="w-full"
      />
      <button
        v-if="dateRange && dateRange[0] && dateRange[1]"
        @click="clearRange"
        class="absolute right-2 top-2 text-gray-500 hover:text-gray-700"
        aria-label="Clear date range"
        type="button"
      >
        ×
      </button>
    </div>

    <p v-if="dateRange && dateRange[0] && dateRange[1]" class="mt-2 text-gray-700">
      {{ formattedRange }}
    </p>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const dateRange = ref(null);

const clearRange = () => {
  dateRange.value = null;
};

const formatDate = (date) => {
  if (!date) return '';
  const day = date.getDate();
  const daySuffix = (d) => {
    if (d > 3 && d < 21) return 'th';
    switch (d % 10) {
      case 1: return 'st';
      case 2: return 'nd';
      case 3: return 'rd';
      default: return 'th';
    }
  };
  const month = date.toLocaleString('default', { month: 'long' });
  return `${day}${daySuffix(day)} ${month}`;
};

const formattedRange = computed(() => {
  if (!dateRange.value || !dateRange.value[0] || !dateRange.value[1]) return '';
  return `${formatDate(dateRange.value[0])} - ${formatDate(dateRange.value[1])}`;
});

// Optional: If you want to handle input event manually
const onInput = (val) => {
  dateRange.value = val;
};
</script>

<style scoped>
.dp__input {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 0.375rem;
  width: 100%;
  cursor: pointer;
}
button {
  background: transparent;
  border: none;
  font-size: 1.2rem;
  line-height: 1;
  cursor: pointer;
}
</style>
 -->
