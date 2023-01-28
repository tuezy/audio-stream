@can("dashboard.settings.index")
<li class="nav-item">
    <a class="nav-link menu-link" href="{{ route('dashboard.settings.index') }}">
        <i class="ri-honour-line"></i> <span data-key="t-widgets">Settings</span>
    </a>
</li>
@endcan

@canany(['dashboard.roles.index', 'dashboard.permissions.index', 'dashboard.users.index'])
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Authentication</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarAuth">
        <ul class="nav nav-sm flex-column">
            @can("dashboard.users.index")
            <li class="nav-item">
                <a href="{{route("dashboard.users.index")}}" class="nav-link" data-key="t-basic"> Users
                </a>
            </li>
            @endcan
            @can("dashboard.roles.index")
            <li class="nav-item">
                <a href="{{route("dashboard.roles.index")}}" class="nav-link" data-key="t-basic"> Roles
                </a>
            </li>
            @endcan
            @can("dashboard.permissions.index")
            <li class="nav-item">
                <a href="/roles" class="nav-link" data-key="t-basic"> Permissions
                </a>
            </li>
            @endcan
        </ul>
    </div>
</li>
@endcanany