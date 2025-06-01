<aside class="col-md-3 nav-sticky dashboard-sidebar">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        <img src="{{asset($user->avatar)}}" alt="User Image" class="rounded-circle mb-2"
             style="width: 80px; height: 80px; object-fit: cover"/>
        <h5 class="mb-0" style="color: #ff6f61">{{$user->username}}</h5>
    </div>

    <!-- Sidebar Menu -->
    <div class="list-group profile-sidebar-menu">
        <a href="./dashboard.html" class="list-group-item list-group-item-action active menu-item" data-section="profile">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="./notifications.html" class="list-group-item list-group-item-action menu-item" data-section="notifications">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="./setting.html" class="list-group-item list-group-item-action menu-item" data-section="settings">
            <i class="fas fa-cog"></i> Settings
        </a>
    </div>
</aside>