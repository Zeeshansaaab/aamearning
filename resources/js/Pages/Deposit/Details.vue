<template>
    <Head title="Details"/>
<Authenticated> 
    <template #breadcrumb>
        Admin <font-awesome-icon class="px-1"  icon="arrow-right"/> Deposits
    </template>
    <div class="card">
        <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between">
            <h3 class="card-title align-items-center">
                Manage Deposits
            </h3>
        </div>
    </div>
    <div class="row mb-none-30">
        <div class="col-lg-4 col-md-4 mb-30">
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body px-3">
                    <h5 class="mb-20 text-muted">Deposit Via {{deposit.gateway.name}}</h5>

                    <div class="p-3 bg--white">
                        <div class="">
                            <img v-lazy="getImage(deposit.gateway.single_currency.media.path)" alt="profile-image"
                                 class="b-radius--10 depo-img" >
                        </div>
                    </div>

                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Date
                            <span class="font-weight-bold">{{ formatDate(deposit.created_at) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Trx Number
                            <span class="font-weight-bold">{{ deposit.trx }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Username
                            <span class="font-weight-bold">
                                <Link href="a">{{ deposit.user.username }}</Link>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Method
                            <span class="font-weight-bold">{{ deposit.gateway.name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Amount
                            <span
                                class="font-weight-bold">{{ getAmount(deposit.amount ) }} {{ cur_text }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Charge
                            <span
                                class="font-weight-bold">{{ getAmount(deposit.charge ) }} {{ cur_text }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            After Charge
                            <span
                                class="font-weight-bold">{{ getAmount(deposit.amount + deposit.charge ) }} {{ cur_text }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Rate
                            <span class="font-weight-bold">1 {{ cur_text }}
                                = {{ getAmount( deposit.rate ) }} {{ deposit.method_currency }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Payable
                            <span
                                class="font-weight-bold">{{ getAmount(deposit.final_amount ) }} {{ deposit.method_currency }}</span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status
                            <span class="badge badge-pill bg--warning" :class="getStatusForTable(deposit.status)">{{ getStatusWithBoolean(deposit.status) }}</span>
                        </li>
                        <li class="list-group-item" v-if="deposit.admin_feedback">
                            <strong>Admin Response</strong>
                            <br>
                            <p>{{ deposit.admin_feedback }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 mb-30">
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body px-3">
                    <h5 class="card-title mb-50 border-bottom pb-2">User Deposit Information</h5>
                    <div v-if="deposit.details">
                        <div class="row mt-4" v-for="(index, value) in JSON.parse(deposit.details)" :key="index">
                            <div class="col-md-8" v-if="value.type == 'file'">
                                <h6>{{inputTitle($k)}}</h6>
                                <img src="{{getImage('assets/images/verify/deposit/'.$val->field_name)}}" alt=".." >
                            </div>
                            <div class="col-md-12" v-else>
                                <h6>{{ index }}</h6>
                                <p>{{ value.field_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" v-if="deposit.status == '1'">
                        <div class="col-md-12">
                            <Button class="btn btn--success ml-1 approveBtn" @click="changeStatus(deposit.id, 'active')"
                                    data-toggle="tooltip" data-original-title="Approve"><i class="fas fa-check"></i> Approve
                            </Button>
                            <Button class="btn btn--danger ml-1 rejectBtn" @click="changeStatus(deposit.id, 'inactive')"
                                    data-toggle="tooltip" data-original-title="Reject "><i class="fas fa-ban"></i> Reject
                            </Button>
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
import Authenticated from '../../Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Button from '@/Components/Button.vue';
export default {
    props: ['deposit'],
    data(){
        return {
            cur_text: localStorage.getItem('cur_text')
        }
    },
    methods: {
        changeStatus(id, status){
            swal.fire({
                title: 'Do you want to '+ status + ' the status?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    showWaitDialog()
                    this.$inertia.visit(route('deposit.status', [id, status]));
                } else if (result.isDenied) {
                    swal.fire('Changes are not saved', '', 'info')
                }
                })
            
        }
    },
    components: { Authenticated, Head, Link, Button },
    mixins: [Helpers]

}
</script>
