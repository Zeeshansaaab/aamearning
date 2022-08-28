<template>
  <Authenticated>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                <!--begin::Col-->
                <div class="col-md-4" v-for="role in rolesList" :key="role.id">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100 border">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h4 class="text-capitalize text-warning">{{ role.name }}</h4>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::Users-->
                            <div class="fw-bolder text-gray-600 mb-5">
                                Total users with this role:  {{role.users.length}}
                            </div>
                            <!--end::Users-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-2">
                            <Link v-if="checkUserPermissions('edit_roles')"
                                :href="route('roles.edit', role.id)"
                                class="btn btn-sm btn-outline-primary">
                            Edit Role
                            </Link>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
  </Authenticated>
</template>

<script setup>

    import { Head, Link } from "@inertiajs/inertia-vue3";
    import Authenticated from '@/Layouts/Authenticated.vue';
    import Helpers from '@/Mixins/Helpers';
</script>
<script>
export default {
    props: ['rolesList'],
    mixins: [Helpers]
}
</script>

<style>

</style>