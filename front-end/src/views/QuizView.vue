<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useRouter } from 'vue-router';
import http from '@/services/http';

import imgRecruta from '@/assets/prof-recruta.png';
import imgCombatente from '@/assets/prof-combatente.png';
import imgBope from '@/assets/prof-bope.png';

const router = useRouter();

const loading = ref(true);
const loadingMessage = ref('Infiltrando no Sistema...');
const sending = ref(false);
const quiz = ref(null);
const questions = ref([]);
const currentIndex = ref(0);
const selectedOptionId = ref(null);

const answered = ref(false);
const answerResult = ref(null);
const timeLeft = ref(10);
const isTimeout = ref(false);
let timerInterval = null;

const isFinished = ref(false);
const finalResult = ref(null);

const imageReady = ref(false);

const onImageLoad = () => {
    imageReady.value = true;
};

const optionStyles = [
    { color: 'red', icon: '▲', bg: '#e21b3c' },
    { color: 'blue', icon: '◆', bg: '#1368ce' },
    { color: 'orange', icon: '●', bg: '#d89e00' },
    { color: 'green', icon: '■', bg: '#26890c' }
];

const currentQuestion = computed(() => questions.value[currentIndex.value]);
const progressPercentage = computed(() => ((currentIndex.value + 1) / questions.value.length) * 100);
const timerPercentage = computed(() => (timeLeft.value / 10) * 100);

const playerRank = computed(() => {
    if (!finalResult.value) return null;

    const acertos = finalResult.value.total_correct;

    if (acertos <= 2) {
        return {
            title: 'ASPIRA BISONHO',
            image: imgRecruta, 
            message: 'O senhor não estudou? O senhor é um fanfarrão! Pede pra sair!',
            class: 'rank-recruta'
        };
    }
    
    if (acertos <= 9) { 
        return {
            title: 'COMBATENTE OPERACIONAL',
            image: imgCombatente, 
            message: 'Padrão. Cumpriu a missão, mas não esperava menos que isso.',
            class: 'rank-combatente'
        };
    }

    return {
        title: 'CAVEIRA (BOPE)',
        image: imgBope, 
        message: 'A farda preta lhe cai bem. O senhor é o orgulho do batalhão!',
        class: 'rank-bope'
    };
});

onMounted(async () => {
    try {
        loadingMessage.value = 'Carregando Munição...';
        
        [imgRecruta, imgCombatente, imgBope].forEach(src => {
            const img = new Image();
            img.src = src;
        });

        const { data } = await http.post('/api/quizzes/start');
        quiz.value = data.quiz;
        questions.value = data.questions;
        loading.value = false;
        startTimer();
    } catch (error) {
        alert('Falha na comunicação com o QG.');
        router.push('/dashboard');
    }
});

onUnmounted(() => {
    stopTimer();
});

const startTimer = () => {
    stopTimer();
    timeLeft.value = 10;
    isTimeout.value = false;
    
    timerInterval = setInterval(() => {
        if (timeLeft.value > 0) {
            timeLeft.value--;
        } else {
            handleTimeout();
        }
    }, 1000);
};

const stopTimer = () => {
    if (timerInterval) clearInterval(timerInterval);
};

const handleTimeout = () => {
    stopTimer();
    answered.value = true;
    isTimeout.value = true;
    answerResult.value = false;
};

const selectOption = async (optionId) => {
    if (answered.value) return;
    stopTimer();
    selectedOptionId.value = optionId;
    await confirmAnswer();
};

const confirmAnswer = async () => {
    if (!selectedOptionId.value || sending.value) return;

    sending.value = true;

    try {
        const { data } = await http.post('/api/answers', {
            quiz_id: quiz.value.id,
            question_id: currentQuestion.value.id,
            selected_option_id: selectedOptionId.value
        });
        
        answerResult.value = data.is_correct;
        answered.value = true;

    } catch (error) {
        alert('Erro tático ao enviar resposta.');
    } finally {
        sending.value = false;
    }
};

