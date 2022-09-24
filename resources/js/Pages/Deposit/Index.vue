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
            <Link :href="route('manual-gateway.create')" class="btn px-3 pt-2 btn-sm p-0 m-0 rounded">
                <font-awesome-icon icon="plus"/>Add new
            </Link>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Gateway</th>
                            <th scope="col">Created at</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="gateway in gateways.data" :key="gateway.id">
                            <td data-label="Name">
                                <div class="user">
                                    <div class="thumb">
                                        <img v-lazy="getImage(gateway.media?.path, false, 'thumb', gateway.media?.is_external)" alt="image"></div>
                                        <span class="name">{{gateway.name}}</span>
                                </div>
                            </td>
                            <td data-label="Price" class="font-weight-bold">{{ formatDate(gateway.created_at) }}</td>
                            
                            <td data-label="Action">
                                <div class="d-flex" style="width: 50px; margin-right: -100px;">
                                    <vue-toggle
                                        title="" 
                                        name="" 
                                        :toggled="booleanStatusValue(gateway.status)"
                                        @toggle="toggle($event, gateway.id)"
                                    />
                                    <edit-section
                                        permission="edit_manual_gateway"
                                        iconType="link"
                                        :url="route('manual-gateway.edit', [gateway.id])"/>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="gateways" :keyword="searchedKeywords" callType="gateway" />
    </div>      
</Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '../../Layouts/Authenticated.vue';
import EditSection from '@/Components/EditSection.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Pagination from '@/Components/Pagination.vue'
import Button from '@/Components/Button.vue';
import VueToggle from 'vue-toggle-component';
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
        Link,
        VueToggle,
    },
    methods: {
        openModal(bonus = null){
            this.isShow = true;
            this.emitter.emit('bonus_modal', {
                title: bonus ? "Edit Bonus plan" : 'Add Bonus plan',
                bonus_plan: bonus 
            });
        },
        toggle(e, id){
            this.$inertia.visit(route('manual-gateway.status', [id]));
        }
    },
    mixins: [Helpers]
}
</script>

<style>

</style>