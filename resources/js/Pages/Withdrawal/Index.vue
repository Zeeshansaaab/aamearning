<template>
<Head title="Deposits"/>
<Authenticated> 
    <template #breadcrumb>
        Admin <font-awesome-icon class="px-1"  icon="arrow-right"/> Deposits
    </template>
    <template #breadcrumbplugin>
        <div class="d-flex ">
            <select @change="filters" v-model="status" class="mx-2">
                <option :value="null">All</option>
                <option value="pending">Pending</option>
                <option value="active">Approved</option>
                <option value="inactive">Rejected</option>
            </select>
            <SearchInput  class="mx-2" :searchedKeyword="searchedKeywords" callType='deposit' :status="status"/>
        </div>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between">
            <h3 class="card-title align-items-center">
                Manage Deposits
            </h3>
            <Button @click="openModal()" class="btn-sm p-0 m-0" :smallBtn="true" ><font-awesome-icon icon="plus"/>Add new</Button>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Trx Number</th>
                            <th scope="col">Username</th>
                            <th scope="col">Method</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Charge</th>
                            <th scope="col">After Charge</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Payable</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="deposit in deposits.data" :key="deposit.id">
                            <td data-label="Name">{{ formatDate(deposit.created_at) }}</td>
                            <td data-label="Trx" class="font-weight-bold">{{ deposit.trx }}</td>
                            <td data-label="username">{{ deposit.user.username }}</td>
                            <td data-label="method">{{ deposit.gateway.name }}</td>
                            <td data-label="Amount">{{ deposit.amount }}</td>
                            <td data-label="charge">{{ deposit.charge }}</td>
                            <td data-label="after charge">{{ deposit.amount + deposit.charge }}</td>
                            <td data-label="Rate">{{ deposit.rate }} {{ deposit.method_currency }}</td>
                            <td data-label="Payable">{{ deposit.final_amount }}</td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(deposit.status)">{{ getStatusWithBoolean(deposit.status) }}</span>
                            </td>
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_deposit"
                                    iconType="link"
                                    :url="route('deposit.show', [deposit.id])"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="deposits" :keyword="searchedKeywords" callType="deposits" />
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
    props: ['deposits' , 'searchKeyword', 'filterStatus'],
    data(){
        return {
            searchedKeywords: this.searchKeyword,
            isShow: false,
            status: this.filterStatus,
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
        filters(){
            this.$inertia.get(route('deposit.index', 'withdrawal'), {
                status:  this.status,
                keyword: this.keyword
            })
        }
    },
    mounted(){
    },
    mixins: [Helpers]
}
</script>

<style>

</style>