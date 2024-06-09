{{-- Sidebar --}}
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    {{-- Nama produk --}}
    <div class="sidebar-brand">
      <a href="">Monitoring</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">PA</a>
    </div>
    @if(auth()->user()->role == 'admin')
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
          <a href="/dashboard/admin" class="nav-link"><i class="fas fa-columns"></i> <span>Chart Kendaraan</span></a>
        </li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown {{ request()->routeIs('company.*') || request()->routeIs('kendaraan.*') || request()->routeIs('driver.*')? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
          <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('company.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('company.index') }}">Data Perusahaan</a></li>
            <li class="{{ request()->routeIs('kendaraan.*') ? 'active' : '' }}"><a class="nav-link " href="{{ route('kendaraan.index') }}">Data Kendaraan</a></li> 
            <li class="{{ request()->routeIs('driver.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('driver.index') }}">Data Driver</a></li>
          </ul>
        </li>
        <li class="menu-header">Peminjaman</li>
        <li class="nav-item dropdown {{ request()->routeIs('pengajuan.*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Peminjaman</span></a>
          <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('pengajuan.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengajuan.create') }}">Buat Peminjaman</a></li>
            <li class="{{ request()->routeIs('pengajuan.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengajuan.index') }}">History Peminjaman</a></li>
          </ul>
        </li>
      </ul>
    @endif
    @if(auth()->user()->role == 'penjabat')
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->routeIs('dashboard.penjabat') ? 'active' : '' }}">
          <a href="/dashboard/penjabat" class="nav-link"><i class="fas fa-columns"></i> <span>Chart Kendaraan</span></a>
        </li>
        <li class="menu-header">Pengajuan</li>
        <li class="{{ request()->routeIs('pengajuan-kendaraan') ? 'active' : '' }}">
          <a href="/pengajuan-kendaraan" class="nav-link"><i class="fas fa-th-large"></i> <span>Pengajuan Kendaraan</span></a>
        </li>
      </ul>
    @endif
  </aside>
</div>