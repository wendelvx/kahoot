<script setup>
defineProps({
    modelValue: [String, Number],
    label: String,
    type: { type: String, default: 'text' },
    placeholder: String,
    error: String,
    required: Boolean
});
defineEmits(['update:modelValue']);
</script>

<template>
    <div class="form-group">
        <label v-if="label" class="input-label">{{ label }}</label>
        <input 
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
            :required="required"
            class="input-field"
            :class="{ 'error-input': error }"
        >
        <span v-if="error" class="error-msg">{{ error }}</span>
    </div>
</template>

<style scoped>
.form-group { margin-bottom: 20px; }
.input-label { display: block; font-weight: 600; color: #374151; margin-bottom: 8px; }
.input-field {
    width: 100%; padding: 14px 16px; border: 1px solid #e5e7eb;
    border-radius: 12px; font-size: 1rem; outline: none; transition: all 0.3s;
    box-sizing: border-box;
}
.input-field:focus { border-color: #a855f7; box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1); }
.error-input { border-color: #ef4444; }
.error-msg { color: #ef4444; font-size: 0.85rem; margin-top: 6px; display: block; }
</style>