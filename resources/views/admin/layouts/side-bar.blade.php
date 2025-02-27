<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        @if(session()->has('user'))
        <div class="image">
          <img src="{{asset(session('user')->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ session('user')->name }}</a>
        </div>
        @endif
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">        
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
      
          </li>
     
          <li class="nav-item">
            <a href="{{route('category.index')}}" class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Category
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('tag.index')}}" class="nav-link {{ request()->routeIs('tag.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>
               Tag
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('brand.index')}}" class="nav-link {{ request()->routeIs('brand.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Brand
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product.index')}}" class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Product
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
               User
                
              </p>
            </a>
          </li>
          
          {{-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
          
       
            
   
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('setting.assign_role_permission')}}" class="nav-link">
                  <i class="fas fa-user-shield"></i>
                  <p>Role Permission</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setting.assign_special_permission')}}" class="nav-link">
                  <i class="fas fa-user-lock"></i>
                  <p>Special Permission</p>
                </a>
              </li>
           
           
            </ul>
          </li>
      
      
        

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
