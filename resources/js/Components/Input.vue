<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <input class="border-black-400 border-2 focus:border-indigo-900 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
