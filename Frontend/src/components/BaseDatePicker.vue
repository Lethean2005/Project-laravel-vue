<template>
  <Datepicker
    :model-value="modelValue"
    @update:model-value="val => $emit('update:modelValue', val)"
    :range="range"
    :multi-calendars="multiCalendars"
    :min-date="minDate"
    :format="format"
    :placeholder="placeholder"
  />
</template>

<script setup>
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

defineProps({
  modelValue: {
    type: [Date, Array],
    required: true,
  },
  range: {
    type: Boolean,
    default: false,
  },
  multiCalendars: {
    type: [Boolean, Number],
    default: false,
  },
  minDate: {
    type: Date,
    default: null,
  },
  format: {
    type: String,
    default: 'yyyy-MM-dd',
  },
  placeholder: {
    type: String,
    default: 'Select a date',
  },
})

defineEmits(['update:modelValue'])
</script>
