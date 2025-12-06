<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const router = useRouter();
const auth = useAuthStore();

const handleCta = () => {
    if (auth.isAuthenticated) {
        router.push('/dashboard');
    } else {
        router.push('/register');
    }
};
</script>

<template>
    <AppLayout>
        <div class="home-hero">
            <div class="hero-content">
                <span class="badge">Operação Caveira 2025 💀</span>
                
                <h1>Missão: Exterminar a Burrice</h1>
                
                <p>
                    Vue.js no front, Laravel no back e faca nos dentes. 
                    Aqui o bug pede pra sair. O senhor vai codar ou vai desistir, 06?
                </p>
                
                <div class="actions">
                    <button @click="handleCta" class="cta-button">
                        {{ auth.isAuthenticated ? 'ACESSAR O Q.G.' : 'ALISTAR-SE AGORA' }}
                    </button>
                    
                </div>
            </div>
            
            <div class="hero-stats">
                <div class="stat-card">
                    <h3>+1000</h3>
                    <p>Alvos Abatidos</p> </div>
                <div class="stat-card">
                    <h3>Elite</h3>
                    <p>Ranking do Batalhão</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>


.home-hero {
    text-align: center; color: white; padding: 40px 0;
}
.badge {
    background: black;
    color: #facc15; 
    padding: 5px 15px;
    border-radius: 4px; 
    font-size: 0.9rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: 2px;
}
h1 { 
    font-size: 3.5rem; 
    margin: 20px 0; 
    line-height: 1.1; 
    font-weight: 900; 
    text-transform: uppercase; 
}
p { font-size: 1.25rem; opacity: 0.9; max-width: 600px; margin: 0 auto 40px; }

.actions { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }

.cta-button {
    padding: 15px 40px; 
    background: white; 
    color: #7e22ce; 
    border: none; border-radius: 4px; 
    font-size: 1.1rem; font-weight: 900;
    cursor: pointer; transition: transform 0.2s;
    text-transform: uppercase;
}
.cta-button:hover { transform: scale(1.05); }

.secondary-button {
    padding: 15px 40px; background: transparent; color: white;
    border: 2px solid rgba(255,255,255,0.3); border-radius: 4px;
    font-size: 1.1rem; font-weight: 700; cursor: pointer;
    text-transform: uppercase;
}
.secondary-button:hover { background: rgba(255,255,255,0.1); }

.hero-stats {
    display: flex; justify-content: center; gap: 20px; margin-top: 60px;
}
.stat-card {
    background: rgba(0, 0, 0, 0.3);
    padding: 20px; border-radius: 4px;
    min-width: 150px; backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.1);
}
.stat-card h3 { font-size: 2rem; margin: 0; font-weight: 800; }
.stat-card p { margin: 5px 0 0; opacity: 0.8; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;}

@media (max-width: 600px) {
    h1 { font-size: 2.2rem; }
    .hero-stats { flex-direction: column; }
    .stat-card { width: 100%; }
}
</style>