<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Pages</li>
    <li class="nav-item">
      <a class="@if (Route::is('home')) nav-link @else nav-link collapsed @endif" href="{{ route('home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Menu</li>

    <li class="nav-item">
      <a class="@if (Route::is('kecamatan.index')) nav-link @else nav-link collapsed @endif" href="{{ route('kecamatan.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Daftar Kecamatan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('tahun.index')) nav-link @else nav-link collapsed @endif" href="{{ route('tahun.index') }}">
        <i class="bi bi-calendar-range"></i>
        <span>Periode Tahun</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('data.index')) nav-link @else nav-link collapsed @endif" href="{{ route('data.index') }}">
        <i class="bi bi-briefcase"></i>
        <span>Data Kasus</span>
      </a>
    </li>
    <!-- End Profile Page Nav -->

  </ul>

</aside>
<!-- End Sidebar-->