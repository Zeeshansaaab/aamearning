<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    smallBtn: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button :type="type" class="px-4 py-2 border border-transparent font-semibold text-light uppercase " 
        :style=" smallBtn ? 'background: rgb(21 10 134); height: 38px; width: 133px; margin: auto;' : ''">
        <slot />
    </button>
</template>
