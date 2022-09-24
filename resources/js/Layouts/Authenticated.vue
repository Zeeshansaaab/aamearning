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
            <Breadcrumb>
                <template #breadcrumb>
                    <slot name="breadcrumb"/>
                </template>
                <template #breadcrumbplugin>
                    <slot name="breadcrumbplugin"/>
                </template>
            </Breadcrumb>
            <Banner/>
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
<script>
export default{
    mounted(){
        axios.get('/settings')
        .then(function (response) {
            localStorage.cur_text = response.data[0].value
            localStorage.cur_sym = response.data[1].value
        })
        .catch(function (error) {
            console.log(error);
        });
    }
}
</script>

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
