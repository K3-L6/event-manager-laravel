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
    <li> <a href="/admin/event"><i class="fa fa-calendar" aria-hidden="true"></i>Event</a></li>
    <li> <a href="/admin/subevent"><i class="fa fa-clock-o" aria-hidden="true"></i>Sub Event</a></li>
    <li> <a href="/admin/guest"><i class="fa fa-users" aria-hidden="true"></i>Guests</a></li>
    {{-- <li> <a href="/admin/report"><i class="fa fa-bar-chart" aria-hidden="true"></i>Reports</a></li> --}}
    <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"><i class="fa fa-bar-chart" aria-hidden="true"></i>Reports</a>
      <ul id="dashvariants" class="collapse list-unstyled">
        <li><a href="/admin/report/alltypeguestlist">All Type Guest List</a></li>
        <li><a href="/admin/report/walkinguestlist">Walk-In Guest List</a></li>
        <li><a href="/admin/report/preregguestlist">Pre-Reg Guest List</a></li>
        <li><a href="/admin/report/alltypeguestlogs">All-Type Guest Logs</a></li>
        <li><a href="/admin/report/walkinguestlogs">Walk-In Guest Logs</a></li>
        <li><a href="/admin/report/preregguestlogs">Pre-Reg Guest Logs</a></li>
        <li><a href="#">Sub Event Reports</a></li>
      </ul>
    </li>
    <li> <a href="/admin/audit"><i class="fa fa-history" aria-hidden="true"></i>Audit Trail</a></li>
    <li> <a href="/admin/setting"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
  </ul>
    
</nav>