<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Blog System</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories"
           aria-expanded="true" aria-controls="categories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
        <div id="categories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users</h6>
                <a class="collapse-item" href="{{ route('admin.categories.index') }}">Categories</a>
                <a class="collapse-item" href="{{ route('admin.categories.create') }}">Add Category</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#posts"
           aria-expanded="true" aria-controls="posts">
            <i class="fas fa-fw fa-cog"></i>
            <span>Posts Management</span>
        </a>
        <div id="posts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users</h6>
                <a class="collapse-item" href="{{ route('admin.posts.index') }}">Posts</a>
                <a class="collapse-item" href="{{ route('admin.posts.create') }}">Add Post</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users</h6>
                <a class="collapse-item" href="{{ route('admin.users.index') }}">Users</a>
                <a class="collapse-item" href="{{ route('admin.users.create') }}">Add User</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminManagement"
           aria-expanded="true" aria-controls="AdminManagement">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Admins</span>
        </a>
        <div id="AdminManagement" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Admins Managements:</h6>

                <a class="collapse-item" href="{{ route('admin.admins.index') }}">All Admins</a>

                <a class="collapse-item" href="{{ route('admin.admins.create') }}">Add New Admin</a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roles"
           aria-expanded="true" aria-controls="roles">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Authorization</span>
        </a>
        <div id="roles" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Authorization</h6>

                <a class="collapse-item" href="{{ route('admin.roles.index') }}">All Roles</a>

                <a class="collapse-item" href="{{ route('admin.roles.create') }}">Add New Role</a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contact.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Contacts</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings"
           aria-expanded="true" aria-controls="settings">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Settings</span>
        </a>
        <div id="settings" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Settings</h6>

                <a class="collapse-item" href="{{ route('admin.settings.index') }}">Settings</a>

                <a class="collapse-item" href="{{ route('admin.related-sites.index') }}">Related Sites</a>

            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>