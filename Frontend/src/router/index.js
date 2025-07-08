import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import AboutPage from '@/views/AboutPage.vue'
import ProductPage from '@/views/ProductPage.vue'
import RegisterPage from '@/views/RegisterPage.vue'
import LoginPage from '@/views/LoginPage.vue'
import PostListPage from '@/views/posts/PostListPage.vue'
import PostAddPage from '@/views/posts/PostAddPage.vue'
import PostEditPage from '@/views/posts/PostEditPage.vue'
// import ProductAdd from '@/views/Products/ProductAdd.vue'
// import ProductEdit from '@/views/Products/ProductEdit.vue'
// import ProductList from '@/views/Products/ProductList.vue'

//
//  1. Import Pinia store
import { useAuthStore } from '@/stores/auth'
import CategoryListPage from '@/views/category/CategoryListPage.vue'
import CategoryAddPage from '@/views/category/CategoryAddPage.vue'
import CategoryEdit from '@/views/category/CategoryEdit.vue'
import ProductEdit from '@/views/Products/ProductEdit.vue'
import ProductAdd from '@/views/Products/ProductAdd.vue'
import ProductList from '@/views/Products/ProductList.vue'

// Add import for Profile.vue
import ProfilePage from '@/views/Profile.vue'

const routes = [
  { path: '/', name: 'Home', component: HomePage },
  { path: '/about', name: 'About', component: AboutPage },
  { path: '/product', name: 'Product', component: ProductPage },
  { path: '/register', name: 'Register', component: RegisterPage },
  { path: '/login', name: 'Login', component: LoginPage },

  // {
  //   path: '/post',
  //   name: 'Post',
  //   component: PostPage,
  //   meta: { requiresAuth: true } // ✅ Protected route
  // }
  { path: '/posts', name: 'PostList', component: PostListPage, meta: { requiresAuth: true } },
  { path: '/posts/add', name: 'PostAdd', component: PostAddPage },
  { path: '/posts/edit/:id', name: 'PostEdit', component: PostEditPage },

  { path: '/categories', name:'CategoryList',component:CategoryListPage},
  { path: '/categories/add', name:'CategoryAdd',component:CategoryAddPage},
  { path: '/categories/edit/:id', name:'CategoryEdit',component:CategoryEdit},

  { path: '/products', name:'ProductList', component:ProductList},
  { path: '/products/add', name:'ProductAdd', component:ProductAdd},
  { path: '/products/edit/:id', name:'ProductEdit', component:ProductEdit},

  // Add profile route here with auth required
  { path: '/profile', name: 'Profile', component: ProfilePage, meta: { requiresAuth: true } },
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
