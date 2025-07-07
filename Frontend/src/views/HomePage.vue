<template>
  <h1>Home Page</h1>
  {{auth}}
</template>

<script setup>
import { useAuthStore } from "@/stores/auth";
const auth = useAuthStore();
</script>

<style>

</style>