<template>
    
<Modal id="planModal" :title="name">
    <form @submit.prevent="submit" v-if="form">
        <div class="modal-body">
            <div class="form-group">
                <Label for="name" class="required">Name </Label>
                <Input type="text" v-model="form.name" placeholder="Plan Name" required=""/>
                <error :message="form.errors.name" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">Price </Label>
                <Input type="text" v-model="form.price" placeholder="Price" required=""/>
                <error :message="form.errors.price" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">PTC Rate</Label>
                <Input type="text" v-model="form.ptc_rate" placeholder="PTC Rate" required=""/>
                <error :message="form.errors.ptc_rate" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">Ptc Per Click Referral Price</Label>
                <Input type="text" v-model="form.ptc_per_click_ref" placeholder="Ptc Per Click Referral Price" required=""/>
                <error :message="form.errors.ptc_per_click_ref" />
            </div>
            <div class="form-group">
                <label for="max_profit_percent" class="required">Maximum Profit %age </label>
                <div class="input-group">
                    <input type="text" class="form-control has-append" name="max_profit_percent" placeholder="Maximum Profit %age of Plan" required="" id="max_profit_percent">
                    <div class="input-group-text">%</div>
                </div>
            </div>
            <div class="form-group">
                <label for="profit_bonus_percent" class="required">Bonus Profit %age </label>
                <div class="input-group">
                    <input type="text" class="form-control has-append" name="profit_bonus_percent" placeholder="Bonus Profit %age" required="" id="profit_bonus_percent">
                    <div class="input-group-text">%</div>
                </div>
            </div>
            <div class="form-group">
                <label for="validity" class="required">Validity</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="validity" placeholder="Validity" required="" id="validity">
                    <div class="input-group-text">Days</div>
                </div>
                <small>Write 0 For unlimited</small>
            </div>
            <div class="form-group">
                <label for="ammount_return" class="required">Ammount Return</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="ammount_return" placeholder="Ammount Return" required="" id="ammount_return">
                    <div class="input-group-text">Days</div>
                </div>
            </div>

            
            <div class="form-group">
                <label for="status">Status</label>
                <div class="toggle btn btn--danger off" data-bs-toggle="toggle" style="width: 100%; height: 50px;"><input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="Enable" data-off="Disable" name="status" id="status"><div class="toggle-group"><label class="btn btn--success toggle-on">Enable</label><label class="btn btn--danger active toggle-off">Disable</label><span class="toggle-handle btn btn-default"></span></div></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn--primary w-100">Submit</button>
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
export default {
    components: { Modal, Label, Input, Error },
    props: ['title'],
    data(){
        return {
            name: this.title,
            plan: null,
            form: null,
        }
    }, 
    beforeMount(){
        this.emitter.on('plan_modal', (args)=>{
            this.name = args ? args.title : '',
            this.form = useForm({
                id: args.plan ? args.plan.id : null, 
                name: args.plan ? args.plan.name : null, 
                user_ref: args.plan ? args.plan.user_ref : null, 
                daily_limit: args.plan ? args.plan.daily_limit : null, 
                price: args.plan ? args.plan.price : null, 
                ptc_rate: args.plan ? args.plan.ptc_rate : null, 
                ptc_per_click_ref: args.plan ? args.plan.ptc_per_click_ref : null, 
                ptc_per_click_ref_daily_limit: args.plan ? args.plan.ptc_per_click_ref_daily_limit : null, 
                ptc_per_click_ref_status: args.plan ? args.plan.ptc_per_click_ref_status : null, 
                sl_per_click_ref: args.plan ? args.plan.sl_per_click_ref : null, 
                sl_per_click_ref_daily_limit: args.plan ? args.plan.sl_per_click_ref_daily_limit : null, 
                sl_per_click_ref_status: args.plan ? args.plan.sl_per_click_ref_status : null, 
                task_per_click_ref: args.plan ? args.plan.task_per_click_ref : null, 
                task_per_click_ref_daily_limit: args.plan ? args.plan.task_per_click_ref_daily_limit : null, 
                task_per_click_ref_status: args.plan ? args.plan.task_per_click_ref_status : null, 
                ca_ref_commission: args.plan ? args.plan.ca_ref_commission : null, 
                ca_ref_commission_daily_limit: args.plan ? args.plan.ca_ref_commission_daily_limit : null, 
                ca_ref_commission_status: args.plan ? args.plan.ca_ref_commission_status : null, 
                status: args.plan ? args.plan.status : null, 
                status: args.plan ? args.plan.status : null, 
                ref_level: args.plan ? args.plan.ref_level : null,   
            })
            console.log(this.form)
            $('#planModal').modal('show');
        })
    },
    mounted(){
       
    }
}
</script>

<style>

</style>