<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import http from '@/services/http';
import AppLayout from '@/layouts/AppLayout.vue';
import BaseButton from '@/components/BaseButton.vue';

const router = useRouter();
const ranking = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const { data } = await http.get('/api/ranking'); 
        ranking.value = data;
    } catch (error) {
        console.error(error);
    } finally {
        loading.value = false;
    }
});

const startQuiz = () => {
    router.push('/quiz');
};
</script>

<template>
    <AppLayout>
        <div class="hero-card">
            <div class="hero-text">
                <h2>O Senhor quer codar, 06?</h2>
                <p>A chapa tá quente. Mostre que domina a stack ou peça pra sair.</p>
            </div>
            <div class="hero-action">
                <BaseButton @click="startQuiz" style="background: #111827; border: 1px solid #facc15; color: #facc15;">
                    💀 INICIAR OPERAÇÃO
                </BaseButton>
            </div>
        </div>

        <div class="ranking-container">
            <div class="ranking-header">
                <h3>🎖️ ELITE DA TROPA</h3>
                <p>Somente os caveiras entram nesta lista.</p>
            </div>

            <div v-if="loading" class="loading-state">
                <div class="spinner"></div>
                <p>Decodificando inteligência...</p>
            </div>

            <div v-else-if="ranking.length === 0" class="empty-state">
                <span class="empty-icon">📂</span>
                <p>Área limpa. Nenhum combatente se apresentou ainda.</p>
            </div>

            <div v-else class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Classificação</th>
                            <th>Operador</th>
                            <th>Score Tático</th>
                            <th>Tempo de Reação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in ranking" :key="item.id">
                            <td class="rank-pos">
                                <span class="medal gold" v-if="index === 0">💀 01</span>
                                <span class="medal silver" v-else-if="index === 1">🥈 02</span>
                                <span class="medal bronze" v-else-if="index === 2">🥉 03</span>
                                <span v-else>#{{ index + 1 }}</span>
                            </td>
                            <td class="player-name">
                                <span class="patente-icon">👮</span> {{ item.user.name }}
                            </td>
                            <td>
                                <span class="score-badge">{{ item.score }} pts</span>
                            </td>
                            <td class="time-cell">{{ item.total_time_seconds }}s</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.hero-card {
    background: white; 
    border-radius: 4px; 
    padding: 40px;
    display: flex; 
    justify-content: space-between; 
    align-items: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3); 
    margin-bottom: 30px;
    border-left: 10px solid #facc15; 
}
.hero-text h2 { 
    color: #111827; 
    font-size: 2rem; 
    margin: 0 0 10px 0; 
    font-weight: 900; 
    text-transform: uppercase; 
}
.hero-text p { color: #4b5563; margin: 0; font-size: 1.1rem; font-weight: 600; }
.hero-action { width: 250px; }

.ranking-container {
    background: white; 
    border-radius: 4px; 
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    border-top: 5px solid #111827;
}

.ranking-header { text-align: center; margin-bottom: 30px; }
.ranking-header h3 { font-size: 1.8rem; color: #111827; margin: 0; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
.ranking-header p { color: #6b7280; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; }

/* Tabela */
.table-wrapper { 
    overflow-x: auto; /* Permite scroll horizontal no mobile */
    -webkit-overflow-scrolling: touch; /* Scroll suave no iOS */
}

table { width: 100%; border-collapse: separate; border-spacing: 0 10px; min-width: 600px; /* Força largura mínima para não espremer */ }

th { 
    text-align: left; color: #9ca3af; padding: 10px 20px; 
    font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 800;
}

tbody tr { 
    background: #f9fafb; 
    transition: transform 0.2s; 
    border: 1px solid #e5e7eb;
}
tbody tr:hover { 
    transform: scale(1.01); 
    background: #f3f4f6; 
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

td { padding: 20px; border-top: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; }
td:first-child { border-left: 1px solid #e5e7eb; border-radius: 4px 0 0 4px; }
td:last-child { border-right: 1px solid #e5e7eb; border-radius: 0 4px 4px 0; }

.rank-pos { font-weight: 800; color: #111827; width: 100px; font-family: monospace; font-size: 1.1rem; }

/* Medalhas */
.medal { font-weight: bold; padding: 5px 10px; border-radius: 4px; color: white; display: inline-block; width: 100%; text-align: center; }
.medal.gold { background: #111827; color: #facc15; border: 1px solid #facc15; }
.medal.silver { background: #9ca3af; color: white; }
.medal.bronze { background: #78350f; color: white; }

.player-name { font-weight: 700; color: #374151; font-size: 1.1rem; text-transform: uppercase; }
.score-badge { background: #111827; color: #facc15; padding: 6px 12px; border-radius: 4px; font-weight: 700; font-family: monospace; }
.time-cell { color: #6b7280; font-variant-numeric: tabular-nums; font-family: monospace; }

.loading-state, .empty-state { text-align: center; padding: 40px; color: #6b7280; }
.spinner { border: 4px solid #f3f3f3; border-top: 4px solid #111827; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 0 auto 20px; }

@keyframes spin { 100% { transform: rotate(360deg); } }

@media (max-width: 768px) {
    .hero-card { 
        flex-direction: column; 
        text-align: center; 
        gap: 20px; 
        padding: 25px; 
        border-left: none;
        border-top: 8px solid #facc15; 
    }
    
    .hero-text h2 { font-size: 1.6rem; }
    .hero-action { width: 100%; } 
    
    .ranking-container { padding: 20px; }
    .ranking-header h3 { font-size: 1.5rem; }
    
    /* Ajuste Fino da Tabela */
    th, td { padding: 12px 15px; } 
    .rank-pos { width: 80px; font-size: 1rem; }
    .player-name { font-size: 1rem; }
}
</style>