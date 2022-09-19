<template>
    <Head title="Manual Gateways"/>
<Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon class="px-1"  icon="arrow-right"/> Manual Gateways
    </template>
    <template #breadcrumbplugin>
        <SearchInput :searchedKeyword="searchedKeywords" callType='bonus_plans'/>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between" v-if="checkUserPermissions('create_administrators')">
            <h3 class="card-title align-items-center">
                Manual Gateways
            </h3>
            <Button @click="openModal()" class="btn-sm p-0 m-0" :smallBtn="true" ><font-awesome-icon icon="plus"/>Add new</Button>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Gateway</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="gateway in gateways.data" :key="gateway.id">
                            <td data-label="Name">
                                <div class="user">
                                    <div class="thumb">
                                        <img v-lazy="getImage(gateway.media.path, false, 'thumb', true)" alt="image"></div>
                                    <span class="name">{{gateway.name}}</span>
                                </div>
                            </td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(gateway.status)">{{ getStatusWithBoolean(gateway.status) }}</span>
                            </td>
                            <td data-label="Price" class="font-weight-bold">{{ formatDate(gateway.created_at) }}</td>
                            
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_manual_gateway"
                                    @click="openModal(gateway)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="gateways" :keyword="searchedKeywords" callType="gateway" />
    </div>      
    <BonusPlan title="Add Modal"/>
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
import BonusPlan from './BonusModal.vue';
export default {
    props: ['gateways' , 'searchKeyword'],
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
        BonusPlan
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