const nextQuestion = async () => {
    if (currentIndex.value < questions.value.length - 1) {
        currentIndex.value++;
        selectedOptionId.value = null;
        answered.value = false;
        answerResult.value = null;
        isTimeout.value = false;
        startTimer();
    } else {
        await finishQuiz();
    }
};

const finishQuiz = async () => {
    try {
        stopTimer();
        loadingMessage.value = 'Gerando Relatório de Missão...';
        loading.value = true;
        
        const { data } = await http.post(`/api/quizzes/${quiz.value.id}/finish`);
        
        finalResult.value = data.quiz;
        loading.value = false;
        isFinished.value = true;

    } catch (error) {
        alert('Erro ao finalizar missão.');
        router.push('/dashboard');
    }
};

const goToDashboard = () => {
    router.push('/dashboard');
};

const getOptionClass = (option, index) => {
    if (!answered.value) {
        return { [`style-${index}`]: true };
    }

    if (isTimeout.value) {
        return 'dimmed';
    }

    if (selectedOptionId.value === option.id && answerResult.value) return 'correct';
    if (selectedOptionId.value === option.id && !answerResult.value) return 'wrong';
    
    return 'dimmed';
};
</script>

<template>
    <div class="kahoot-container">
        
        <div v-if="loading" class="loading-screen">
            <div class="spinner"></div>
            <h2>{{ loadingMessage }}</h2>
        </div>

        <div v-else-if="isFinished" class="result-screen">
            <div class="result-card">
                
                <div v-if="playerRank" class="rank-reveal">
                    <div class="professor-avatar-container" :class="playerRank.class">
                        
                        <div v-if="!imageReady" class="avatar-loader">
                            <div class="spinner-small"></div>
                        </div>

                        <img 
                            :src="playerRank.image" 
                            alt="Reação do Professor" 
                            class="professor-img" 
                            :class="{ 'fade-in': imageReady }"
                            @load="onImageLoad"
                            v-show="imageReady"
                        />
                    </div>
                    
                    <h2 class="rank-title">{{ playerRank.title }}</h2>
                    <p class="rank-message">"{{ playerRank.message }}"</p>
                </div>

                <div class="divider"></div>

                <h3 style="color: #666; margin-top: 10px;">Relatório de Missão</h3>
                
                <div class="score-display">
                    <p class="score-label">Eficiência Tática</p>
                    <div class="score-value">{{ finalResult?.score || 0 }} pts</div>
                </div>

                <div class="stats-grid">
                    <div class="stat-item correct">
                        <span class="stat-label">Alvos Abatidos</span>
                        <span class="stat-value">{{ finalResult?.total_correct || 0 }}</span>
                    </div>
                    <div class="stat-item wrong">
                        <span class="stat-label">Baixas / Erros</span>
                        <span class="stat-value">{{ finalResult?.total_incorrect || 0 }}</span>
                    </div>
                </div>

                <button @click="goToDashboard" class="btn-dashboard">
                    Retornar à Base
                </button>
            </div>
        </div>

        <div v-else class="game-area">
            <div class="header-bar">
                <div class="timer-circle" :class="{'timer-danger': timeLeft <= 3}">
                    {{ timeLeft }}
                </div>
                
                <div class="progress-container">
                    <div class="progress-fill" :style="{ width: progressPercentage + '%' }"></div>
                </div>

                <div class="question-counter">
                    Alvo {{ currentIndex + 1 }}/{{ questions.length }}
                </div>
            </div>

            <div class="timer-bar-container">
                <div class="timer-bar-fill" :style="{ width: timerPercentage + '%' }"></div>
            </div>

            <div class="question-section">
                <div class="question-card">
                    <h2>{{ currentQuestion.question_text }}</h2>
                </div>
            </div>

            <div v-if="answered" class="feedback-banner" :class="isTimeout ? 'bg-timeout' : (answerResult ? 'bg-correct' : 'bg-wrong')">
                <h3 v-if="isTimeout">😴 Dormiu no ponto, 06! O inimigo agiu.</h3>
                <h3 v-else-if="answerResult">💀 PADRÃO! Na mosca!</h3>
                <h3 v-else>😤 BISONHO! O senhor é um fanfarrão!</h3>
            </div>

            <div class="options-grid">
                <button 
                    v-for="(option, index) in currentQuestion.options" 
                    :key="option.id"
                    @click="selectOption(option.id)"
                    class="kahoot-btn"
                    :class="getOptionClass(option, index)"
                    :disabled="answered"
                >
                    <span class="shape-icon">{{ optionStyles[index].icon }}</span>
                    <span class="option-text">{{ option.option_text }}</span>
                </button>
            </div>

            <div class="action-footer">
                <button 
                    v-if="answered"
                    @click="nextQuestion" 
                    class="btn-action btn-next"
                >
                    {{ currentIndex === questions.length - 1 ? 'Relatório Final' : 'Próximo Alvo ➔' }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

.kahoot-container {
    min-height: 100vh;
    background-color: #f2f2f2;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    flex-direction: column;
}

.rank-reveal {
    margin-bottom: 20px;
    animation: popIn 0.5s ease;
    width: 100%;
}

.professor-avatar-container {
    width: 150px;
    height: 150px;
    margin: 0 auto 15px auto;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #ccc;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    position: relative;
    background-color: #f3f4f6;
}

.professor-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease-in;
}

