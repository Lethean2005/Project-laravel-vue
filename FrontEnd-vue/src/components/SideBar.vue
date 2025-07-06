<template>
  <v-navigation-drawer v-model="drawer" color="#2B2B2B">
    <div class="pa-4">
      <v-img src="p1.webp" alt="food" width="150" height="150" class="ml-9" />
    </div>

    <v-card class="rounded-e-xl me" width="60" height="400" color="#545454" />

    <v-list class="top">
      <router-link
        v-for="(item, i) in links"
        :key="i"
        :to="item.to"
        class="text-decoration-none"
        style="color: inherit"
      >
        <v-list-item
          :value="item"
          class="mb-5"
          color="#FF6259"
          variant="plain"
        >
          <template v-slot:append="{ isActive }">
            <div v-if="isActive" class="a"></div>
          </template>
          <template v-slot:prepend>
            <v-icon :icon="item.icon" />
          </template>
          <v-list-item-title v-text="item.text" />
        </v-list-item>
      </router-link>
    </v-list>

    <div
      style="
        position: absolute;
        bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        text-align: center;
      "
    >
      <v-btn icon="mdi mdi-cog" size="small" class="mr-2" color="#5F3B39" />
      <v-badge dot color="#FF6259">
        <v-btn icon="mdi mdi-bell" size="small" color="#5F3B39" />
      </v-badge>
    </div>
  </v-navigation-drawer>
</template>

<script setup>
import { ref } from 'vue'

const drawer = ref(true)

const links = [
  { text: "Dashboard", icon: "mdi mdi-view-dashboard", to: "/" },
  { text: "Orders", icon: "mdi mdi-phone-classic", to: "/order" },
  { text: "Restaurants", icon: "mdi mdi-map-marker-radius", to: "/restaurants" },
  { text: "Finance", icon: "mdi mdi-finance", to: "/finance" },
  { text: "Products", icon: "mdi mdi-finance", to: "/products" },
  { text: "Logout", icon: "mdi mdi-logout", to: "/logout" },
]
</script>

<style scoped>
.v-list-item.v-list-item--active {
  color: white !important;
}
.top {
  margin-top: 60px;
}
.me {
  position: absolute;
  margin-top: 28px;
}
.v-locale--is-ltr .rounded-e-xl {
  border-top-right-radius: 44px !important;
  border-bottom-right-radius: 44px !important;
}
.a {
  top: 32%;
  left: 20.5%;
  position: absolute;
  height: 15px;
  width: 15px;
  background: linear-gradient(-90deg, #545454, #545454 50%, black 50%);
  border-radius: 50%;
}
</style>
