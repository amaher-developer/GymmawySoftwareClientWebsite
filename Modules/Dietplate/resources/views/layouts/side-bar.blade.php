{{-- get the identifier of from the route--}}
@php
    $identifier = request()->segment(2);
@endphp

@if(env('APP_ENV')=='local')
    <li aria-haspopup="true" class="start">
        <a href="{{route('listModules')}}" class="nav-link nav-toggle">
            <i class="icon-folder"></i>
            <span class="title">Modules </span>
            @if($migrate)<span class="title" style="   font-weight: bold;   font-size: 14px;   color: red;">(migrate) </span>@endif
        </a>
    </li>
@endif
@if(env('APP_ENV')=='local'||has_any_access([],$currentUser) > 0)
    <li aria-haspopup="true" class="start">
        <a href="{{url('telescope')}}" class="nav-link nav-toggle" target="_blank">
            <i class="icon-ghost"></i>
            <span class="title">Telescope </span>
        </a>
    </li>
@endif


@if(has_any_access(['user-index','admin-index','role-index'],$currentUser) > 0)
    <li aria-haspopup="true"
        class="menu-dropdown classic-menu-dropdown {{ in_array($identifier,['role','admin','user'])  ? 'font-green' : '' }}">
        <a href="javascript:;" class="{{ in_array($identifier,['role','admin','user'])  ? 'font-green' : '' }}">
            <i class="icon-users"></i> {{trans('admin.clients')}}
        </a>
        <ul class="dropdown-menu">
            @if(has_any_access(['role-index'],$currentUser) > 0)
                <li aria-haspopup="true" class="{{ in_array($identifier,['role'])  ? 'font-green' : '' }}">
                    <a href="{{route('listRoles')}}" class="nav-link ">
                        <i class="icon-arrow-right "></i>
                        <span class="title">{{trans('admin.roles')}}</span>
                    </a>
                </li>
            @endif


            @if(has_any_access(['admin-index'],$currentUser) > 0)
                <li aria-haspopup="true" class="{{ in_array($identifier,['admin'])  ? 'font-green' : '' }}">
                    <a href="{{route('listAdmins')}}" class="nav-link ">
                        <i class="icon-arrow-right "></i>
                        <span class="title">{{trans('admin.users')}}</span>
                    </a>
                </li>
            @endif


            @if(has_any_access(['user-index'],$currentUser) > 0)

                <li aria-haspopup="true" class=" {{ in_array($identifier,['user'])  ? 'font-green' : '' }}">
                    <a href="{{route('listUser')}}?limit=10" class="nav-link ">
                        <i class="icon-user"></i>
                        <span class="title">{{trans('admin.customers')}}</span>
                    </a>
                </li>

            @endif
        </ul>
    </li>
@endif







@if(has_any_access(['user-index','admin-index','role-index'],$currentUser) > 0)
    <li aria-haspopup="true"
        class="menu-dropdown classic-menu-dropdown {{ in_array($identifier,['setting','notification','dashboard'])  ? 'font-green' : '' }}">
        <a href="javascript:;"
           class="{{ in_array($identifier,['setting','notification','dashboard'])  ? 'font-green' : '' }}">
            <i class="icon-settings"></i> {{trans('admin.general_settings')}}
        </a>
        <ul class="dropdown-menu">
            @if(has_any_access(['setting-edit'],$currentUser) > 0)

                <li aria-haspopup="true" class="{{ in_array($identifier,['setting'])  ? 'font-green' : '' }}">
                    <a href="{{route('editSetting',1)}}" class="nav-link ">
                        <i class="icon-notebook "></i>
                        <span class="title">{{trans('admin.website_info')}}</span>
                    </a>
                </li>
            @endif



        </ul>
    </li>
@endif

