<template>
<div class="modal fade" :id="id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{title}}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" @click="close">
                <font-awesome-icon icon="times"/>
            </button>
            </div>
            <slot/>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['id', 'title'],
    methods: {
        clickOverlay() {
            this.close()
        },
        close() {
            $('#'+this.id).modal('hide')
        },
    },
}
</script>

<style>

</style>