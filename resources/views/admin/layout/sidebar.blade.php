  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link">

      <span class="brand-text font-weight-light">Hapush Hupush Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @if(!empty(Auth::guard('admin')->user()->image))
                <img src="{{asset('admin/images/photos/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
            @else
                <img src="{{asset('admin/images//user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(Session::get('page')=="dashboard")
              @php $active="active" @endphp
          @else
              @php $active = "" @endphp
          @endif
          <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                DashBoard
              </p>
            </a>
          </li>
          @if(Session::get('page')=="update-details" ||Session::get('page')=="update-password")
              @php $active="active" @endphp
          @else
              @php $active = "" @endphp
          @endif
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="update-password")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
              @endif
              <li class="nav-item">
                <a href="{{url('admin/update-password')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password </p>
                </a>
              </li>
              @if(Session::get('page')=="update-details")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
              @endif
              <li class="nav-item">
                <a href="{{url('admin/update-details')}}" class="nav-link {{$active}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>

            </ul>
          </li>
          @if(Session::get('page')=="User")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin/users')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @if(Session::get('page')=="Running-Game")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin/cms-pages')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Running Game
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @if(Session::get('page')=="Partner")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin\partner')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Partner
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @if(Session::get('page')=="about")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin/about')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              About
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @if(Session::get('page')=="social-media")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin/social-media')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Social Media
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @if(Session::get('page')=="contact")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin/contact')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Contact
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @if(Session::get('page')=="terms-condition")
                  @php $active="active" @endphp
              @else
                  @php $active = "" @endphp
          @endif

          <li class="nav-item">
            <a href="{{url('admin/terms-condition')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Terms and Condition
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>






        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
