<template>
    
<Modal id="planModal" :title="name">
    <form @submit.prevent="submit" v-if="form">
        <div class="modal-body">
            <div class="form-group">
                <Label for="name" class="required">Name </Label>
                <Input :class="{ 'border border-danger' : form.errors.name }" type="text" v-model="form.name" placeholder="Name" required=""/>
                <error :message="form.errors.name" />
            </div>
            <div class="form-group">
                <Label for="name" class="required">Amount </Label>
                <Input :class="{ 'border border-danger' : form.errors.amount }" type="text" v-model="form.amount" placeholder="Amount" required=""/>
                <error :message="form.errors.amount" />
            </div>
            <!-- <div class="input-group mt-2">
                <Label for="name" class="required">Total values </Label>
                <Input type="number" v-model="total" placeholder="Total Values" required=""/>
                <span class="input-group-btn">
                    <button class="btn btn-primary margin-top-10 delete_desc" @click="addValues" type="button">
                        <font-awesome-icon icon="fa-plus"/>
                    </button>
                </span>
            </div>
             -->
            <div class="form-group" v-for="(value, index) in this.form.value" :key="index">
                <Label for="name" class="required">{{ value.name }}</Label>
                <Input :class="{ 'border border-danger' : form.errors.value }" type="text" v-model="form.value[index].value" :placeholder="value.name"/>
                <error :message="form.errors.value" />
            </div>
            
            <vue-toggle
                title="Status" 
                name="Status" 
                :toggled="booleanStatusValue(form.status)"
                @toggle="toggle($event, index)"
            />
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
import VueToggle from 'vue-toggle-component';
export default {
    components: { Modal, Label, Input, Error, StatusCheckbox, Checkbox, Button, VueToggle },
    props: ['title'],
    data(){
        return {
            name: this.title,
            plan: null,
            form: null,
            total: 0,
        }
    },
    methods: {
        submit(){
            this.form.post(route('bonus-plans.store'), {
                errorBag: "bonus_plan",
                preserveScroll: true,
                onSuccess: () => { $('#planModal').modal('hide'); }
            });
        },
        addValues(){
            // for(let i=0; i < this.total; i++){
            //     this.form.value.push(
            //         typeof this.form.value[i] === 'undefined' ? { name:null }
            //     )
            // }
        },
        toggle(e, index){
            
        },
    }, 
    beforeMount(){
        this.emitter.on('bonus_modal', (args)=>{
            this.name = args ? args.title : '',
            this.form = useForm({
                id: args.bonus_plan ? args.bonus_plan.id : null, 
                name: args.bonus_plan ? args.bonus_plan.name : null, 
                amount: args.bonus_plan ? args.bonus_plan.amount : null, 
                value: args.bonus_plan ? JSON.parse(args.bonus_plan.value) : [],
                status: args.bonus_plan ? args.bonus_plan.status : false, 
            })
            this.total = this.form.value.length
            $('#planModal').modal('show');
        })
    },
    mounted(){

    },
    mixins: [Helpers]
}
</script>

<style>

</style>