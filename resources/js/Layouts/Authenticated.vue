<script setup>
import Footer from '../Components/Footer.vue';
import Sidebar from '../Components/Sidebar.vue';
import Navbar from '../Components/Navbar.vue';
import Banner from '@/Components/Banner.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
</script>

<template>
 <div class="page-wrapper default-version">
    <Sidebar/>
    <Navbar/>
    <div class="body-wrapper">
        <div class="bodywrapper__inner">
            <Banner/>
            <Breadcrumb>
                <template #breadcrumb>
                    <slot name="breadcrumb"/>
                </template>
                <template #breadcrumbplugin>
                    <slot name="breadcrumbplugin"/>
                </template>
            </Breadcrumb>
            <div class="row mb-none-30">
                <div class="col-lg-12 col-md-12 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <slot/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
</div>
</template>
<style>
.dropdown-menu{
    position: relative!important;
    transform: none!important;
    top: inherit!important;
}
.indicator-label{
    color: white!important;
}
.m-toggle__content{
    max-width: 45px;
    max-height: 24px;
}
</style>
