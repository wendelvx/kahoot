<script setup>
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';

const auth = useAuthStore();
const router = useRouter();

const handleLogout = async () => {
    if(confirm("O senhor quer pedir pra sair? O senhor não aguenta?")) {
        await auth.logout();
        router.push('/');
    }
};
</script>

<template>
    <div class="app-layout">
        <nav class="navbar">
            <div class="nav-brand" @click="router.push('/dashboard')">
                <span class="brand-icon">💀</span> 
                <span class="brand-name">Caehoot <span class="ops-tag">OPS</span></span>
            </div>
            
            <div class="user-controls" v-if="auth.user">
                <span class="user-greeting">Sentido, <strong>06 {{ auth.user.name }}</strong>!</span>
                
                <button @click="handleLogout" class="btn-logout">
                    PEDIR PRA SAIR
                </button>
            </div>
            
            <div class="user-controls" v-else>
                <router-link to="/login" class="nav-link">APRESENTAR-SE</router-link>
            </div>
        </nav>

        <main class="main-content">
            <slot></slot>
        </main>
    </div>
</template>

<style scoped>
.app-layout {
    min-height: 100vh;
    background: linear-gradient(135deg, #111827 0%, #1e1b4b 100%);
    font-family: 'Segoe UI', sans-serif;
    padding-bottom: 40px;
    color: #e5e7eb;
}

.navbar {
    display: flex; justify-content: space-between; align-items: center;
    padding: 20px 40px; 
    background: rgba(0, 0, 0, 0.6); /* Mais escuro */
    backdrop-filter: blur(10px); 
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
    color: white;
}

.nav-brand { display: flex; align-items: center; gap: 10px; font-size: 1.5rem; font-weight: 800; cursor: pointer; }

.ops-tag {
    font-size: 0.7rem;
    background-color: #facc15;
    color: black;
    padding: 2px 6px;
    border-radius: 4px;
    vertical-align: middle;
    margin-left: 5px;
    letter-spacing: 1px;
}

.user-controls { display: flex; align-items: center; gap: 20px; }

.user-greeting {
    font-family: monospace; 
    letter-spacing: -0.5px;
}

.btn-logout {
    background: transparent; 
    border: 1px solid rgba(239, 68, 68, 0.5);
    color: #ef4444; 
    padding: 8px 16px; 
    border-radius: 4px; 
    cursor: pointer; 
    font-weight: 800; 
    font-size: 0.9rem;
    transition: all 0.2s;
    text-transform: uppercase;
}

.btn-logout:hover { 
    background: #ef4444; 
    color: white;
    border-color: #ef4444;
    box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
}

.nav-link { 
    color: #facc15; 
    text-decoration: none; 
    font-weight: 700; 
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 1px solid #facc15;
    padding: 8px 16px;
    border-radius: 4px;
}

.nav-link:hover {
    background: rgba(250, 204, 21, 0.1);
}

.main-content { max-width: 900px; margin: 40px auto; padding: 0 20px; }

@media (max-width: 600px) {
    .navbar { flex-direction: column; gap: 15px; padding: 15px 20px; }
    .user-greeting { font-size: 0.9rem; }
}
</style>