<template>
    
<Modal id="planModal" :title="name">
    <form @submit.prevent="submit" v-if="form">
        <div class="modal-body">
            <div class="form-group">
                <Label for="name" class="required">Name </Label>
                <Input :class="{ 'border border-danger' : form.errors.name }" type="text" v-model="form.name" placeholder="Plan Name" required=""/>
                <error :message="form.errors.name" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">Price </Label>
                <Input :class="{ 'border border-danger' : form.errors.price }" type="text" v-model="form.price" placeholder="Price" required=""/>
                <error :message="form.errors.price" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">User ref </Label>
                <Input :class="{ 'border border-danger' : form.errors.user_ref }" type="text" v-model="form.user_ref" placeholder="User ref" required=""/>
                <error :message="form.errors.user_ref" />
            </div>
     
            <div class="form-group">
                <Label for="profit_bonus_percent" class="required">Daily Ad limit</Label>
                <input :class="{ 'border border-danger' : form.errors.daily_limit }" type="text" class="form-control has-append" v-model="form.daily_limit" name="daily_limit" placeholder="Daily limit" id="daily_limit">
                <error :message="form.errors.daily_limit" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">Validity :</Label>
                <div class="input-group">
                    <input type="number" :class="{ 'border border-danger' : form.errors.validity }" class="form-control" v-model="form.validity" name="validity" placeholder="Validity" id="validity">
                </div>
                <error :message="form.errors.validity" />
            </div>
            <div class="form-group">
                <Label for="subscriber_daily_limit" class="required">Subscriber daily limit :</Label>
                <div class="input-group">
                    <input type="text" class="form-control has-append" v-model="form.channel_subscribe_dl" name="subscriber_daily_limit" placeholder="Maximum Profit %age of Plan" required="" id="max_profit_percent">
                </div>
            </div>
            <div class="form-group">
                <Label for="name" class="required">PTC per click ref status: ?</Label>
                <input class="form-check-input" :class="`btn ${form.ptc_per_click_ref_status ? 'btn-outlinine-success' : 'btn-outlinine-danger'}`" type="checkbox" value=""
                    :checked="form.ptc_per_click_ref_status" v-model="form.ptc_per_click_ref_status" id="ptc_per_click_ref_status" autocomplete="off"/>
            </div>
            
            <div class="form-group" v-if="form.ptc_per_click_ref_status">
                <Label for="name" class="required">PTC Rate</Label>
                <Input type="text" v-model="form.ptc_rate" placeholder="PTC Rate" />
                <error :message="form.errors.ptc_rate" />
            </div>
            <div class="form-group" v-if="form.ptc_per_click_ref_status">
                <Label for="name" class="required">Ptc Per Click Referral Price</Label>
                <Input type="text" v-model="form.ptc_per_click_ref" placeholder="Ptc Per Click Referral Price" required=""/>
                <error :message="form.errors.ptc_per_click_ref" />
            </div>
            <div class="form-group" v-if="form.ptc_per_click_ref_status">
                <Label for="name" class="required">Ptc Referral daily limit</Label>
                <Input type="text" v-model="form.ptc_per_click_ref_daily_limit" placeholder="Ptc Referral daily limit" required=""/>
                <error :message="form.errors.ptc_per_click_ref_daily_limit" />
            </div>
        
            <div class="form-group">
                <Label for="name" class="required">Sharelink Referral Status: ?</Label>
                <input class="form-check-input" :class="`btn ${form.sl_per_click_ref_status ? 'btn-outlinine-success' : 'btn-outlinine-danger'}`" type="checkbox" value=""
                    :checked="form.sl_per_click_ref_status" v-model="form.sl_per_click_ref_status" id="ptc_per_click_ref_status" autocomplete="off"/>
            </div>

            <div class="form-group" v-if="form.sl_per_click_ref_status">
                <Label for="name" class="required">Share link per click ref</Label>
                <Input type="text" v-model="form.sl_per_click_ref" placeholder="Share link per click ref" required=""/>
                <error :message="form.errors.sl_per_click_ref" />
            </div>
            <div class="form-group" v-if="form.sl_per_click_ref_status">
                <Label for="name" class="required">Share link ref daily limit</Label>
                <Input type="text" v-model="form.sl_per_click_ref_daily_limit" placeholder="Share link ref daily limit" required=""/>
                <error :message="form.errors.sl_per_click_ref_daily_limit" />
            </div>

            <div class="form-group">
                <Label for="name" class="required">Task per click ref status</Label>
                <input type="checkbox" v-model="form.task_per_click_ref_status" id="ptc_per_click_ref_status" autocomplete="off"/>
            </div>
            
            <div class="form-group" v-if="form.task_per_click_ref_status">
                <Label for="name" class="required">Task per click referral</Label>
                <Input type="text" v-model="form.task_per_click_ref" placeholder="Task per click referral" required=""/>
                <error :message="form.errors.task_per_click_ref" />
            </div>
            <div class="form-group" v-if="form.task_per_click_ref_status">
                <Label for="name" class="required">Task referral daily limit</Label>
                <Input type="text" v-model="form.task_per_click_ref_daily_limit" placeholder="Task referral daily limit" required=""/>
                <error :message="form.errors.task_per_click_ref_daily_limit" />
            </div>

            <div class="form-group">
                <Label for="status" class="required">Status: ?</Label>
                <input class="form-check-input" type="checkbox" value="" :checked="form.status" v-model="form.status" id="status" autocomplete="off"/>
            </div>

        </div>
        
        <div class="modal-footer">
            <Button type="submit" class="w-100 d-flex align-items-center justify-content-center p-2 btn-primary rounded " :class="{ 'opacity-25 disabled': form.processing }" :disabled="form.processing"  btnWidth="w-28 ml-auto">
                <span class="ml-2 text-light">{{ this.form.id ? "Update" : "Create" }}</span>
                <span class="spinner-border text-dark ml-4" style="height: 20px; width: 20px;" v-if="form.processing">
                    <span class="sr-only">Loading...</span>
                </span>
            </Button>
        </div>
    </form>
