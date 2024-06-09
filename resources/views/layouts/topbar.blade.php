{{-- Topbar --}}
<nav class="navbar navbar-expand-lg main-navbar">

  {{-- Search --}}
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    <div class="search-element">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
      <div class="search-backdrop"></div>
    </div>
  </form>

  {{-- Profile --}}   
  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block mr-2"> Selamat datang, {{ auth()->user()->name }}</div>
        <img class="img-profile rounded-circle" src="{{ asset('profile.jpg') }}">
      </a>
      <div class="dropdown-menu dropdown-menu-right">   
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item has-icon text-danger"  style="display: flex; align-items: center;">
              <i class="fas fa-sign-out-alt"></i>
              Logout
            </button>
          </form>
      </div>
    </li>
  </ul>
</nav>