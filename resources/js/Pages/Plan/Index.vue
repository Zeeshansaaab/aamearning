<template>
    <Head title="Plans"/>
<Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon icon="arrow-right"/> Plans
    </template>
    <template #breadcrumbplugin>
        <SearchInput :searchedKeyword="searchedKeywords" callType='plans'/>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0">
            <h3 class="card-title align-items-start flex-column">
                Manage Plans
            </h3>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Profit %age</th>
                            <th scope="col">Profit Bonus %age</th>
                            <th scope="col">Validity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="plan in plans.data" :key="plan.id">
                            <td data-label="Name">{{plan.name}}</td>
                            <td data-label="Price" class="font-weight-bold">{{ plan.min_price }} to {{ plan.max_price }} </td>

                            <td data-label="Profit %age">{{ plan.min_profit_percent }} % to {{ plan.max_profit_percent }} %</td>
                            <td data-label="Profit Bonus %age">{{ plan.profit_bonus_percent }} %</td>
                            <td data-label="Validity">{{ plan.validity}} Day</td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(plan.status)">{{plan.status}}</span>
                            </td>
                            <td data-label="Action">
                                <edit-section iconType="link" 
                                    permission="edit_plans"
                                    :url="route('manage-plan.edit', plan.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :meta="plans" :keyword="searchedKeywords" callType="plans" />
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
export default {
    props: ['plans' , 'searchKeyword'],
    data(){
        return {
            searchedKeywords: this.searchKeyword
        }
    },
    components: 
            { 
                Authenticated,
                EditSection, 
                Head,
                SearchInput,
                Pagination
            },
    mixins: [Helpers]
}
</script>

<style>

</style>