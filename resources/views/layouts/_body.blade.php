@if (Auth::user())
    <style>
	    .nav > li{
		    display: inline-block !important;
		    width: 100%;
	    }
	    #sideNavbar .navbar-fixed-left .navbar-nav > li a{
		    text-align: left !important;
		    color:white;
	    }
	    .navbar-fixed-left .navbar-nav > li{
		    float: left !important;
	    }
        #sideNavbar .navbar .navbar-nav > li > a:not(.btn-just-icon) .fa{
            font-size: 15px !important;
            top: 1px !important;
            left: -5px !important;
        }
	  
	   .custom_bg{
		   background-color: #404E67;
	   }
	    .user_info{
		    width: 100%;
		    text-align: center;
		    padding-top: 20px;
	    }
	    .logo_wrap{
		    width: 100%;
		    text-align: center;
	    }
	
	    @media (min-width: 996px) {
		
		    /* width */
		    ::-webkit-scrollbar {
			    width: 6px;
		    }
		
		    /* Track */
		    ::-webkit-scrollbar-track {
			    box-shadow: inset 0 0 5px grey;
			    border-radius: 10px;
		    }
		
		    /* Handle */
		    ::-webkit-scrollbar-thumb {
			    background: #03a9f4;
			    border-radius: 10px;
		    }
		
		    /* Handle on hover */
		    ::-webkit-scrollbar-thumb:hover {
			    background: #b30000;
		    }
	    }
	 
    </style>
	<div class="container-fluid">
		<div class="col-md-2 col-sm-2 hidden-xs " id="sideNavbar" style="background-color: #404E67">
			
			
			<div class="navbar navbar-inverse navbar-fixed-left" style="width: 16%">
				<div class="logo_wrap">
					<img src="{{ asset('img/pharmacy_logo.png')}}" width="110">
					
				</div>
				<ul class="nav navbar-nav custom_bg" style="height: 616px;overflow-y: scroll">
					<li class="{{ set_active(['/', '/*']) }}">
						<div class="user_info">
							<span class="fa fa-user-circle-o"></span>
							<h6>
								{{ Auth::user()->name }}
							</h6>
						</div>
					
					</li>
					 <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-exchange fa fa-2x">
	                        </i>Transaction<span class="caret"></span></a>
                       
                        <ul class="dropdown-menu custom_bg" role="menu">
                            <li><a href="{{url('/sendmoney')}}"><i class="fa fa-money fa fa-2x" aria-hidden="true"></i>
                                    <p>  Send Money </p></a>
                            </li>
                            <li><a href="{{url('/receivemoney')}}"><i class="fa fa-credit-card fa fa-2x"
                                                                            aria-hidden="true"></i>
                                    <p> Received Money</p>
                                  </a>
                            </li>
                           
                            
                        </ul>
                    </li>
					<li class="dropdown" >
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-medkit fa fa-2x">
							</i>Medicine<span class="caret"></span></a>
						@if(outStockCount() + expiredCount() !== 0)
							<div class="col-md-1 col-md-offset-9 col-sm-offset-9" id="notif-circle-product">
								<span><p>{{outStockCount() + expiredCount()}}</p></span>
							</div>
						@endif
						<ul class="dropdown-menu custom_bg" role="menu">
							<li><a href="{{ url('product') }}"><i class="fa fa-pencil fa fa-2x" aria-hidden="true"></i>
									<p>  @lang('navbar.manage') </p></a></li>
							<li><a href="{{ url('/product/outstock') }}"><i class="fa fa-archive fa fa-2x"
							                                                aria-hidden="true"></i>
									<p>  @lang('navbar.outstock')</p>
									<span id="notif-circle"><p>{{outStockCount()}}</p></span></a></li>
							<li><a href="{{ url('/product/expired') }}"><i class="fa fa-exclamation-circle fa-2x"
							                                               aria-hidden="true"></i>
									<p>  @lang('navbar.outstock')</p><span
											id="notif-circle"><p>{{expiredCount()}}</p></span></a></li>
						
           
						</ul>
					</li>
                   
					<li class="{{ set_active(['sales', 'sales/*']) }}">
                        <a href="{{url('/sales/create')}}">
	                        <i class="fa fa-money fa" aria-hidden="true"></i> Sell
                        </a>
                    </li>
					<li class="{{ set_active(['sales', 'sales/*']) }}"><a href="{{url('/sales')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>Sales List</a></li>
					<li class="{{ set_active(['category', 'category/*']) }}">
                        <a href="{{url('/category')}}"><i class="fa fa-list"></i>Category </a>
                    </li>
					<li class="{{ set_active(['suppliers', 'suppliers/*']) }}">
                        <a href="{{url('/suppliers')}}"><i class="fa fa-truck"></i>Supplier </a>
                    </li>
					<li class="{{ set_active(['customers', 'customers/*']) }}"><a href="{{url('/customers')}}"><i class="fa fa-users"></i>Customers</a></li>
					<li class="{{ set_active(['analysis', 'analysis/*']) }}"><a href="{{url('/analysis')}}"><i class="fa fa-line-chart"></i>Analysis</a></li>
					<li class="{{ set_active(['users', 'users/*']) }}"><a href="{{url('/users')}}"><i class="fa fa-users"></i>Users</a></li>
					<li class="dropdown">
					<li class="dropup" data-toggle="tooltip">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-puzzle-piece"></i>Tools<span class="caret"></span></a>
						<ul class="dropdown-menu custom_bg" role="menu">
							<li><a href="{{url('/tools/discount')}}"><i class="fa  fa-sort-amount-desc fa fa-2x"
							                                            aria-hidden="true"></i>
									<p>  @lang('navbar.discount')</p></a></li>
							<li><a href="{{url('/tools/note')}}"><i class="fa fa-sticky-note-o fa fa-2x"
							                                        aria-hidden="true"></i>
									<p>  @lang('navbar.note')</p></a></li>
							<li><a href="{{url('/tools/dsearch')}}"><i class="fa fa-search fa fa-2x"
							                                           aria-hidden="true"></i>
									<p>  @lang('navbar.dsearch')</p></a></li>
						</ul>
					</li>
					<li class="dropup" id="settingNav" data-toggle="tooltip">
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sliders"></i>Setting <span
									class="caret"></span></a>
						<ul class="dropdown-menu custom_bg" role="menu">
							<li><a href="{{url('/setting/lt')}}"><i class="fa fa-globe fa fa-2x" aria-hidden="true"></i>
									<p>  @lang('navbar.lt')</p></a></li>
							<li><a href="{{url('/setting/printer')}}"><i class="fa fa-info-circle fa fa-2x"
							                                             aria-hidden="true"></i>
									<p>  @lang('navbar.printer')</p></a></li>
							<li><a href="{{url('/setting/other')}}"><i class="fa fa-barcode fa fa-2x"
							                                           aria-hidden="true"></i>
									<p> @lang('navbar.other')</p></a></li>
							<li><a href="{{url('/setting/backup')}}"><i class="fa fa-cloud fa fa-2x"
							                                            aria-hidden="true"></i>
									<p> @lang('navbar.backup')</p></a></li>
						
						</ul>
					</li>   <!-- end li #settingNav-->
				</ul>
			</div> <!-- end div .navbar -->
		</div> <!-- end div #sideNavbar -->
		
		@endif
		<div class="col-md-10 col-sm-10 col-xs-12 content">
			@yield('content')
		</div> <!-- end div #content -->
	</div> <!-- end div .container-fluid -->
