<script setup>
defineProps({
    loading: Boolean,
    disabled: Boolean
});
</script>

<template>
    <button :disabled="loading || disabled" class="base-btn">
        <span v-if="loading" class="spinner-small"></span>
        <slot v-else></slot>
    </button>
</template>

<style scoped>
.base-btn {
    width: 100%; padding: 14px;
    background: linear-gradient(90deg, #a855f7 0%, #9333ea 100%);
    color: white; border: none; border-radius: 12px;
    font-weight: 700; font-size: 1.1rem; cursor: pointer;
    transition: opacity 0.2s, transform 0.1s;
    display: flex; justify-content: center; align-items: center; gap: 10px;
}
.base-btn:active { transform: scale(0.98); }
.base-btn:disabled { background: #d8b4fe; cursor: not-allowed; }

.spinner-small {
    width: 20px; height: 20px; border: 3px solid rgba(255,255,255,0.3);
    border-top-color: white; border-radius: 50%; animation: spin 1s infinite linear;
}
@keyframes spin { to { transform: rotate(360deg); } }
</style>