<template>
<Head :title="`${form.id ? 'Update Gateway' : 'Create Gateway' }`"/>
    <Authenticated>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form @submit.prevent="submit">
                        <div class="card-body">
                            <div class="payment-method-item">
                                <div class="payment-method-header d-flex flex-wrap">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" :style="`background-image: url( ${ gateway ? getImage(gateway.media.path, false, 'avatar', gateway.media?.is_external) : 'https://aamearning.com/assets/images/default.png'} )`"></div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" @input="form.image = $event.target.files[0]"/>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                                {{ form.progress.percentage }}%
                                            </progress>
                                            <label for="image" class="bg-primary"><font-awesome-icon icon="pencil"/></label>
                                            <error :message="form.errors.image" />
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="row mt-4 mb-none-15">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                                                <div class="form-group">
                                                    <Label value="Gateway Name" class="required" />
                                                    <Input :class="{ 'border border-danger' : form.errors.name }" type="text" v-model="form.name" placeholder="Method Name" required=""/>
                                                    <error :message="form.errors.name" />
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                                                <div class="form-group">
                                                    <Label value="Currency" class="required" />
                                                    <Input :class="{ 'border border-danger' : form.errors.currency }" type="text" v-model="form.currency" placeholder="Currency" required=""/>
                                                    <error :message="form.errors.currency" />
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                                                <Label value="Rate" class="required" />
                                                <div class="input-group has_append">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">1 {{ cur_text }} =</div>
                                                    </div>
                                                    <Input :class="{ 'border border-danger' : form.errors.rate }" type="text" v-model="form.rate" placeholder="Rate" required=""/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="currency_symbol">{{ cur_sym }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <error :message="form.errors.rate" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment-method-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="card border--primary mt-3 ">
                                                <h5 class="card-header bg--primary">Range</h5>
                                                <div class="card-body  p-3">
                                                    <Label value="Minimum Amount" class="required" />
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{ cur_text }}</div>
                                                        </div>
                                                        <Input :class="{ 'border border-danger' : form.errors.min_limit }" type="text" v-model="form.min_limit" placeholder="Min Limit" required=""/>
                                                        <error :message="form.errors.min_limit" />
                                                    </div>
                                                    <Label value="Maximum Amount" class="required" />
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{ cur_text }}</div>
                                                        </div>
                                                        <Input :class="{ 'border border-danger' : form.errors.max_limit }" type="text" v-model="form.max_limit" placeholder="Max Limit" required=""/>
                                                        <error :message="form.errors.max_limit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="card border--primary mt-3">
                                                <h5 class="card-header bg--primary">Charge</h5>
                                                <div class="card-body p-3">
                                                    <Label value="Fixed Charge" class="required" />
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{ cur_text }}</div>
                                                        </div>
                                                        <Input :class="{ 'border border-danger' : form.errors.fixed_charge }" type="text" v-model="form.fixed_charge" placeholder="Fixed Charge" required=""/>
                                                        <error :message="form.errors.fixed_charge" />
                                                    </div>
                                                    <Label value="Percent Charge" class="required" />
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <Input :class="{ 'border border-danger' : form.errors.percentage_charge }" type="text" v-model="form.percentage_charge" placeholder="Percentage Charge" required=""/>
                                                        <error :message="form.errors.percentage_charge" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="card border--dark mt-3">

                                                <h5 class="card-header bg--dark">Deposit Instruction</h5>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <ckeditor :editor="editor" v-model="form.instruction"></ckeditor>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="card border--dark mt-3">
                                                <h5 class="card-header bg--dark  text-white">User data
                                                    <Button @click="addField" type="button" class="btn btn-sm btn-outline-light float-right addUserData">
                                                        <font-awesome-icon icon="plus"/>Add New
                                                    </Button>
                                                </h5>

                                                <div class="card-body">
                                                    <div class="row addedField" v-if="form.userData.length > 0">
                                                        <div class="col-md-12 user-data" v-for="(user, index) in form.userData" :key="index">
                                                            <div class="form-group">
                                                                <div class="input-group mb-md-0 mb-4">
                                                                    <div class="col-md-4">
                                                                        <input v-model="this.form.userData[index].field_name" class="form-control" type="text" required placeholder="Field Name">
                                                                    </div>
                                                                    <div class="col-md-3 mt-md-0 mt-2">
                                                                        <select v-model="this.form.userData[index].type" class="form-control">
                                                                            <option value="text"> Input Text </option>
                                                                            <option value="textarea"> Textarea </option>
                                                                            <option value="file"> File upload </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 mt-md-0 mt-2">
                                                                        <select v-model="this.form.userData[index].validation"
                                                                                class="form-control">
                                                                            <option value="required"> Required </option>
                                                                            <option value="nullable">  Optional </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2 mt-md-0 mt-2 text-right">
                                                                        <span class="input-group-btn">
                                                                            <button @click="removeField(index)" class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                                                                <font-awesome-icon icon="times"/>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <Button type="submit" class="w-100 d-flex align-items-center justify-content-center p-2 btn-primary rounded " :class="{ 'opacity-25 disabled': form.processing }" :disabled="form.processing"  btnWidth="w-28 ml-auto">
                                <span class="ml-2 text-light">Save</span>
                                <span class="spinner-border text-dark ml-4" style="height: 20px; width: 20px;" v-if="form.processing">
                                    <span class="sr-only">Loading...</span>
                                </span>
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';
import Authenticated from '../../Layouts/Authenticated.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import Error from '@/Components/InputError.vue';
import Button from '@/Components/Button.vue'
import Helpers from '@/Mixins/Helpers';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    props: ['gateway'],
    components: { Input, Label, Error, Button, Helpers, Authenticated, Head },
    data(){
        return {
            form: null,
            editor: ClassicEditor,
            cur_text: "USD",
            cur_sym: '$',
        }
    },
    methods:{
        submit(){
            if(this.form.id){
                this.form.put(route('manual-gateway.update', [this.form.id]));
            }else{
                this.form.post(route('manual-gateway.store'));
            }
        },
        addField(){
            this.form.userData.push({
                    field_name: null,
                    type: 'text',
                    validation: 'required',
                })
        },
        removeField(index){
            this.form.userData.splice(index, 1)
        }
    },
    beforeMount(){
        this.form = useForm({
            id: this.gateway ? this.gateway.id : null,
            image: null,
            name: this.gateway ? this.gateway.name : null,
            currency: this.gateway ? this.gateway.single_currency?.currency : null,
            rate: this.gateway ? this.gateway.single_currency?.rate : null,
            min_limit: this.gateway ? this.gateway.single_currency?.min_amount : null,
            max_limit: this.gateway ? this.gateway.single_currency?.max_amount : null,
            fixed_charge: this.gateway ? this.gateway.single_currency?.fixed_charge : null,
            percentage_charge: this.gateway ? this.gateway.single_currency?.percentage_charge : null,
            instruction: this.gateway?.description ? this.gateway.description : '',
            userData: this.gateway ? JSON.parse(this.gateway.input_form) : [],
        });
    },
    mixins: [Helpers]
}
</script>