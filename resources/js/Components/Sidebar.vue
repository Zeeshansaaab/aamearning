<template>
  <nav class="sidebar sidebar-offcanvas" id="sidebar" style="height: 100vh; overflow:scroll;">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
      <Link as='a' class="sidebar-brand brand-logo" href="#">
        <ApplicationLogo width='177px'/>
      </Link>
    </div>
    <ul class="nav mt-5">
      <li class="nav-item">
        <Link class="nav-link" as="a" :href="route('dashboard')">
          <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </Link>
      </li>
      <li class="nav-item sidebar-actions">
        <div class="nav-link">
          <div class="mt-4">
            <ul class="mt-4 pl-0">
              <li><Link :href="route('logout')" method="post" >Logout</Link></li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>
<style scoped>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: transparent;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: rgb(0, 0, 0);
}
</style>