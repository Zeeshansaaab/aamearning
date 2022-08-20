<template>
  
<nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
  <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
    <Link class="navbar-brand brand-logo-mini align-self-center d-lg-none" :href="route('dashboard')">
        <ApplicationLogo/>
    </Link>
    <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
      <i class="mdi mdi-menu"></i>
    </button>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i>
          <span class="count count-varient1">7</span>
        </a>
        <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0 ">Notifications</h6>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="storage/user/user1.jpg" alt="" class="profile-pic">
            </div>
            <div class="preview-item-content">
              <p class="mb-0">Dany Miles <span class="text-small text-muted">commented on your photo</span></p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 ">View all activities</p>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right ml-lg-auto">
        <Dropdown>
            <template #header>
                <img class="nav-profile-img mr-2" alt="" :src="getImage($page.props.auth.user.image)">
                <span class="profile-name">Henry Klein</span>
            </template>
            <template #items>
                <Link class="dropdown-item" href="#">
                    <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </Link>
                <Link  method="post" class="dropdown-item" :href="route('logout')">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </Link>
            </template>
        </Dropdown>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue';
import Helpers from '@/Mixins/Helpers';
import ApplicationLogo from './ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Dropdown,
        ApplicationLogo,
        Link
    },
    mixins: [Helpers]
}
</script>

<style>

</style>