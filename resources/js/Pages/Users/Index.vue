<template>
<Head title="Manage Users"/>
<Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon icon="arrow-right"/>Manage Users
    </template>
    <template #breadcrumbplugin>
        <SearchInput :searchedKeyword="searchedKeywords" callType='users'/>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between" v-if="checkUserPermissions('create_users')">
            <h3 class="card-title align-items-center">
                Manage Users
            </h3>
            <Button @click="openModal()" class="btn-sm p-0 m-0" :smallBtn="true" ><font-awesome-icon icon="plus"/>Add new</Button>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Full name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">IP</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td data-label="Name">{{user.name}}</td>
                            <td data-label="Price" class="font-weight-bold">{{ user.username }}</td>
                            <td data-label="Price" class="font-weight-bold">{{ user.email }}</td>
                            <td data-label="Price" class="font-weight-bold">{{ user.mobile }}</td>
                            <td data-label="Price" class="font-weight-bold">{{ user.ip }}</td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(user.status)">{{ user.status }}</span>
                            </td>
                            <td data-label="Price" class="font-weight-bold">{{ formatDate(user.created_at) }}</td>
                            
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_users"
                                    iconType="link"
                                    :url="route('users.edit', [ user.id ])"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="users" :keyword="searchedKeywords" callType="users" />
    </div>      
</Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '../../Layouts/Authenticated.vue';
import EditSection from '@/Components/EditSection.vue';
import { Head } from '@inertiajs/inertia-vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Pagination from '@/Components/Pagination.vue'
import Button from '@/Components/Button.vue';
export default {
    props: ['users' , 'searchKeyword'],
    data(){
        return {
            searchedKeywords: this.searchKeyword,
            isShow: false,
        }
    },
    components: 
    {
        Authenticated,
        EditSection,
        Head,
        SearchInput,
        Pagination,
        Button
    },
    methods: {
        openModal(user = null){
            this.isShow = true;
            this.emitter.emit('user_modal', {
                title: user ? "Edit user plan" : 'Add user plan',
                user: user 
            });
        }
    },
    mixins: [Helpers]
}
</script>

<style>

</style>