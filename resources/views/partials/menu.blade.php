<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fi fi-br-dashboard nav-icon"></i>
                    Dashboard
                </a>
            </li>

            @can('user_manage_access')
                <li
                    class="nav-item nav-dropdown {{ request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.*') ? 'open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fi fi-br-user-gear nav-icon"></i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items" style="margin-left:28px;">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan

                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('user_access')
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fi fi-br-users nav-icon"></i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route('admin.banners.index') }}"
                    class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                    <i class="fi fi-br-picture nav-icon"></i>
                    {{ trans('cruds.banner.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pages.index') }}"
                    class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <i class="fi fi-br-layout-fluid nav-icon"></i>
                    {{ trans('cruds.cms.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.department.index') }}"
                    class="nav-link {{ request()->routeIs('admin.department.*') ? 'active' : '' }}">
                    <i class="fi fi-br-briefcase nav-icon"></i>
                    {{ trans('cruds.department.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.doctor.index') }}"
                    class="nav-link {{ request()->routeIs('admin.doctor.*') ? 'active' : '' }}">
                    <i class="fi fi-br-stethoscope nav-icon"></i>
                    {{ trans('cruds.doctor.title') }}
                </a>
            </li>
        </ul>
    </nav>
</div>
