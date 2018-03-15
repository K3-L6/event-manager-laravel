<header class="header">
  <nav class="navbar">
    <!-- Search Box-->
    <div class="search-box">
      <button class="dismiss"><i class="icon-close"></i></button>
      <form id="searchForm" action="#" role="search">
        <input type="search" placeholder="What are you looking for..." class="form-control" id="searchInput">
      </form>
    </div>
    <div class="container-fluid">
      <div class="navbar-holder d-flex align-items-center justify-content-between">
        <!-- Navbar Header-->
        <div class="navbar-header">
            <a href="/home" class="navbar-brand">
            <div class="brand-text brand-big hidden-lg-down"><span>EventManager</span><strong> Dashboard</strong></div>
            <div class="brand-text brand-small"><strong>EM</strong></div></a>
            <!-- Toggle Button-->
            <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
        </div>
        <!-- Navbar Menu -->
        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
          <!-- Search-->
          <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="fa fa-search"></i></a></li>
          <!-- Logout    -->
          <li class="nav-item">
            <form id="logout" action="{{ route('logout') }}" method="POST">
              {{ csrf_field() }}
              <a href="javascript:{}" class="nav-link logout" onclick="document.getElementById('logout').submit(); return false;">
                Logout
                <i class="fa fa-sign-out" aria-hidden="true"></i>
              </a>
            </form>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</header>