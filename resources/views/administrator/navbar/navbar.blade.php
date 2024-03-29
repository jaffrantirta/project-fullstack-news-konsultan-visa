
<!-- Main Navbar -->
  <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
    <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
      <div class="input-group input-group-seamless ml-3">
        <div class="input-group-prepend">
          {{-- <div class="input-group-text">
            <i class="fas fa-search"></i>
          </div> --}}
        </div>
        <input disabled class="navbar-search form-control" type="text"  aria-label="Search"> </div>
    </form>
    <ul class="navbar-nav border-left flex-row ">
      <li class="nav-item border-right dropdown notifications">
        <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="nav-link-icon__wrapper">
            <i class="material-icons">&#xE7F4;</i>
            {{-- <span class="badge badge-pill badge-danger">2</span> --}}
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
          {{-- <a class="dropdown-item" href="#">
            <div class="notification__content">
              <span class="notification__category">Tidak ada notifikasi saat ini</span>
            </div>
          </a> --}}
          {{-- <a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a> --}}
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="{{URL::to('admin/profile')}}" role="button" aria-haspopup="true" aria-expanded="false">
          <img class="user-avatar rounded-circle mr-2" src="{{ asset('res/assets_administrator/images/avatars/1.jpeg') }}" alt="User Avatar">
          <span class="d-none d-md-inline-block">{{Auth::user()->name}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-small">
          <a class="dropdown-item" href="{{URL::to('admin/profile')}}">
            <i class="material-icons">&#xE7FD;</i> Profile</a>
          <a class="dropdown-item" href="{{URL::to('admin/profile')}}">
            {{-- <i class="material-icons">vertical_split</i> Blog Posts</a> --}}
          <a class="dropdown-item" href="{{URL::to('admin/profile')}}">
            {{-- <i class="material-icons">note_add</i> Add New Post</a> --}}
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="material-icons text-danger">&#xE879;</i> Logout </a>
        </div>
      </li>
    </ul>
    <nav class="nav">
      <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
        <i class="material-icons">&#xE5D2;</i>
      </a>
    </nav>
  </nav>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>