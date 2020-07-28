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
			background: white;
			padding: 4px 0;
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
	   .position{
		   position: inherit !important;
	   }
	    .custom_p_l{
		    padding-left: 9px;
	    }
    </style>
	<style>
		.tree { background-color:#2C3E50; color:#46CFB0;}
		.tree li,
		.tree li > a,
		.tree li > span {
			padding: 4pt;
			border-radius: 4px;
		}

		.tree li a {
			color:#46CFB0;
			text-decoration: none;
			line-height: 20pt;
			border-radius: 4px;
		}

		.tree li a:hover {
			background-color: #34BC9D;
			color: #fff;
		}

		.active {
			background-color: #34495E;
			color: white;
		}

		.active a {
			color: #fff;
		}

		.tree li a.active:hover {
			background-color: #34BC9D;
		}
		.tree_p_l{
			padding-left: 1px !important;
		}
		.tree_typography{
			text-align: center;
			font-weight: bolder;
			font-size: 16px;
			font-family: Cabin Condensed,sans-serif;
		}
	</style>
	<div class="container-fluid">
		<div class="col-md-2 col-sm-2 hidden-xs " id="sideNavbar" style="height: 974.625px;">
			
			
			<div class="navbar navbar-inverse navbar-fixed-left" style="width: 100%;margin-bottom: 0px;padding-top: 0px">
				<div class="logo_wrap">
					<a href="{{URL::to('/')}}">
						<img src="{{ asset('img/pharmacy_logo.png')}}" width="110">
					</a>
					
					
				</div>
				<ul class="tree tree_p_l" style="padding-top: 20px">
					<li>
						<span class="tree_typography">
							Medicine
						</span>
						<ul class="tree_p_l">
							<li>
								<a href="{{ url('product') }}"><i class="fa fa-pencil fa fa-1x" aria-hidden="true"></i>
									<span class="custom_p_l tree_typography"> @lang('navbar.manage')</span></a>
							</li>
						</ul>
					</li>
					<li><span class="tree_typography">Money Exchange</span>
						<ul class="tree_p_l">
							<li><a href="{{url('/sendmoney')}}"><i class="fa fa-money fa fa-1x" aria-hidden="true"></i>
									<span class="custom_p_l tree_typography">  Send Money</span> </a>
							</li>
							<li>
								<a href="{{url('/receivemoney')}}"><i class="fa fa-credit-card fa fa-1x" aria-hidden="true"></i>
									<span class="custom_p_l tree_typography">Received Money</span>
								</a>
							</li>
							<li>
								<a href="{{url('/branch')}}"><i class="fa fa-credit-card fa fa-1x" aria-hidden="true"></i>
									<span class="custom_p_l tree_typography">Branch</span>
								</a>
							</li>
						</ul>
					</li>
					<li><span class="tree_typography">Sale</span>
						<ul class="tree_p_l">
							<li class="{{ set_active(['sales', 'sales/*']) }}">



								<a href="{{url('/sales/create')}}">
									<i class="fa fa-money fa" aria-hidden="true"></i><span class="custom_p_l tree_typography">
										 Add sale
									</span>
								</a>
							</li>
							<li class="{{ Request::is('sales') ? 'active' : '' }}"><a href="{{url('/sales')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i><span class="custom_p_l tree_typography">Sales List</span></a></li>

						</ul>
					</li>
					<li>
						<span class="tree_typography">Purchase</span>
						<ul class="tree_p_l">
							<li>
								<a href="{{route('purchase.create')}}"><i class="fa  fa-sort-amount-desc fa fa-1x"
																		  aria-hidden="true"></i>
									<span class="custom_p_l tree_typography">Add purchase</span>
								</a>
							</li>
							<li >
								<a href="{{route('purchase.index')}}"><i class="fa  fa-sort-amount-desc fa fa-1x"
																		 aria-hidden="true"></i>
									<span class="custom_p_l tree_typography">Purchase List</span>
								</a>
							</li>
						</ul>
					</li>


					


                   



					<li class="{{ set_active(['category', 'category/*']) }}">
						<a href="{{url('/category')}}"><i class="fa fa-list"></i><span class="custom_p_l tree_typography">Category</span> </a>
					</li>
					<li class="{{ set_active(['suppliers', 'suppliers/*']) }}">
						<a href="{{url('/suppliers')}}"><i class="fa fa-truck"></i><span class="custom_p_l tree_typography">Supplier</span> </a>
					</li>
					<li class="{{ set_active(['customers', 'customers/*']) }}"><a href="{{url('/customers')}}"><i class="fa fa-users"></i><span class="custom_p_l tree_typography">Customers</span></a></li>
					<li class="{{ set_active(['analysis', 'analysis/*']) }}"><a href="{{url('/analysis')}}"><i class="fa fa-line-chart"></i><span class="custom_p_l tree_typography">Analysis</span></a></li>
					<li class="{{ set_active(['users', 'users/*']) }}"><a href="{{url('/users')}}"><i class="fa fa-users"></i><span class="custom_p_l tree_typography">Users</span></a></li>
					<li>
						<span class="tree_typography">Tools</span>
						<ul class="tree_p_l">
							<li><a href="{{url('/tools/discount')}}"><i class="fa  fa-sort-amount-desc fa fa-1x"
																		aria-hidden="true"></i>
									<span class="custom_p_l tree_typography"> @lang('navbar.discount')</span></a></li>
							<li><a href="{{url('/tools/note')}}"><i class="fa fa-sticky-note-o fa fa-1x"
																	aria-hidden="true"></i>
									<span class="custom_p_l tree_typography"> @lang('navbar.note')</span></a></li>
							<li><a href="{{url('/tools/dsearch')}}"><i class="fa fa-search fa fa-1x"
																	   aria-hidden="true"></i>
									<span class="custom_p_l tree_typography"> @lang('navbar.dsearch')</span></a></li>
						</ul>
					</li>
					<li><span class="tree_typography">Setting</span>
					<ul class="tree_p_l">
						<li><a href="{{url('/setting/lt')}}"><i class="fa fa-globe fa fa-2x" aria-hidden="true"></i>
								<span class="custom_p_l tree_typography"> @lang('navbar.lt')</span></a></li>
						<li><a href="{{url('/setting/printer')}}"><i class="fa fa-info-circle fa fa-1x"
																	 aria-hidden="true"></i>
								<span class="custom_p_l tree_typography"> @lang('navbar.printer')</span></a></li>
						<li><a href="{{url('/setting/other')}}"><i class="fa fa-barcode fa fa-1x"
																   aria-hidden="true"></i>
								<span class="custom_p_l tree_typography"> @lang('navbar.other')</span></a></li>
						<li><a href="{{url('/setting/backup')}}"><i class="fa fa-cloud fa fa-1x"
																	aria-hidden="true"></i>
								<span class="custom_p_l tree_typography"> @lang('navbar.backup')</span></a></li>
					</ul>
					</li>
				</ul>
			</div> <!-- end div .navbar -->
		</div> <!-- end div #sideNavbar -->
		
		@endif
		<div class="col-md-10 col-sm-10 col-xs-12 content">
			@yield('content')
		</div> <!-- end div #content -->
	</div> <!-- end div .container-fluid -->

