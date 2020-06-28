@if (Auth::user())
    <style>
        #sideNavbar .navbar .navbar-nav > li > a:not(.btn-just-icon) .fa{
            font-size: 15px !important;
            top: 1px !important;
            left: 2px !important;
        }
    </style>
	<div class="container-fluid">
		<div class="col-md-2 col-sm-2 hidden-xs" id="sideNavbar">
			<div class="navbar navbar-inverse navbar-fixed-left" style="width: 11%">
				
				<ul class="nav navbar-nav">
					<li class="{{ set_active(['/', '/*']) }}"><a href="{{url('/')}}" ><img src="{{ asset('img/logo.png')}}" width="110"></a></li>
					<li class="dropdown" >
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Medicine<i class="fa fa-medkit fa fa-2x">
							</i><span class="caret"></span></a>
						@if(outStockCount() + expiredCount() !== 0)
							<div class="col-md-1 col-md-offset-9 col-sm-offset-9" id="notif-circle-product">
								<span><p>{{outStockCount() + expiredCount()}}</p></span>
							</div>
						@endif
						<ul class="dropdown-menu" role="menu">
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
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaction<i class="fa fa-exchange fa fa-2x">
                            </i><span class="caret"></span></a>
                       
                        <ul class="dropdown-menu" role="menu">
                            <li><a href=""><i class="fa fa-money fa fa-2x" aria-hidden="true"></i>
                                    <p>  Send Money </p></a>
                            </li>
                            <li><a href=""><i class="fa fa-credit-card fa fa-2x"
                                                                            aria-hidden="true"></i>
                                    <p> Received Money</p>
                                  </a>
                            </li>
                           
                            
                        </ul>
                    </li>
					<li class="{{ set_active(['sales', 'sales/*']) }}">
                        <a href="{{url('/sales/create')}}">
                            Sell <i class="fa fa-money fa" aria-hidden="true"></i>
                        </a>
                    </li>
					<li class="{{ set_active(['sales', 'sales/*']) }}"><a href="{{url('/sales')}}">Sales List<i class="fa fa-cart-plus" aria-hidden="true"></i></a></li>
					<li class="{{ set_active(['category', 'category/*']) }}">
                        <a href="{{url('/category')}}">Category <i class="fa fa-list"></i></a>
                    </li>
					<li class="{{ set_active(['suppliers', 'suppliers/*']) }}">
                        <a href="{{url('/suppliers')}}">Supplier <i class="fa fa-truck"></i></a>
                    </li>
					<li class="{{ set_active(['customers', 'customers/*']) }}"><a href="{{url('/customers')}}">Customers<i class="fa fa-users"></i></a></li>
					<li class="{{ set_active(['analysis', 'analysis/*']) }}"><a href="{{url('/analysis')}}">Analysis<i class="fa fa-line-chart"></i></a></li>
					<li class="{{ set_active(['users', 'users/*']) }}"><a href="{{url('/users')}}">Users<i class="fa fa-users"></i></a></li>
					<li class="dropdown">
					<li class="dropup" data-toggle="tooltip">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools<span class="caret"></span><i class="fa fa-puzzle-piece"></i></a>
						<ul class="dropdown-menu" role="menu">
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
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <i class="fa fa-sliders"></i><span
									class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
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
