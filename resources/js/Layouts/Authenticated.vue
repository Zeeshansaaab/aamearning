<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Helpers from '@/Mixins/Helpers';
import { Link } from '@inertiajs/inertia-vue3';
import Footer from '../Components/Footer.vue';
import Sidebar from '../Components/Sidebar.vue';
import Navbar from '../Components/Navbar.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>

<div class="container-scroller">
    <Sidebar/>
    <!-- Page Heading -->
    <!-- <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <slot name="header" />
        </div>
    </header> -->

    <!-- Page Content -->
    <div class="container-fluid page-body-wrapper">
        <Navbar/>
        <div class="main-panel">
            <div class="content-wrapper pb-0">
                <div class="page-header flex-wrap">
                        <h3 class="mb-0"> Hi, welcome back! 
                            <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Your web analytics dashboard template.</span>
                        </h3>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                            <i class="mdi mdi-email btn-icon-prepend"></i> Email </button>
                        <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                            <i class="mdi mdi-printer btn-icon-prepend"></i> Print </button>
                        <button type="button" class="btn btn-sm ml-3 btn-success"> Add User </button>
                    </div>
                </div>
                <slot />
            </div>
            <Footer/>
        </div>
    </div>
</div>
</template>