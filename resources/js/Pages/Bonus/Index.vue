<template>
    <Head title="Bonus Plans"/>
<Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon class="px-1"  icon="arrow-right"/>Bonus Plans
    </template>
    <template #breadcrumbplugin>
        <SearchInput :searchedKeyword="searchedKeywords" callType='bonus_plans'/>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between" v-if="checkUserPermissions('create_administrators')">
            <h3 class="card-title align-items-center">
                Bonus Plans
            </h3>
            <Button @click="openModal()" class="btn-sm p-0 m-0" :smallBtn="true" ><font-awesome-icon icon="plus"/>Add new</Button>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bonus in bonuses.data" :key="bonus.id">
                            <td data-label="Name">{{bonus.name}}</td>
                            <td data-label="Price" class="font-weight-bold">{{ bonus.amount }}</td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(bonus.status)">{{ getStatusWithBoolean(bonus.status) }}</span>
                            </td>
                            <td data-label="Price" class="font-weight-bold">{{ formatDate(bonus.created_at) }}</td>
                            
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_administrators"
                                    @click="openModal(bonus)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="bonuses" :keyword="searchedKeywords" callType="bonus_plan" />
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
    props: ['bonuses' , 'searchKeyword'],
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
        openModal(bonus = null){
            this.isShow = true;
            this.emitter.emit('bonus_modal', {
                title: bonus ? "Edit Bonus plan" : 'Add Bonus plan',
                bonus_plan: bonus 
            });
        }
    },
    mixins: [Helpers]
}
</script>

<style>

</style>