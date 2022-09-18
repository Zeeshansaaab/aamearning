<template>
  <div class="sidebar bg--dark" :class="{ 'open' : open}">
    <button class="res-sidebar-close-btn" @click="open=false"></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo">
            <ApplicationLogo/>
            </a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
          <ul class="sidebar__menu">
            <li class="sidebar-menu-item" >
                <Link :href="route('dashboard')" class="nav-link ">
                    <font-awesome-icon icon="gauge"/>
                    <span class="menu-title" style="margin-left: 10px;">Dashboard</span>
                </Link>
            </li>
            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_plans')">
                <Link :href="route('manage-plan.index')" class="nav-link ">
                    <font-awesome-icon icon="gauge"/>
                    <span class="menu-title" style="margin-left: 10px;">Plan</span>
                </Link>
            </li>

            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_administrators')">
                <Link :href="route('referral')" class="nav-link ">
                    <font-awesome-icon icon="gauge"/>
                    <span class="menu-title" style="margin-left: 10px;">Ref Commision</span>
                </Link>
            </li>
            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_administrators')">
                <Link :href="route('bonus-plans.index')" class="nav-link ">
                    <font-awesome-icon icon="gauge"/>
                    <span class="menu-title" style="margin-left: 10px;">Bonus Packages</span>
                </Link>
            </li>
            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_user_bonus')">
                <Link :href="route('user-bonus.index') + '?status=pending'" class="nav-link ">
                    <font-awesome-icon icon="gauge"/>
                    <span class="menu-title" style="margin-left: 10px;">User's Bonus</span>
                </Link>
            </li>
            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_users')">
                <Link :href="route('users.index')" class="nav-link ">
                    <font-awesome-icon icon="gauge"/>
                    <span class="menu-title" style="margin-left: 10px;">Manage users</span>
                </Link>
            </li>
            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_permissions')">
                <Link :href="route('administrators.index')" class="nav-link ">
                    <font-awesome-icon icon="users"/>
                    <span class="menu-title" style="margin-left: 10px;">Roles Manager</span>
                </Link>
            </li>
            <li class="sidebar-menu-item" v-if="checkUserPermissions('view_roles')">
                <Link :href="route('roles.index')" class="nav-link ">
                    <font-awesome-icon icon="users"/>
                    <span class="menu-title" style="margin-left: 10px;">Permission</span>
                </Link>
            </li>
            <li v-if="checkUserPermissions('view_settings')" class="sidebar-menu-item sidebar-dropdown nav-item dropdown" :class="[route().current('settings.*') ? 'show' : '']">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false" :class="[route().current('settings.*') ? 'active' : '']">
                  <font-awesome-icon icon="gear"/>
                  <span class="menu-title" style="margin-left: 10px;">Settings</span>
                </a>
                <div class="sidebar-submenu dropdown-menu" :class="[route().current('settings.*') ? 'show' : '']">
                    <ul>
                        <li v-for="setting in settings" :key="setting.id"  class="sidebar-menu-item" :class="[route().current('settings.*') ? 'active' : '']">
                            <Link :href="route('settings.group', setting.group)" :only="['settings']" class="text-capitalize">
                                <font-awesome-icon icon="circle" style="color: #0000ff57; font-size: 10px;" />
                                <span class="menu-title ml-3">{{ getGroupName(setting.group) }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </li>
          </ul>
        </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import ApplicationLogo from './ApplicationLogo.vue';
import Helpers from '@/Mixins/Helpers';
import axios from 'axios';
export default {
  data(){
    return {
      'settings': [],
      'open': false
    }
  },
  components: {
    Link,
    ApplicationLogo,
  },
  methods:{
    getSettings(){
      axios.get(route('settings'))
        .then((response) => {
          this.settings = response.data.data
      })
    }
  },
  mounted(){
    this.getSettings()
     this.emitter.on('open-sidebar', ()=>{
        this.open = this.open ? false : true
     });
  },
  mixins: [Helpers]
}
</script>