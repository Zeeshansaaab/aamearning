<template>


<div class="row align-items-center mb-3 justify-content-between">
    <div class="col-lg-6 col-sm-6">
        <h6 class="page-title"><slot name='breadcrumb'/></h6>
    </div>
    <div class="col-lg-6 col-sm-6 text-sm-end mt-sm-0 mt-3 right-part">
        <slot name="breadcrumbplugin"/>
    </div>
</div>

</template>

<script>
export default {
    props: ['title'],
}
</script>

<style>

</style>