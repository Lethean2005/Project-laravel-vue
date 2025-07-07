<template>
  <div class="categoryedit-container">
    <h2 class="categoryedit-title">Edit Category</h2>
    <div class="categoryedit-form">
      <input
        v-model="name"
        type="text"
        placeholder="Category Name"
        class="categoryedit-input"
      />
      <button
        @click="updateCategory"
        class="categoryedit-btn"
      >
        Update
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "@/api";

const route = useRoute();
const router = useRouter();

const name = ref("");


onMounted(async () => {
  const res = await api.get(`/categories/${route.params.id}`);
  name.value = res.data.data.name;

});

const updateCategory = async () => {
  await api.put(`/categories/${route.params.id}`, {
    name: name.value,
  });
  router.push("/categories");
};
</script>

<style scoped>
.categoryedit-container {
  padding: 2.5rem 2rem;
  max-width: 1000px;
  margin: 3rem auto;
  background: rgba(255,255,255,0.8);
  border-radius: 2rem;
  box-shadow: 0 8px 32px 0 rgba(31, 41, 55, 0.12);
  backdrop-filter: blur(10px);
}
.categoryedit-title {
  font-size: 2rem;
  font-weight: 700;
  color: #2563eb;
  letter-spacing: 1px;
  text-shadow: 0 2px 8px #dbeafe;
  margin-bottom: 2rem;
  text-align: center;
}
.categoryedit-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}
.categoryedit-input {
  width: 100%;
  padding: 1rem 1.2rem;
  border-radius: 1.2rem;
  border: 1.5px solid rgba(59, 130, 246, 0.13);
  background: rgba(255,255,255,0.7);
  font-size: 1.1rem;
  color: #1e293b;
  box-shadow: 0 2px 8px 0 rgba(59, 130, 246, 0.06);
  transition: border 0.2s, box-shadow 0.2s;
  outline: none;
}
.categoryedit-input:focus {
  border: 1.5px solid #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.13);
  background: rgba(255,255,255,0.95);
}
.categoryedit-btn {
  background: linear-gradient(90deg, #2563eb 0%, #38bdf8 100%);
  color: #fff;
  font-weight: 600;
  font-size: 1.1rem;
  padding: 0.8rem 0;
  border: none;
  border-radius: 1.2rem;
  box-shadow: 0 2px 10px 0 rgba(59, 130, 246, 0.10);
  cursor: pointer;
  transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
  margin-top: 0.5rem;
}
.categoryedit-btn:hover {
  background: linear-gradient(90deg, #1d4ed8 0%, #0ea5e9 100%);
  transform: translateY(-2px) scale(1.03);
  box-shadow: 0 4px 18px 0 rgba(59, 130, 246, 0.18);
}
</style>
