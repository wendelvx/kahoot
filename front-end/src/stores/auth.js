import { ref, computed } from 'vue';
import { defineStore } from 'pinia';
import http from '@/services/http';

export const useAuthStore = defineStore('auth', () => {
    const user = ref(JSON.parse(localStorage.getItem('user_data')));
    const isAuthenticated = computed(() => !!user.value);

    async function login(email, password) {
        try {
            await http.get('/sanctum/csrf-cookie');

            await http.post('/login', { email, password });

            
            const { data } = await http.get('/api/user'); 
            
            user.value = data;
            localStorage.setItem('user_data', JSON.stringify(data));
            
            return true; 
        } catch (error) {
            console.error('Erro no login:', error);
            throw error.response?.data?.errors || { email: ['Falha na autenticação'] };
        }
    }

    async function logout() {
        try {
            await http.post('/logout');
        } catch (error) {
            console.warn('Erro ao realizar logout no servidor:', error);
        } finally {
            
            user.value = null;
            localStorage.removeItem('user_data');
        }
    }

    return { user, isAuthenticated, login, logout };
});