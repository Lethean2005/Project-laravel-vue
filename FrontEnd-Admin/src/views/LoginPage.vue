<template>
  <div class="login-container">
    <div class="login-box">
      <h2 class="login-title">Login</h2>
      <input v-model="email" placeholder="Email" class="input-field" />
      <input v-model="password" placeholder="Password" type="password" class="input-field" />
      <button @click="login" class="login-button">Login</button>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
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
    auth.login(token);
    router.push("/");
  } catch (error) {
    errorMessage.value = "Login failed. Please check your credentials.";
  }
};
</script>

<style scoped>
.login-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f3f4f6;
}

.login-box {
  background: #ffffff;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
  width: 100%;
  max-width: 400px;
}

.login-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1.5rem;
  text-align: center;
}

.input-field {
  margin-bottom: 1rem;
  padding: 0.75rem 1rem;
  width: 100%;
  border: 1px solid #d1d5db;
  border-radius: 0.5rem;
  font-size: 1rem;
  outline: none;
  transition: border-color 0.2s;
}

.input-field:focus {
  border-color: #6366f1;
}

.login-button {
  width: 100%;
  background: #6366f1;
  color: white;
  font-weight: 600;
  padding: 0.75rem 1rem;
  border: none;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: background 0.2s;
}

.login-button:hover {
  background: #4f46e5;
}

.error-message {
  color: #dc2626;
  font-size: 0.95rem;
  margin-top: 1rem;
  text-align: center;
}
</style>
