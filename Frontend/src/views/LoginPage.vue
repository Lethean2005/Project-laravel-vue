<template>
  <div class="login-wrapper">
    <div class="login-card">
      <!-- Left side with food image -->
      <div class="left-panel">
        <div class="food-image">
          <img src="https://accro.fr/wp-content/uploads/2021/08/accro-recette-burger-vegetarien-1-1600x800-c-default.jpg" alt="Delicious Pancakes" class="pancake-image" />
        </div>
        <div class="logo-overlay">
          <div class="logo-white">M</div>
        </div>
      </div>

      <!-- Right side with login form -->
      <div class="right-panel">
        <div class="login-content">
          <!-- Header with logo and branding -->
          <div class="header-section">
            <div class="logo-section">
              <div class="logo-pink">M</div>
              <div class="brand-info">
                <h1 class="brand-name">Mateza</h1>
                <p class="brand-tagline">For Restaurants</p>
                <p class="brand-subtitle">The Taste of Success</p>
              </div>
            </div>
          </div>

          <!-- Login form -->
          <div class="form-section">
            <h2 class="login-title">LOGIN</h2>
            
            <form @submit.prevent="login" class="login-form">
              <div class="input-group">
                <label class="input-label">Username</label>
                <input 
                  v-model="email" 
                  type="text"
                  placeholder="Enter Username" 
                  class="form-input"
                  required
                />
              </div>
              
              <div class="input-group">
                <label class="input-label">Password</label>
                <div class="password-wrapper">
                  <input 
                    v-model="password" 
                    :type="showPassword ? 'text' : 'password'"
                    placeholder="Enter Password" 
                    class="form-input password-input"
                    required
                  />
                  <button 
                    type="button" 
                    @click="togglePassword"
                    class="password-toggle"
                  >
                    <svg v-if="showPassword" class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                      <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                      <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                    <svg v-else class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                      <circle cx="12" cy="12" r="3"/>
                    </svg>
                  </button>
                </div>
              </div>
              
              <button type="submit" class="login-btn" :disabled="!email || !password">
                login
              </button>
              
              <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
              
              <div class="divider">
                <span class="divider-text">or login with</span>
              </div>
              
              <div class="social-buttons">
                <button type="button" class="social-btn facebook-btn">
                  <svg class="social-icon" viewBox="0 0 24 24">
                    <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                  </svg>
                </button>
                
                <button type="button" class="social-btn twitter-btn">
                  <svg class="social-icon" viewBox="0 0 24 24">
                    <path fill="#1DA1F2" d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                  </svg>
                </button>
                
                <button type="button" class="social-btn google-btn">
                  <svg class="social-icon" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                  </svg>
                </button>
              </div>
            </form>
            
            <div class="footer-section">
              <a href="#" class="contact-link">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
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
const showPassword = ref(false);

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

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
* {
  box-sizing: border-box;
}

.login-wrapper {
  min-height: 100vh;
  background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.login-card {
  display: flex;
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
  max-width: 900px;
  width: 100%;
  min-height: 600px;
}

/* LEFT PANEL - Food Image */
.left-panel {
  flex: 1;
  position: relative;
  background: #2c3e50;
  display: flex;
  align-items: center;
  justify-content: center;
}

.food-image {
  width: 100%;
  height: 100%;
  position: relative;
}

.pancake-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px 0 0 20px;
}

.logo-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
}