</Modal>            

</template>

<script>
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import Error from '@/Components/InputError.vue';
import Button from '@/Components/Button.vue'
import StatusCheckbox from '@/Components/StatusCheckbox.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Helpers from '@/Mixins/Helpers';
export default {
    components: { Modal, Label, Input, Error, StatusCheckbox, Checkbox, Button },
    props: ['title'],
    data(){
        return {
            name: this.title,
            plan: null,
            form: null,
        }
    },
    methods: {
        submit(){
            this.form.post(route('manage-plan.store'), {
                errorBag: "product",
                preserveScroll: true,
                onSuccess: () => { $('#planModal').modal('hide'); }
            });
        }
    }, 
    beforeMount(){
        this.emitter.on('plan_modal', (args)=>{
            this.name = args ? args.title : '',
            this.form = useForm({
                id: args.plan ? args.plan.id : null, 
                name: args.plan ? args.plan.name : null, 
                user_ref: args.plan ? args.plan.user_ref : 0, 
                daily_limit: args.plan ? args.plan.daily_limit : 0, 
                price: args.plan ? args.plan.price : null, 
                ptc_rate: args.plan ? args.plan.ptc_rate : 0, 
                ptc_per_click_ref: args.plan ? args.plan.ptc_per_click_ref : 0, 
                ptc_per_click_ref_daily_limit: args.plan ? args.plan.ptc_per_click_ref_daily_limit : 0, 
                ptc_per_click_ref_status: args.plan ? this.booleanStatusValue(args.plan.ptc_per_click_ref_status) : 0, 
                sl_per_click_ref: args.plan ? args.plan.sl_per_click_ref : 0, 
                sl_per_click_ref_daily_limit: args.plan ? args.plan.sl_per_click_ref_daily_limit : 0, 
                sl_per_click_ref_status: args.plan ? this.booleanStatusValue(args.plan.sl_per_click_ref_status) : 0, 
                task_per_click_ref: args.plan ? args.plan.task_per_click_ref : 0, 
                task_per_click_ref_daily_limit: args.plan ? args.plan.task_per_click_ref_daily_limit : 0, 
                task_per_click_ref_status: args.plan ? this.booleanStatusValue(args.plan.task_per_click_ref_status) : 0, 
                ca_ref_commission: args.plan ? args.plan.ca_ref_commission : 0, 
                ca_ref_commission_daily_limit: args.plan ? args.plan.ca_ref_commission_daily_limit : 0, 
                ca_ref_commission_status: args.plan ? args.plan.ca_ref_commission_status : 0, 
                channel_subscribe_dl: args.plan ? args.plan.channel_subscribe_dl : 0, 
                status: args.plan ? this.booleanStatusValue(args.plan.status) : false, 
                validity: args.plan ? args.plan.validity : 0,
                ref_level: args.plan ? args.plan.ref_level : 0,   
            })
            $('#planModal').modal('show');
        })
    },
    mixins: [Helpers]
}
</script>

<style>

</style>