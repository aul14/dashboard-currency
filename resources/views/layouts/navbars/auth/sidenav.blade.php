<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-1 fixed-start ms-1 bg-white"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 title-nav" href="{{ route('home') }}" target="_blank">
            <img src="{{ asset('img/favicon.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold nav-link-text">Currency</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a href="{{ route('home') }}"
                    class="sidebar-menu-item nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <i class="fa fa-d text-dark text-sm opacity-10"></i>
                    <div>
                        <span class="nav-link-text"> Dashboard
                            <b class="caret"></b></span>
                    </div>
                </a>
            </li>


            {{-- MENU SETTINGS --}}
            <li class="nav-item ">
                <a aria-expanded="{{ Request::is('users*') || Request::is('modules*') || Request::is('permissions*') || Request::is('roles*') ? 'true' : 'false' }}"
                    data-toggle="collapse" data-target="#collapseShow5" class="sidebar-menu-item nav-link ">
                    <div><span class="nav-link-text text-uppercase text-xs font-weight-bolder">Settings <b
                                class="caret"></b></span></div>
                </a>
                <div class="collapse {{ Request::is('users*') || Request::is('modules*') || Request::is('permissions*') || Request::is('roles*') ? 'show' : '' }}"
                    id="collapseShow5">
                    <ul class="nav nav-sm flex-column">

                        @permission('manage-module')
                            <li class="nav-item">
                                <!---->
                                <div class="collapse ">
                                    <ul class="nav nav-sm flex-column"></ul>
                                </div> <a href="{{ route('modules.index') }}"
                                    class="nav-link {{ Request::is('modules*') ? 'active' : '' }}">
                                    <i class="fa fa-m text-dark text-sm opacity-10"></i>
                                    <div>
                                        <span class="nav-link-text">Module</span>
                                    </div>
                                </a>
                                <ul class="navbar-nav"></ul>
                            </li>
                        @endpermission

                        @permission('manage-permission')
                            <li class="nav-item">
                                <!---->
                                <div class="collapse ">
                                    <ul class="nav nav-sm flex-column"></ul>
                                </div> <a href="{{ route('permissions.index') }}"
                                    class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                                    <i class="fa fa-p text-dark text-sm opacity-10"></i>
                                    <div>
                                        <span class="nav-link-text">Permissions</span>
                                    </div>
                                </a>
                                <ul class="navbar-nav"></ul>
                            </li>
                        @endpermission
                        @permission('manage-role')
                            <li class="nav-item">
                                <!---->
                                <div class="collapse ">
                                    <ul class="nav nav-sm flex-column"></ul>
                                </div> <a href="{{ route('roles.index') }}"
                                    class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                                    <i class="fa fa-r text-dark text-sm opacity-10"></i>
                                    <div>
                                        <span class="nav-link-text">Roles</span>
                                    </div>
                                </a>
                                <ul class="navbar-nav"></ul>
                            </li>
                        @endpermission

                        @permission('manage-user')
                            <li class="nav-item">
                                <!---->
                                <div class="collapse ">
                                    <ul class="nav nav-sm flex-column"></ul>
                                </div> <a href="{{ route('users.index') }}"
                                    class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                                    <i class="fa fa-u text-dark text-sm opacity-10"></i>
                                    <div>
                                        <span class="nav-link-text">User Management</span>
                                    </div>
                                </a>
                                <ul class="navbar-nav"></ul>
                            </li>
                        @endpermission
                    </ul>
                </div>
            </li>

        </ul>
    </div>

</aside>