.professor-img.fade-in {
    opacity: 1;
}

.avatar-loader {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e5e7eb;
}

.spinner-small {
    width: 30px;
    height: 30px;
    border: 3px solid rgba(0,0,0,0.1);
    border-top-color: #111827;
    border-radius: 50%;
    animation: spin 1s infinite linear;
}

.rank-recruta { border-color: #ef4444; }     
.rank-combatente { border-color: #3b82f6; }   
.rank-bope { border-color: #eab308; box-shadow: 0 0 20px #eab308; }

.rank-title {
    font-size: 2rem;
    font-weight: 900;
    text-transform: uppercase;
    margin: 10px 0;
    color: #111827;
    word-wrap: break-word; 
}

.rank-message {
    font-style: italic;
    font-size: 1.2rem;
    color: #4b5563;
    max-width: 400px;
    margin: 0 auto;
    background: #f3f4f6;
    padding: 10px;
    border-radius: 8px;
    border-left: 4px solid #111827;
}

.game-area {
    max-width: 1000px;
    margin: 0 auto;
    width: 100%;
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.header-bar {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
}

.timer-circle {
    background: #46178f;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 800;
    box-shadow: 0 4px 0 rgba(0,0,0,0.2);
    transition: background-color 0.3s;
    flex-shrink: 0; 
}

.timer-danger {
    background: #e21b3c;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.question-counter {
    background: #333;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-weight: bold;
    white-space: nowrap; 
    font-size: 0.9rem;
}

.progress-container {
    flex: 1;
    height: 12px;
    background: #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #46178f;
    transition: width 0.3s ease;
}

.timer-bar-container {
    width: 100%;
    height: 6px;
    background: #e5e5e5;
    margin-bottom: 20px;
    border-radius: 3px;
    overflow: hidden;
}

.timer-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #46178f, #864cbf);
    transition: width 1s linear;
}

.question-section {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.question-card {
    background: white;
    width: 100%;
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 4px 0 rgba(0,0,0,0.1);
}

.question-card h2 {
    font-size: 2rem;
    color: #333;
    margin: 0;
}

.options-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 30px;
}

.kahoot-btn {
    border: none;
    padding: 30px 20px;
    font-size: 1.3rem;
    font-weight: bold;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 4px 0 rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.1s;
    position: relative;
    overflow: hidden;
    min-height: 80px; /* Altura mínima para consistência */
}

.kahoot-btn:active {
    transform: translateY(4px);
    box-shadow: none;
}

.style-0 { background-color: #e21b3c; }
.style-1 { background-color: #1368ce; }
.style-2 { background-color: #d89e00; }
.style-3 { background-color: #26890c; }

.shape-icon { font-size: 2rem; opacity: 0.5; flex-shrink: 0; }

.option-text {
    text-align: left;
    line-height: 1.2;
}

.correct {
    background-color: #26890c !important;
    opacity: 1 !important;
    transform: scale(1.02);
    box-shadow: 0 0 0 5px #333;
    z-index: 10;
}

.wrong {
    background-color: #e21b3c !important;
    opacity: 1 !important;
    transform: scale(0.98);
}

.dimmed {
    opacity: 0.3;
    cursor: not-allowed;
}

.action-footer {
    display: flex;
    justify-content: flex-end;
    height: 60px;
    align-items: center;
}

.btn-action {
    padding: 15px 40px;
    font-size: 1.2rem;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    box-shadow: 0 4px 0 rgba(0,0,0,0.2);
}

.btn-next { background-color: #1368ce; }

.feedback-banner {
    text-align: center;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    animation: fadeIn 0.3s ease;
}

.bg-correct { background-color: #26890c; }
.bg-wrong { background-color: #e21b3c; }
.bg-timeout { background-color: #555; }

.loading-screen, .result-screen {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #46178f;
    color: white;
    padding: 20px;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 5px solid rgba(255,255,255,0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 1s infinite linear;
    margin-bottom: 20px;
}

.result-card {
    background: white;
    padding: 40px;
    border-radius: 20px;
    text-align: center;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    color: #333;
    animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.trophy-icon { font-size: 4rem; margin-bottom: 10px; }
.result-card h1 { margin: 0 0 20px 0; color: #46178f; }

.score-display {
    background: #f3f4f6;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.score-label {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.score-value { font-size: 3rem; font-weight: 800; color: #10b981; }

.stats-grid { display: flex; gap: 15px; margin-bottom: 30px; }
.stat-item {
    flex: 1;
    padding: 15px;
    border-radius: 10px;
    color: white;
    display: flex;
    flex-direction: column;
}

.stat-item.correct { background: #10b981; }
.stat-item.wrong { background: #ef4444; }

.stat-label { font-size: 0.8rem; text-transform: uppercase; }
.stat-value { font-size: 1.5rem; font-weight: bold; }

.btn-dashboard {
    background: #46178f;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s;
    width: 100%;
}

.btn-dashboard:hover { transform: scale(1.05); background: #3c147a; }
.kahoot-btn:hover {
    transform: scale(1.08);
    transition: transform 0.15s ease-in-out;
    box-shadow: 0 6px 0 rgba(0,0,0,0.25);
}

.divider {
    height: 1px;
    background: #e5e7eb;
    margin: 20px 0;
    width: 100%;
}

@keyframes spin { to { transform: rotate(360deg); } }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
@keyframes popIn { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }


@media (max-width: 768px) {
    .game-area {
        padding: 10px;
    }

    .question-card h2 {
        font-size: 1.5rem;
    }
    
    .rank-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 600px) {
    
    .header-bar {
        gap: 10px;
    }
    .timer-circle {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
    .question-counter {
        font-size: 0.8rem;
        padding: 4px 10px;
    }

    .question-card {
        padding: 20px;
        min-height: 150px;
    }
    .question-card h2 {
        font-size: 1.3rem; 
    }

    .options-grid {
        grid-template-columns: 1fr; 
        gap: 10px;
        margin-bottom: 20px;
    }

    .kahoot-btn {
        padding: 15px 20px;
        font-size: 1.1rem;
        min-height: 60px;
        text-align: left;
    }
    
    .shape-icon {
        font-size: 1.5rem; 
    }

    .action-footer {
        height: auto;
        padding-bottom: 10px;
    }
    .btn-action {
        width: 100%; 
        padding: 15px;
    }

    .result-card {
        padding: 20px;
        width: 100%;
    }
    
    .professor-avatar-container {
        width: 120px;
        height: 120px;
    }
    
    .rank-message {
        font-size: 1rem;
    }
    
    .score-value {
        font-size: 2.2rem;
    }
    
    .stats-grid {
        gap: 10px;
    }
    
    .stat-item {
        padding: 10px;
    }
    
    .stat-value {
        font-size: 1.2rem;
    }
}
</style>