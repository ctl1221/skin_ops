<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5EC6C2">
  <a class="navbar-brand" href="/dashboard">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
  
   @role('sales')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="sales" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sales
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/clients/search">Search Client</a>
          <a class="dropdown-item" href="/clients/create">New Client</a>
          <a class="dropdown-item" href="/sales_orders">Sales Orders</a>
          <a class="dropdown-item" href="/payments">Client Payments</a>
          <a class="dropdown-item" href="/appointments">Calendar</a>
        </div>
    </li>
   @endRole


   @role('management')
   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="data" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Management
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/m_dashboard">Manager's Dashboard</a>
          <a class="dropdown-item" href="/slacks">Slack Messages</a>
          <a class="dropdown-item" href="/reports">Reports</a>
          <a class="dropdown-item" href="/sms_promotions">SMS Promotions</a>
          <a class="dropdown-item" href="/memberships">Memberships</a>
          <a class="dropdown-item" href="/payment_types">Payment Types</a>
          <a class="dropdown-item" href="/system_settings">System Settings</a>
        </div>
    </li>
    @endRole

    @role('management')
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="data" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Master Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/clients">Clients</a>
          <a class="dropdown-item" href="/services">Services</a>
          <a class="dropdown-item" href="/products">Products</a>
          <a class="dropdown-item" href="/packages">Packages</a>
          <a class="dropdown-item" href="/employees">Employees</a>
          <a class="dropdown-item" href="/pricelists">Pricelists</a>
          <a class="dropdown-item" href="/branches">Branches</a>
        </div>
     </li>
     @endRole


    @role('admin')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="data" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/users">Users</a>
          @role('it')
            <a class="dropdown-item" href="/bugs">Bugs</a>
            <a class="dropdown-item" href="/horizon" target="_blank">Laravel Horizon</a>
          @endRole
        </div>
    </li>
    @endRole

  </ul>

    <ul class="navbar-nav ml-auto">
      @guest
        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

      @else
      <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <b><u>{{ Auth::user()->branch->name }}</u></b> 
              &nbsp 
              {{ Auth::user()->name }} 
              <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/settings">Settings</a>
              <a class="dropdown-item" href="/bugs/create">Report A Bug</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      @endguest
    </ul>

  </div>

</nav>
