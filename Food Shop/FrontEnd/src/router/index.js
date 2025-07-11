import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import AboutPage from '@/views/AboutPage.vue'
import ContectPage from '@/views/ContactPage.vue'
import RegisterPage from '@/views/RegisterPage.vue'
import LoginPage from '@/views/LoginPage.vue'
import PostListPage from '@/views/posts/PostListPage.vue'
import PostAddPage from '@/views/posts/PostAddPage.vue'
import PostEditPage from '@/views/posts/PostEditPage.vue'

import ProductListPage from '@/views/products/ProductListPage.vue'
import ProductAddPage from '@/views/products/ProductAddPage.vue'
import ProductEditPage from '@/views/products/ProductEditPage.vue'

import CategoryAddPage from '@/views/category/CategoryAddPage.vue'
import CategoryEdit from '@/views/category/CategoryEdit.vue'
import CategoryListPage from '@/views/category/CategoryListPage.vue'

import MenuList from '@/views/Menu/MenuList.vue'
// import MenuAdd from '@/views/Menu/MenuAdd.vue'
// import MenuEdit from '@/views/Menu/MenuEdit.vue'

// 1. Import Pinia store
import { useAuthStore } from '@/stores/auth'
import MenuAdd from '@/views/Menu/MenuAdd.vue'
import MenuEdit from '@/views/Menu/MenuEdit.vue'
import DashBoard from '@/views/Admin/DashBoard.vue'

const routes = [
  { path: '/', name: 'Home', component: HomePage },
  { path: '/about', name: 'About', component: AboutPage },
  { path: '/register', name: 'Register', component: RegisterPage },
  { path: '/login', name: 'Login', component: LoginPage },
  { path: '/contect', name: 'Contect', component: ContectPage },

  { path: '/posts', name: 'PostList', component: PostListPage, meta: { requiresAuth: true } },
  { path: '/posts/add', name: 'PostAdd', component: PostAddPage },
  { path: '/posts/edit/:id', name: 'PostEdit', component: PostEditPage },

  { path: '/products', name: 'ProductList', component: ProductListPage, meta: { requiresAuth: true } },
  { path: '/products/add', name: 'ProductAdd', component: ProductAddPage },
  { path: '/products/edit/:id', name: 'ProductEdit', component: ProductEditPage },

  { path: '/categories', name:'CategoryList',component:CategoryListPage},
  { path: '/categories/add', name:'CategoryAdd',component:CategoryAddPage},
  { path: '/categories/edit/:id', name:'CategoryEdit',component:CategoryEdit},

  { path: '/menu', name:'MenuList',component:MenuList},
  { path: '/menu/add', name:'MenuAdd', component:MenuAdd},
  { path: '/menu/edit/:id', name:'MenuEdit', component:MenuEdit},

  { path: '/dashboard', name:'DashBoard', component:DashBoard},
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// 2. Add global navigation guard
router.beforeEach((to, from, next) => {
  const auth = useAuthStore()

  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    // ✅ Redirect if not logged in
    next('/login')
  } else {
    next()
  }
})

export default router
