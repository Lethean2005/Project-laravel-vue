<template>
  <div class="login-container">
    <h2>Login</h2>
    <input v-model="email" placeholder="Email" />
    <input v-model="password" placeholder="Password" type="password" />
    <button @click="login">Login</button>
    <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "@/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();

const email = ref("");
const password = ref("");
const errorMessage = ref("");

const login = async () => {
  try {
    const response = await api.post("/login", {
      email: email.value,
      password: password.value,
    });

    const token = response.data.token;

    // ✅ Use Pinia store's login action
    auth.login(token);

    // ✅ Redirect after successful login
    router.push("/");
  } catch (error) {
    errorMessage.value = "Login failed. Please check your credentials.";
  }
};
</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 1rem;
}
input {
  display: block;
  margin: 10px 0;
  padding: 0.5rem;
  width: 100%;
}
button {
  padding: 0.5rem 1rem;
  width: 100%;
}
</style>
