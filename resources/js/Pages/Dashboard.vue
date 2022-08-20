<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Sidebar from '@/Components/Sidebar.vue';
import Helpers from '@/Mixins/Helpers';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
       
        
    </BreezeAuthenticatedLayout>
</template>
<script>
export default {
    mixins: [Helpers]
}
</script>

