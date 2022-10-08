<template>
    <Head :title="`${user.name} Edit User`"/>
    <Authenticated>
        <template #breadcrumb>
            Admin <font-awesome-icon icon="arrow-right"/>Edit Users
        </template>
        <div class="card">
            <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between" v-if="checkUserPermissions('create_users')">
                <h3 class="card-title align-items-center">
                    Edit Users
                </h3>
                <Button @click="openModal()" class="btn-sm p-0 m-0" :smallBtn="true" ><font-awesome-icon icon="plus"/>Add new</Button>
            </div>
            <div class="card-body py-1">
                <div class="row mb-none-30">
                    <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
                        <div class="card b-radius--10 overflow-hidden box--shadow1">
                            <div class="card-body p-0">
                                <div class="p-3 bg--white">
                                    <div class="">
                                        <img :src="getImage(user.media?.path)" alt="profile-image"
                                            class="b-radius--10 w-100">
                                    </div>
                                    <div class="mt-15">
                                        <h4 class="">{{ user.fullname }}</h4>
                                        <span class="text--small">Joined At <strong>
                                            {{ user.created_at }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
import { Head } from '@inertiajs/inertia-vue3';
import Button from '@/Components/Button.vue';
import Authenticated from '../../Layouts/Authenticated.vue';
export default {
    props: ['user'],
    components: { Authenticated, Button, Head },
    mixins: [Helpers]
}
</script>
