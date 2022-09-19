<template>
    <Head title="Referrals"/>
<Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon icon="arrow-right"/> Ref Commission
    </template>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0 pt-1 pb-0 mb-0 d-flex justify-content-between">
                    <h3 class="card-title align-items-center">
                        CURRENT SETTING
                    </h3>
                </div>
                <div class="card-body py-1">
                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">Level</th>
                                    <th scope="col">Commision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="referral in referrals" :key="referral.id">
                                    <td data-label="Name">Level # {{referral.level}}</td>
                                    <td data-label="Price" class="font-weight-bold">{{ referral.percent }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <form @submit.prevent="submit">
                        <div class="form-row">
                            <div class="form-group col" v-for="(setting, index) in settings" :key="setting.id">
                                <p class="text-muted">{{ setting.name }}</p>
                                <vue-toggle
                                    v-if="form.settings[index].type == 'checkbox' && checkUserPermissions('view_administrators')"
                                    :title="form.settings[index].name" 
                                    :name="form.settings[index].name" 
                                    :toggled="booleanStatusValue(form.settings[index].value)"
                                    @toggle="toggle($event, index)"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col">
                                <Button type="submit" class="w-100 d-flex align-items-center justify-content-center p-2 btn-primary rounded " :class="{ 'opacity-25 disabled': form.processing }" :disabled="form.processing"  btnWidth="w-28 ml-auto">
                                    <span class="ml-2 text-light">Submit</span>
                                    <span class="spinner-border text-dark ml-4" style="height: 20px; width: 20px;" v-if="form.processing">
                                        <span class="sr-only">Loading...</span>
                                    </span>
                                </Button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">CHANGE SETTING</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" placeholder="HOW MANY LEVEL" v-model="totalItem" class="form-control input-lg">
                        </div>
                        <div class="col-md-6">
                            <Button type="button" id="generate" class="btn btn--success btn-block btn-md" @click="addLevel">
                                GENERATE
                            </Button>
                        </div>
                    </div>
                    <form @submit.prevent="submitLevel">
                        <div class="form-group">
                            <label class="text-success"> Level & Commission :
                                <small>(Old Levels will Remove After Generate)</small>
                            </label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description ref-desc">
                                        <div class="row">
                                            <div class="col-md-12" v-for="(index, item) in total" :key="index">
                                                <div class="input-group mt-2">
                                                    <input v-model="levelForm.level[index - 1]" class="form-control margin-top-10" type="text" readonly required :placeholder="`Level ${index}`">
                                                    <input v-model="levelForm.percent[index - 1]" class="form-control margin-top-10" type="text" required :placeholder="`Commission % on Level ${item}`">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger margin-top-10 delete_desc" type="button">
                                                            <font-awesome-icon icon="fa-times"/>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn--primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import { useForm } from '@inertiajs/inertia-vue3';
import Authenticated from '../../Layouts/Authenticated.vue';
import EditSection from '@/Components/EditSection.vue';
import { Head } from '@inertiajs/inertia-vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Pagination from '@/Components/Pagination.vue'
import Button from '@/Components/Button.vue';
import VueToggle from 'vue-toggle-component';

export default {
    props: ['referrals' , 'searchKeyword', 'settings'],
    data(){
        return {
            searchedKeywords: this.searchKeyword,
            isShow: false,
            form: null,
            total: 0,
            totalItem: null,
            levelForm: null,
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
        VueToggle
    },
    methods: {
        submit(){
            this.form.post(route('manage-plan.store'), {
                errorBag: "product",
                preserveScroll: true,
                onSuccess: () => { $('#planModal').modal('hide'); }
            });
        },
        submitLevel(){
            this.levelForm.post(route('referral'), {
                errorBag: "level",
                preserveScroll: true,
                onSuccess: () => { this.total = 0; this.totalItem = 0; }
            });
        },
        toggle(e, index){
            this.$inertia.visit(route('referral.status', [this.form.settings[index].id]));
        },
        addLevel(){
            this.total = parseInt(this.totalItem);
            for(let i =0; i < this.total; i++){
                this.levelForm.level.push(`Level ${i}`)
                // this.levelForm.percent.push(0)
            }
        }
    },
    beforeMount(){
        this.form = useForm({
            settings: this.settings
        });

        this.levelForm = useForm({
            level: [],
            percent: []
        })
    },
    mixins: [Helpers]
}
</script>

<style>

</style>