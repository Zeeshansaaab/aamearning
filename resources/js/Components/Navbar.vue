<template>
  <!-- navbar-wrapper start -->
<nav class="navbar-wrapper bg--dark">
    <div class="navbar__left">
        <button type="button" class="res-sidebar-open-btn me-3" red="sidebar_open" @click="openSidebar"><font-awesome-icon icon="bars"/></button>
        <form class="navbar-search">
            <input type="search" name="#0" class="navbar-search-field" id="searchInput" autocomplete="off"
                placeholder="Search here...">
            <ul class="search-list"></ul>
        </form>
    </div>
    <div class="navbar__right">
        <ul class="navbar__action-list">

            <li class="dropdown">
                <button type="button" class="primary--layer" data-bs-toggle="dropdown" data-display="static"
                    aria-haspopup="true" aria-expanded="false">
                    <font-awesome-icon icon="bell"/>
                </button>
                <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                    <div class="dropdown-menu__header">
                        <span class="caption">@lang('Notification')</span>
                        <!-- @if($adminNotificationCount > 0)
                            <p>@lang('You have') {{ $adminNotificationCount }} @lang('unread notification')</p>
                        @else
                            <p>@lang('No unread notification found')</p>
                        @endif -->
                    </div>
                    <div class="dropdown-menu__body">
                       <a href=""
                          class="dropdown-menu__item">
                          <div class="navbar-notifi">
                              <div class="navbar-notifi__left bg--green b-radius--rounded"><img
                                      src=""
                                      alt="@lang('Profile Image')"></div>
                              <div class="navbar-notifi__right">
                                  <h6 class="notifi__title">Notification</h6>
                                  <span class="time"><font-awesome-icon icon="clock"/>
                                      </span>
                              </div>
                          </div><!-- navbar-notifi end -->
                      </a>
                    </div>
                    <div class="dropdown-menu__footer">
                        <a href=""
                            class="view-all-message">@lang('View all notification')</a>
                    </div>
                </div>
            </li>


            <li class="nav-item dropdown">
                <button type="button" class="dropdown-toggle"
                    data-toggle="dropdown">
                    <span class="navbar-user">
                        <span class="navbar-user__thumb"><img
                                src=""
                                alt="image"></span>
                        <span class="navbar-user__info">
                            <span
                                class="navbar-user__name"></span>
                        </span>
                        <span class="icon"><font-awesome-icon icon="circle-down"/></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right dropdown-menu">
                    <a href="{{ route('admin.profile') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <font-awesome-icon icon="user-circle"/>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a href="{{ route('admin.password') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <font-awesome-icon icon="key"/>
                        <span class="dropdown-menu__caption">@lang('Password')</span>
                    </a>

                    <a href="{{ route('admin.logout') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <font-awesome-icon icon="sign-out"/>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->

</template>

<script>
import Dropdown from '@/Components/Dropdown.vue';
import Helpers from '@/Mixins/Helpers';
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Dropdown,
        Link
    },
    methods:{
        openSidebar(){
            this.emitter.emit('open-sidebar');
        }
    },
    mixins: [Helpers]
}
</script>

<style>

</style>