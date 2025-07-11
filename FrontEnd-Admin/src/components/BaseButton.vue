<template>
  <button :class="[style,customeClass]">
    <slot></slot>
  </button>
</template>

<script setup>
import { ref } from "vue";
defineProps(['customeClass'])
const style = ref("text-white font-bold py-2 px-4 rounded");
</script>

<style>
</style>