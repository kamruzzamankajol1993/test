<div id="app">
   <!-- <div id="cover"></div>  end div #cover -->
    <style>
        @media (max-width: 886px) {
    
            .logo_mobile{
                display: inline-block !important;
            }
        }
        
    </style>
   
        <nav class="navbar navbar-info navbar-static-top navbar-fixed ">
            <div class="navbar-header col-md-offset-1 col-sm-offset-1">
                <!-- Collapsed  -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a href="{{ url('/') }}" class="logo_mobile" style="display: none">
                    <img src="{{ asset('img/pharmacy_logo.png')}}" width="110">
                </a>
            </div>

            <div class="col-md-4 col-sm-5 col-md-offset-2 col-sm-offset-2 " id="searchBox" style="margin-top: 15px;">
                <div id="custom-search-input">
                    
                    @if(Session::get('customerFund') == 1);
                    <div class="input-group ">
                       <p>Branch Name:<b style="border-right: 2px solid;
    padding-right: 7px">{{ Session::get('customerAddress') }}</b></p>
                    </div>
                    @else
                     <div class="input-group ">
                       <p>Branch Name:<b style="border-right: 2px solid;
    padding-right: 7px">{{ Session::get('customerAddress') }}</b><span style="padding:5px;">Avaulable Balance:<b class="label label-success">{{Session::get('customerAmount')}}</b></span></p>
                    </div>
                    @endif
                </div>
                <div class="col-md-10" id="resultSearchBox">
            </div>
</div>  <!-- end div #searchDiv -->
<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
        &nbsp;
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        <li class="dropdown" id="logout">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="fa fa-user-circle-o"></span>
                {{ Session::get('customerName') }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href=""><span class="fa fa-edit"></span> @lang('navbar.account')</a>
                </li>
              <li>
                    <a href="{{ route('branch_logout') }}">
                        <span class="fa fa-sign-out"></span>
                        @lang('navbar.logout')
                    </a>
                   
                </li>
            </ul>
        </li>

        <!-- Phone only -->
        <ul class="nav navbar-nav navbar-right nav-menu-phone hidden-lg hidden-md hidden-lg hidden-md hidden-lg hidden-md hidden-sm">
           
            <li class=""><a href=""><i
                            class="fa fa-money fa fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">Add Customer</p></a></li>

           
           
          
        </ul>
    </ul>
    <!-- End phone -->
   
</div>
</nav> <!-- end nav -->
</div>