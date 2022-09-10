<template>
    <div class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
        @click="onDelete"
        v-if="checkUserPermissions(permission)"
        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="delete">
        <span class="svg-icon svg-icon-3">
            <font-awesome-icon icon="trash"/>
        </span>
    </div>
</template>

<script>
    import Helpers from '@/Mixins/Helpers'

    export default {
        props: ['url', 'permission'],
        methods: {
            onDelete () {
                this.swal.fire({
                    title: "",
                    html: "<h1 class='text-lg text-gray-800 mb-1'>Delete Record</h1><p class='text-base'>Are you sure want to delete this record?</p>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Delete Record",
                    customClass: {
                    confirmButton: 'danger'
                    }
                }).then((result) => {
                    if (result.value) {
                        showWaitDialog()
                        this.$inertia.delete(this.url, {
                            preserveScroll: false,
                            onSuccess: () => hideWaitDialog()
                        })
                    }
                })
            }
        },

        mixins: [Helpers]
    }
</script>