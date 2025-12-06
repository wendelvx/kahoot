<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import AuthLayout from '@/layouts/AuthLayout.vue';
import BaseInput from '@/components/BaseInput.vue';
import BaseButton from '@/components/BaseButton.vue';

const router = useRouter();
const auth = useAuthStore();
const form = ref({ email: '', password: '' });
const errors = ref({});
const loading = ref(false);

const handleLogin = async () => {
    loading.value = true;
    errors.value = {}; 
    try {
        await auth.login(form.value.email, form.value.password);
        router.push('/dashboard'); 
    } catch (validationErrors) {
        errors.value = validationErrors;
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <AuthLayout>
        <template #title>IDENTIFICAÇÃO</template>
        <template #subtitle>
            Ainda é paisano? 
            <router-link to="/register" style="color: #ca8a04; font-weight: 800; text-transform: uppercase;">
                Aliste-se agora, 06!
            </router-link>
        </template>

        <template #form>
            <form @submit.prevent="handleLogin">
                <BaseInput 
                    label="E-mail Operacional" 
                    type="email" 
                    v-model="form.email" 
                    :error="errors.email?.[0]"
                    placeholder="operador@bope.com" 
                    required 
                />
                
                <BaseInput 
                    label="Código de Acesso" 
                    type="password" 
                    v-model="form.password" 
                    :error="errors.password?.[0]"
                    placeholder="Senha do Protocolo" 
                    required 
                />

                <BaseButton type="submit" :loading="loading">
                    ACESSAR O Q.G.
                </BaseButton>
            </form>
        </template>
    </AuthLayout>
</template>