<aside class="col-md-3 nav-sticky dashboard-sidebar">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        <img src="{{asset($user->avatar)}}" alt="User Image" class="rounded-circle mb-2"
             style="width: 80px; height: 80px; object-fit: cover"/>
        <h5 class="mb-0" style="color: #ff6f61">{{$user->name}}</h5>
    </div>

    <!-- Sidebar Menu -->
    <div class="list-group profile-sidebar-menu">

        <a title="Profile" href="{{ route('frontend.dashboard.profile') }}"
           class="list-group-item list-group-item-action menu-item {{ request()->routeIs('frontend.dashboard.profile') ? 'active' : '' }}"
           data-section="profile"> <i class="fas fa-user"></i> Profile
        </a>

        <a href="{{ route('frontend.dashboard.notifications.index') }}"
           class="list-group-item list-group-item-action menu-item {{ request()->routeIs('frontend.dashboard.notifications.index') ? 'active' : '' }}"
           data-section="notifications">
            <i class="fas fa-bell"></i> Notifications
        </a>

        <a title="Settings" href="{{ route('frontend.dashboard.settings.index') }}"
           class="list-group-item list-group-item-action menu-item {{ request()->routeIs('frontend.dashboard.settings.index') ? 'active' : '' }}"
           data-section="settings">
            <i class="fas fa-cog"></i> Settings
        </a>

        <a title="Settings" href="{{$getSetting->whatsapp}}" target="_blank" data-section="support"
           class="list-group-item list-group-item-action menu-item">
            <i class="fas fa-phone"></i> Support
        </a>

    </div>
</aside>