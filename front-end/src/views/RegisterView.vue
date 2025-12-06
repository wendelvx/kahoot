<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import http from '@/services/http';

import AuthLayout from '@/layouts/AuthLayout.vue';
import BaseInput from '@/components/BaseInput.vue';
import BaseButton from '@/components/BaseButton.vue';

const router = useRouter();
const auth = useAuthStore();

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '' 
});

const errors = ref({});
const loading = ref(false);

const handleRegister = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await http.get('/sanctum/csrf-cookie');
        await http.post('/register', form.value);
        
        const { data } = await http.get('/api/user');
        auth.user = data;
        localStorage.setItem('user_data', JSON.stringify(data));

        router.push('/dashboard');
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            alert('Falha na missão. Tente novamente.');
        }
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <AuthLayout>
        <template #title>FICHA DE ALISTAMENTO</template>
        <template #subtitle>
            Já pertence à corporação? 
            <router-link to="/login" style="color: #ca8a04; font-weight: 800; text-transform: uppercase;">
                Apresente-se
            </router-link>
        </template>

        <template #form>
            <form @submit.prevent="handleRegister">
                <BaseInput 
                    label="Nome de Guerra (Completo)" 
                    v-model="form.name" 
                    :error="errors.name?.[0]"
                    placeholder="Recruta Zero" 
                    required 
                />

                <BaseInput 
                    label="E-mail Tático" 
                    type="email"
                    v-model="form.email" 
                    :error="errors.email?.[0]"
                    placeholder="seu.email@missao.com" 
                    required 
                />

                <BaseInput 
                    label="Criar Código de Acesso" 
                    type="password"
                    v-model="form.password" 
                    :error="errors.password?.[0]"
                    placeholder="Mínimo 8 caracteres" 
                    required 
                />

                <BaseInput 
                    label="Confirmar Código" 
                    type="password"
                    v-model="form.password_confirmation" 
                    placeholder="Repita o código, 06!" 
                    required 
                />

                <BaseButton type="submit" :loading="loading">
                    SOLICITAR PERMISSÃO
                </BaseButton>
            </form>
        </template>
    </AuthLayout>
</template>