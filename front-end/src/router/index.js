import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

import HomeView from '../views/HomeView.vue';
import LoginView from '../views/LoginView.vue';
import RegisterView from '../views/RegisterView.vue';
import DashboardView from '../views/DashboardView.vue';
import QuizView from '../views/QuizView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { guest: true } 
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { guest: true }
    },
    { 
      path: '/register', 
      name: 'register', 
      component: RegisterView,
      meta: { guest: true }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardView,
      meta: { auth: true }
    },
    { 
      path: '/quiz', 
      name: 'quiz', 
      component: QuizView,
      meta: { auth: true }
    },
  ]
});

router.beforeEach((to, from, next) => {
  const auth = useAuthStore();
  
  if (to.meta.auth && !auth.isAuthenticated) {
    return next({ name: 'login' });
  }

  
  if ((to.name === 'login' || to.name === 'register') && auth.isAuthenticated) {
    return next({ name: 'dashboard' });
  }

  next();
});

export default router;