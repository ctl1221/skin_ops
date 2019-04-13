<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
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
          <a class="dropdown-item" href="/appointments">Appointments</a>
        </div>
    </li>
   @endRole


   @role('management')
   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="data" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Management
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/promotions">Promotions</a>
          <a class="dropdown-item" href="/giftcertificates">Gift Certificates</a>
          <a class="dropdown-item" href="/overridekeys">Override Keys</a>
          <a class="dropdown-item" href="/memberships">Memberships</a>

        </div>
    </li>
    @endRole


    @role('management')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="data" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/reports/sales">Report - Sales</a>
          <a class="dropdown-item" href="/reports/services">Report - Services</a>
          <a class="dropdown-item" href="/reports/products">Report - Products</a>
          <a class="dropdown-item" href="/reports/packages">Report - Packages</a>
          <a class="dropdown-item" href="/reports/branches">Report - Branches</a>
          <a class="dropdown-item" href="/reports/clients">Report - Clients</a>
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
          <a class="dropdown-item" href="/lusers/view">Users</a>
          <a class="dropdown-item" href="/pmusers">PM Users</a>
        </div>
    </li>
    @endRole

  </ul>

    {{-- <ul class="navbar-nav ml-auto">
      @guest
        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

     @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/settings">Settings</a>
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
    </ul> --}}



  </div>

</nav>
