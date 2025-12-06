<script setup>
import { ref } from 'vue';

const imageReady = ref(false);

const onImageLoad = () => {
    imageReady.value = true;
};
</script>

<template>
    <div class="auth-page">
        <div class="left-column">
            
            <div class="avatar-container">
                
                <div v-if="!imageReady" class="avatar-loader">
                    <div class="spinner-small"></div>
                </div>

                <img 
                    src="@/assets/professor-bope.png" 
                    alt="Capitão do Código" 
                    class="bope-avatar" 
                    :class="{ 'fade-in': imageReady }"
                    @load="onImageLoad"
                    v-show="imageReady"
                />
            </div>

            <div class="brand">
                <h1 class="brand-name">Caehoot</h1>
                <span class="badge-bope">TACTICAL QUIZ</span>
            </div>
            
            <div class="brand-slogan">
                <p>"Missão dada é missão codada. O bug pede pra sair!"</p>
            </div>
        </div>
        
        <div class="right-column">
            <div class="auth-container">
                <div class="auth-header">
                    <h2 class="welcome-title"><slot name="title"></slot></h2>
                    <p class="subtitle"><slot name="subtitle"></slot></p>
                </div>
                
                <slot name="form"></slot>
                
                <div class="auth-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.auth-page { 
    min-height: 100vh; 
    display: flex; 
    font-family: 'Segoe UI', sans-serif; 
}

.left-column {
    flex: 1; 
    background: linear-gradient(135deg, #1a1a1a 0%, #2e1065 100%);
    display: flex; 
    flex-direction: column; 
    align-items: center; 
    justify-content: center;
    color: white; 
    padding: 40px;
}


.avatar-container {
    
    width: 180px;
    height: 180px;
    margin-bottom: 20px;
    position: relative;
    border-radius: 50%;
    overflow: hidden; 
    
    border: 4px solid #fff;
    box-shadow: 0 0 20px rgba(0,0,0,0.5);
    background-color: #333; 
    transition: all 0.3s ease;
}

/* Centraliza o Spinner */
.avatar-loader {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #222; 
}

.spinner-small {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(255,255,255,0.1);
    border-top-color: #facc15; /* Amarelo BOPE */
    border-radius: 50%;
    animation: spin 1s infinite linear;
}

.bope-avatar {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0; 
    transition: opacity 0.5s ease-in;
}

.bope-avatar.fade-in {
    opacity: 1; 
}


.brand { 
    display: flex; 
    flex-direction: column; 
    align-items: center; 
    gap: 5px; 
}

.brand-name { 
    font-size: 3.5rem; 
    font-weight: 900; 
    margin: 0; 
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 2px 2px 0px #000;
}

.badge-bope {
    background-color: #000;
    color: #facc15;
    padding: 5px 10px;
    font-weight: bold;
    font-size: 0.8rem;
    border-radius: 4px;
    letter-spacing: 3px;
}

.brand-slogan {
    margin-top: 20px;
    text-align: center;
}

.brand-slogan p {
    font-size: 1.5rem;
    font-weight: 600;
    font-style: italic;
    max-width: 400px;
    line-height: 1.3;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
}

.right-column {
    flex: 1; 
    display: flex; 
    align-items: center; 
    justify-content: center;
    padding: 20px; 
    background-color: #f3f4f6;
    background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
    background-size: 20px 20px;
}

.auth-container {
    width: 100%; 
    max-width: 450px; 
    background: white; 
    padding: 40px;
    border-radius: 20px; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e5e7eb;
}

.welcome-title { 
    font-size: 2rem; 
    color: #1f2937; 
    margin: 0 0 10px 0; 
    text-align: center; 
    font-weight: 800; 
}
.subtitle { text-align: center; color: #6b7280; margin-bottom: 30px; }

@keyframes spin { to { transform: rotate(360deg); } }

@media (max-width: 900px) {
    .auth-page { 
        flex-direction: column; 
    }

    .left-column { 
        display: flex; 
        padding: 30px 20px; 
        flex: 0; 
    }

    .avatar-container {
        width: 100px;
        height: 100px;
        border-width: 2px;
    }

    .brand-name {
        font-size: 2rem;
    }

    .brand-slogan p {
        font-size: 1rem;
        max-width: 100%;
    }

    .right-column {
        padding: 20px;
        background: white; 
    }

    .auth-container { 
        box-shadow: none; 
        padding: 0; 
        border: none; 
        width: 100%;
    }
}
</style>