<template>
    <Head title="Plans"/>
<Authenticated> 
    <template #breadcrumb>
        Admin <font-awesome-icon class="px-1"  icon="arrow-right"/> Plans
    </template>
    <template #breadcrumbplugin>
        <SearchInput :searchedKeyword="searchedKeywords" callType='plans'/>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between">
            <h3 class="card-title align-items-center">
                Manage Plans
            </h3>
            <Button @click="openModal()" class="btn-sm p-0 m-0" :smallBtn="true" ><font-awesome-icon icon="plus"/>Add new</Button>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Daily limit</th>
                            <th scope="col">User ref</th>
                            <th scope="col">Validity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="plan in plans.data" :key="plan.id">
                            <td data-label="Name">{{plan.name}}</td>
                            <td data-label="Price" class="font-weight-bold">{{ plan.price }}</td>
                            <td data-label="user_ref">{{ plan.daily_limit }}</td>
                            <td data-label="user_ref">{{ plan.user_ref }}</td>
                            <td data-label="Validity">{{ plan.validity}} Day</td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(plan.status)">{{ getStatusWithBoolean(plan.status) }}</span>
                            </td>
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_plans"
                                    @click="openModal(plan)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="plans" :keyword="searchedKeywords" callType="plans" />
    </div>      
    <PlanModal title="Add Modal"/>
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
import PlanModal from './PlanModal.vue';
export default {
    props: ['plans' , 'searchKeyword'],
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
        Button,
        PlanModal
    },
    methods: {
        openModal(plan = null){
            this.isShow = true;
            this.emitter.emit('plan_modal', {
                title: plan ? "Edit Subscription plan" : 'Add Subscription plan',
                plan: plan 
            });
        }
    },
    mixins: [Helpers]
}
</script>

<style>

</style>