.logo-white {
  width: 80px;
  height: 80px;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
  font-weight: bold;
  color: #ff6b9d;
  font-style: italic;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

/* RIGHT PANEL - Login Form */
.right-panel {
  flex: 1;
  background: white;
  display: flex;
  align-items: center;
  justify-content: center;
}

.login-content {
  width: 100%;
  max-width: 350px;
  padding: 2rem;
}

.header-section {
  margin-bottom: 2rem;
}

.logo-section {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.logo-pink {
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #ff6b9d, #ff8fab);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.8rem;
  font-weight: bold;
  color: white;
  font-style: italic;
  box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
}

.brand-info {
  flex: 1;
}

.brand-name {
  font-size: 1.8rem;
  font-weight: bold;
  color: #2c3e50;
  margin: 0;
  line-height: 1;
}

.brand-tagline {
  font-size: 0.9rem;
  color: #7f8c8d;
  margin: 0.2rem 0 0 0;
  font-weight: 500;
}

.brand-subtitle {
  font-size: 0.8rem;
  color: #ff6b9d;
  margin: 0.1rem 0 0 0;
  font-weight: 500;
}

.form-section {
  width: 100%;
}

.login-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: #2c3e50;
  margin-bottom: 1.5rem;
  text-align: left;
}

.login-form {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}

.input-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.input-label {
  font-size: 0.9rem;
  font-weight: 500;
  color: #2c3e50;
}

.form-input {
  width: 100%;
  padding: 0.8rem 1rem;
  border: 1px solid #e0e6ed;
  border-radius: 8px;
  font-size: 0.9rem;
  background: #f8f9fa;
  transition: all 0.2s ease;
  color: #2c3e50;
}

.form-input:focus {
  outline: none;
  border-color: #ff6b9d;
  background: white;
  box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.1);
}

.form-input::placeholder {
  color: #bdc3c7;
}

.password-wrapper {
  position: relative;
}

.password-input {
  padding-right: 3rem;
}

.password-toggle {
  position: absolute;
  right: 0.8rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: #95a5a6;
  padding: 0.2rem;
}

.eye-icon {
  width: 18px;
  height: 18px;
  stroke-width: 2;
}

.login-btn {
  background: linear-gradient(135deg, #ff6b9d, #ff8fab);
  color: white;
  border: none;
  padding: 0.9rem 1.5rem;
  border-radius: 8px;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-transform: lowercase;
  margin-top: 0.5rem;
}

.login-btn:hover:not(:disabled) {
  background: linear-gradient(135deg, #ff5a8a, #ff7a9a);
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(255, 107, 157, 0.3);
}

.login-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.error-message {
  color: #e74c3c;
  font-size: 0.8rem;
  text-align: center;
  margin: 0;
  padding: 0.5rem;
  background: rgba(231, 76, 60, 0.1);
  border-radius: 6px;
}

.divider {
  text-align: center;
  position: relative;
  margin: 1.5rem 0 1rem 0;
}

.divider::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background: #e0e6ed;
}

.divider-text {
  background: white;
  padding: 0 1rem;
  color: #95a5a6;
  font-size: 0.8rem;
}

.social-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  margin-bottom: 1.5rem;
}

.social-btn {
  width: 45px;
  height: 45px;
  border: 1px solid #e0e6ed;
  border-radius: 50%;
  background: white;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.social-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.social-icon {
  width: 20px;
  height: 20px;
}

.footer-section {
  text-align: center;
}

.contact-link {
  color: #95a5a6;
  text-decoration: none;
  font-size: 0.8rem;
  font-weight: 500;
}

.contact-link:hover {
  color: #ff6b9d;
  text-decoration: underline;
}

/* Responsive design */
@media (max-width: 768px) {
  .login-wrapper {
    padding: 1rem;
  }
  
  .login-card {
    flex-direction: column;
    max-width: 400px;
  }
  
  .left-panel {
    min-height: 200px;
  }
  
  .pancake-image {
    border-radius: 20px 20px 0 0;
  }
  
  .login-content {
    padding: 1.5rem;
  }
  
  .logo-section {
    justify-content: center;
    text-align: center;
  }
  
  .login-title {
    text-align: center;
  }
}

@media (max-width: 480px) {
  .login-content {
    padding: 1rem;
  }
  
  .brand-name {
    font-size: 1.5rem;
  }
  
  .social-buttons {
    gap: 0.5rem;
  }
  
  .social-btn {
    width: 40px;
    height: 40px;
  }
}
</style>