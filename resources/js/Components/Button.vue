<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="px-4 py-2 bg-info border border-transparent rounded font-semibold text-light uppercase">
        <slot />
    </button>
</template>
