<nav class="side-navbar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="{{ asset('/img/user/' . Auth::user()->avatar) }}"  class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h4">{{ ucwords(Auth::user()->firstname) . ' ' . ucwords(Auth::user()->lastname) }}</h1>
      <p>{{ucwords(Auth::user()->role->name)}}</p>
    </div>
  </div>
  <span class="heading">Main</span>
  <ul class="list-unstyled">
    <li> <a href="/admin"><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a></li>
    <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"><i class="fa fa-calendar" aria-hidden="true"></i> Event </a>
      <ul id="dashvariants" class="collapse list-unstyled">
        <li><a href="/admin/event">Event Details</a></li>
        <li><a href="#">Start Entrance Log</a></li>
        <li><a href="#">Start Exit Log</a></li>
      </ul>
    </li>
    <li> <a href="/subevent"><i class="fa fa-clock-o" aria-hidden="true"></i>Sub Event</a></li>
    <li> <a href="/guest"><i class="fa fa-users" aria-hidden="true"></i>Guests</a></li>
    <li> <a href="/sponsor"><i class="fa fa-bar-chart" aria-hidden="true"></i>Reports</a></li>
    <li> <a href="/history"><i class="fa fa-history" aria-hidden="true"></i>History</a></li>
    <li> <a href="/setting"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
  </ul>
    
</nav>