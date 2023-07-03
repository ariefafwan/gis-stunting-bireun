<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li>
          <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="bi bi-window-sidebar"></i></a>
        </li>
        <li>
          <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="bi bi-search"></i></a>
        </li>
      </ul>
      <div class="search-element">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" />
        <button class="btn" type="submit"><i class="bi bi-search"></i></button>
      </div>
    </form>
    <ul class="navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          <img alt="profil" src="{{ asset('storage/profile/profil_img.jpg') }}" class="rounded-circle mr-1" />
          <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">Menu</div>
            <a href="#" class="dropdown-item has-icon"><i class="bi bi-person-circle"></i>&nbspProfile</a>
            <a href="#" class="dropdown-item has-icon"><i class="bi bi-gear"></i>&nbspSettings</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"><i class="bi bi-door-open"></i>&nbspLogout</a>
        </div>
      </li>
    </ul>
</nav>