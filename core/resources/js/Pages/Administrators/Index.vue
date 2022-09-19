<template>
    <Head title="Administrator"/>
  <Authenticated>
    <template #breadcrumb>
        Admin <font-awesome-icon icon="arrow-right"/> Administrator
    </template>
    <template #breadcrumbplugin>
        <SearchInput :searchedKeyword="searchedKeyword" callType='administrators'/>
    </template>
        <div class="card">
            <div class="card-header border-0 pt-1 pb-0 mb-0">
                <h3 class="card-title align-items-start flex-column">
                    Administrator
                </h3>
            </div>
            <div class="card-body py-1">
                <div class="table-responsive--sm">
                    <table class="table table--light style--two">
                        <thead>
                            <tr >
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="administratorsList && administratorsList.data.length > 0">
                            <template v-for="administrator in administratorsList.data" :key="administrator.id">
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex align-items-center">
                                            <div class="image-input image-input-empty">
                                                <div
                                                class="image-input-wrapper w-50px h-50px"
                                                :style="{ 'background-image': 'url(' + getImage(administrator.image, true, 'image') + ')' }"
                                                ></div>
                                            </div>
                                            <div class="d-flex justify-content-start flex-column mx-2">
                                                <span
                                                    class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ administrator.first_name }}  {{ administrator.last_name }}</span>
                                                <span
                                                    class="text-muted fw-bold text-muted d-block fs-7">{{ administrator.email}}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Role">
                                        <span class="text-muted fw-bold text-muted d-block text-capitalize fs-7">{{ administrator.user_type }}</span>
                                    </td>
                                    <td data-label="Status">
                                        <span class="badge fs-7 fw-bold text-capitalize" 
                                        :class="{ 'badge-light-success': administrator.status == 'active', 'badge-light-danger': administrator.status === 'inactive' }">{{ administrator.status }}</span>
                                    </td>
                                    <td data-label="Created at">
                                        <span class="text-muted fw-bold text-muted d-block fs-7">{{ formatDate(administrator.created_at)}}</span>
                                    </td>
                                    <td data-label="Action">
                                        <div class="d-flex">
                                            <VueToggle v-if="checkUserPermissions('edit_administrators')"
                                                :value="booleanStatusValue(administrator.status)"
                                                @toggle="changeStatus(administrator.id)"
                                                name="Status" 
                                                title=""
                                            />
                                            <edit-section iconType="link" 
                                                permission="edit_administrators"
                                                :url="route('administrators.edit', administrator.id)"/>
                                            <delete-section permission="delete_administrators"
                                                :url="route('administrators.destroy', administrator.id)" />
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <div v-else class="p-4 text-muted">
                            Record Not Found
                        </div>
                    </table>
                </div>
            </div>
            
        <pagination :meta="administratorsList" :keyword="searchedKeyword" callType="administrators" />
        </div>
  </Authenticated>
</template>

<script setup>
import Authenticated from '@/Layouts/Authenticated.vue';
import Helpers from '@/Mixins/Helpers';
import DeleteSection from '@/Components/DeleteSection.vue'
import EditSection from '@/Components/EditSection.vue'
import VueToggle from 'vue-toggle-component';
import SearchInput from '@/Components/SearchInput.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
</script>
<script>
export default {
    props: ['administratorsList', 'searchedKeyword'],
    mixins: [Helpers]
}
</script>

<style>

</style>