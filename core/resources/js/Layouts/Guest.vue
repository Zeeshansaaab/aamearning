<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-700">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <Link href="/" class="inline-flex justify-center w-full" width="200px">
                <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
            <slot />
        </div>
    </div>
</template>
