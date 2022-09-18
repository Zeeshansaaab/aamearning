<script setup>
defineProps(['value']);
</script>

<template>
    <label class="">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
<style>
label {
    font-family: "Montserrat", sans-serif;
    font-size: 0.75rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    font-weight: 800;
}
</style>
