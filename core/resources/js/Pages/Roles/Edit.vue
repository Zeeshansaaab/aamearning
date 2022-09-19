<template>
  <AuthenticatedLayout>
    <template #breadcrumb>
      Edit Roles
    </template>
    <div>
      <role-form :role="role" :permissionGroups="permissionGroups" :rolePermissions="rolePermissions"></role-form>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import RoleForm from "./Form.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
export default {
  components: {
    Head,
    AuthenticatedLayout,
    RoleForm,
    Breadcrumb
},
  props: ["role", 'permissionGroups', 'rolePermissions'],
};
</script>