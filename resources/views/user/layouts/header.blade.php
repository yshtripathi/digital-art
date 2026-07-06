<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top border-bottom border-light shadow-none" style="height: 80px;">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3" style="color: #64748b;">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto align-items-center">

      {{-- Home page --}}
      <li class="nav-item mx-1">
        <a class="nav-link" href="{{route('home')}}" data-toggle="tooltip" data-placement="bottom" title="Go to Website" style="color: #64748b;">
          <i class="fas fa-home"></i>
        </a>
      </li>

      <div class="topbar-divider d-none d-sm-block mx-3" style="width: 1px; height: 30px; background: #e2e8f0; border: none;"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="text-end d-none d-lg-block me-2">
            <div class="small fw-bold text-dark mb-0">{{Auth()->user()->name}}</div>
            <div class="text-muted" style="font-size: 10px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">{{Auth()->user()->role}}</div>
          </div>
          <div class="profile-avatar shadow-sm" style="width: 40px; height: 40px; border-radius: 12px; overflow: hidden; border: 2px solid #fff;">
            @if(Auth()->user()->photo)
                <img src="{{Auth()->user()->photo}}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <img src="{{asset('backend/img/avatar.png')}}" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
          </div>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 animated--grow-in mt-3" aria-labelledby="userDropdown" style="border-radius: 20px; padding: 10px; min-width: 200px;">
          <a class="dropdown-item py-3 px-4 rounded-4" href="{{route('user-profile')}}">
            <i class="fas fa-user fa-sm fa-fw mr-3 text-primary opacity-50"></i>
            <span class="small fw-bold text-dark">Profile Settings</span>
          </a>
          <a class="dropdown-item py-3 px-4 rounded-4" href="{{route('user.change.password.form')}}">
            <i class="fas fa-key fa-sm fa-fw mr-3 text-primary opacity-50"></i>
            <span class="small fw-bold text-dark">Change Password</span>
          </a>
          <div class="dropdown-divider mx-3 my-2" style="border-top: 1px solid #f1f5f9;"></div>
          <a class="dropdown-item py-3 px-4 rounded-4" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-3 text-danger opacity-50"></i> 
                 <span class="small fw-bold text-danger">Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>

    </ul>

</nav>