<template>
<Head :title="getGroupName(this.form.settings[0].group)" />
  <Authenticated>
    <template #breadcrumb>
        Settings
    </template>
    <form @submit.prevent="submit">
        <div class="row">
            <ValidationErrors class="mb-4" />
            <div v-for="(setting, index) in settings" :key="setting.id" class="col-md-6 col-sm-12">
                <vue-toggle
                    v-if="form.settings[index].type == 'checkbox' && checkUserPermissions('edit_settings')"
                    :title="form.settings[index].name" 
                    :name="form.settings[index].name" 
                    :value=booleanStatusValue(form.settings[index].key)
                    @toggle="toggle($event, index)"
                />
                <div class="form-group" v-else>
                    <Label 
                        :for="form.settings[index].key" 
                        :value="form.settings[index].name" />                
                    <Input
                        :id="setting.key" 
                        :type="setting.type" 
                        class="mt-1 block w-full" 
                        required autofocus 
                        v-model = "form.settings[index].value"  
                    />
                </div>
                <error v-if="form.errors.settings" :message="form.errors.settings[index].value"></error>
            </div>
           <div class="col-lg-12 py-2 d-flex justify-content-end">
                <Button type="submit" :style="{ 'opacity: 0.5': form.processing }"
                    :disabled="form.processing">
                    <span class="indicator-label" v-if="!form.processing">Update</span>
                    <span class="indicator-progress" v-if="form.processing">
                        <span class="spinner-border spinner-border-sm align-middle"></span>
                    </span>
                </Button>
            </div>
        </div>
    </form>
  </Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '@/Layouts/Authenticated.vue'
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import error from '@/Components/InputError.vue';
import Button from '@/Components/Button.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import VueToggle from 'vue-toggle-component';

export default {
    props: ["settings"],
    data() {
        return {
            form: null
        };
    },
    components: { 
        Authenticated,
        error,
        Input,
        Label,
        Button,
        ValidationErrors,
        VueToggle,
        Head
    },
    methods: {
        submit(){
            this.form.post(route('settings.group.update'), {
                errorBag: "setting",
                preserveScroll: true,
                preserveState: true,
            })
        },
        toggle(e, index){
            this.form.settings[index].value = e ? 'active' : 'inactive';
        },
    },
   
    beforeMount(){
        this.form = useForm({
            settings: this.settings
        })
    },
    mixins: [Helpers]

}
</script>

<style>

</style>