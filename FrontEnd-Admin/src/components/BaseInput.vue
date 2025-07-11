<!-- components/BaseInput.vue -->
<template>
  <div class="flex flex-col space-y-1">
    <!-- Label Slot -->
    <slot name="label"></slot>

    <!-- Input Group with Icon Slot -->
    <div class="flex items-center border border-gray-300 rounded px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
      <!-- Optional Icon -->
      <slot name="icon"></slot>

      <!-- Input Field -->
      <input
        v-bind="$attrs"
        class="w-full bg-transparent outline-none ml-2"
      />

      <!-- Optional Button or Icon on the Right -->
      <slot name="right"></slot>
    </div>

    <!-- Error Slot -->
    <slot name="error"></slot>
  </div>
</template>
