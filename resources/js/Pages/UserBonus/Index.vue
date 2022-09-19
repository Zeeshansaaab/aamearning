<template>
    <Head title="User Bonus"/>
<Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon class="px-1"  icon="arrow-right"/>User Bonus
    </template>
    <template #breadcrumbplugin>
        <div class="d-flex">
            <select @change="filters" v-model="status" class="mx-2">
                <option :value="null">All</option>
                <option value="pending">Pending</option>
                <option value="active">Approved</option>
                <option value="inactive">Rejected</option>
            </select>
            <SearchInput  class="mx-2" :searchedKeyword="searchedKeywords" callType='user_bonus' :status="filterStatus"/>
        </div>
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between" v-if="checkUserPermissions('create_user_bonus')">
            <h3 class="card-title align-items-center">
                User Bonuses
            </h3>
            <div>
                <Button @click="processAll('active')" :disabled="disableAll" class="btn-sm btn-success p-0 m-0" :smallBtn="true" v-if="selected.length > 0" style="background: green!important;">
                    <font-awesome-icon class="pr-1" icon="check" />Approve</Button>
                <Button @click="processAll('inactive')" :disabled="disableAll" class="btn-sm btn-danger p-0 m-0 " :smallBtn="true" v-if="selected.length > 0" style="background: red!important;">
                    <font-awesome-icon class="pr-1" icon="fa-times" />Inactive
                </Button>
            </div>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive--sm table-responsive" v-if="userBonuses.data.length > 0">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">
                                <label class="text-light">
                                    <input class="form-check-input ml-3" type="checkbox"  v-model="selectAll" @click="selectAllItems" >
                                </label>
                            </th>
                            <th scope="col">Username</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bonus in userBonuses.data" :key="bonus.id">
                            <td class="px-4 w-30">
                                <label > 
                                    <input  type="checkbox" class="form-check-input ml-3"  v-bind:value="bonus.id" v-model="selected">
                                </label>
                            </td>
                            <td data-label="Name">{{bonus.user.username}}</td>
                            <td data-label="Price" class="font-weight-bold">{{ bonus.user.plan.name }}</td>
                            <td data-label="Price" class="font-weight-bold">{{ bonus.bonusplan.amount }}</td>
                            <td data-label="Status">
                                <span class="badge" :class="getStatusForTable(bonus.status)">{{ bonus.status }}</span>
                            </td>
                            <td data-label="Price" class="font-weight-bold">{{ formatDate(bonus.created_at) }}</td>
                            
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_user_bonus"
                                    @click="openModal(bonus)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else> No Records to show</p>
        </div>
        <pagination :meta="userBonuses" :keyword="searchedKeywords" callType="user_bonuses" />
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
    props: ['userBonuses', 'searchKeyword', 'filterStatus'],
    data(){
        return {
            searchedKeywords: this.searchKeyword,
            isShow: false,
            selected: [],
            selectAll: false,
            status: 'pending',
            disableAll: false,
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
        },
        selectAllItems(){
            this.selected = []
            if (!this.selectAll) {
                for (let i in this.userBonuses.data) {
                    this.selected.push(this.userBonuses.data[i].id)
                }
            }
        },
        processAll(status){
            this.disableAll = true
            this.$inertia.post(route('user-bonus.changeAll'), {
                    selected: this.selected,
                    status: status
                },{
                    onSuccess: () => { this.disableAll = false }
                })
        },
        filters(){
            this.$inertia.get(route('user-bonus.index'), {
                status:  this.status,
                keyword: this.keyword
            })
        }
    },
    mounted(){
        this.status = this.filterStatus
    },
    mixins: [Helpers]
}
</script>

<style>

</style>