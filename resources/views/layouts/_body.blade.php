@if (Auth::user())
    <div class="container-fluid">
        <div class="col-md-1 col-sm-1 hidden-xs" id="sideNavbar">
            <div class="navbar navbar-inverse navbar-fixed-left">

                <ul class="nav navbar-nav">
                    <!--dashboard-->
        <li class="{{ set_active(['/', '/*']) }}"><a href="{{url('/')}}" title=" @lang('navbar.dashboard')"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Dashboard</span></a></li>
                        <!--dashboard-->
<!--medicine-->
                    <li class="dropdown" title=" @lang('navbar.products')" style="padding-right:15px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-medkit">
                            </i><span>Medicine</span><span class="caret"></span></a>
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
                            </a></li>
                        </ul>
                    </li>
                    <!--medicine-->
                    <!--pos-->
                    <li class="{{ set_active(['sales', 'sales/*']) }}" style="padding-right: 53px;"><a href="{{url('/sales/create')}}"
                                                                          title="@lang('navbar.sell')"
                                                                          ><i
                                    class="fa fa-money fa" aria-hidden="true"></i><span>Pos</span></a></li>
                      <!--pos-->
                   <!--sales-->
                    <li class="{{ set_active(['sales', 'sales/*']) }}" style="padding-right: 53px;"><a href="{{url('/sales')}}"
                                    title="@lang('navbar.sales')"><i
                                    class="fa fa-cart-plus" aria-hidden="true"></i><span>Sales</span></a></li>
                    <!--sales-->
                    <!--categories-->
                    <li class="{{ set_active(['category', 'category/*']) }}" style="padding-right:13px;"><a href="{{url('/category')}}" title="@lang('navbar.category')" ><i
                                    class="fa fa-list" aria-hidden="true"></i><span>Categories</span></a></li>
                    <!--categories-->
                    <!--supply-->
                    <li class="{{ set_active(['suppliers', 'suppliers/*']) }}" style="padding-right: 36px;"><a href="{{url('/suppliers')}}"
                                                                                  title="@lang('navbar.provider')"
                                                                                  ><i
                                    class="fa fa-truck " aria-hidden="true"></i><span>Supplies</span></a></li>
                    <!--supply-->
                    <!--customer-->
                    <li class="{{ set_active(['customers', 'customers/*']) }}" style="padding-right: 31px;"><a href="{{url('/customers')}}"
                                                                                  title="@lang('navbar.customers')"
                                                                                  ><i
                                    class="fa fa-users" aria-hidden="true"></i><span>Customer</span></a></li>
                    <!--customer-->
                    <!--analysic-->
                    <li class="{{ set_active(['analysis', 'analysis/*']) }}" style="padding-right: 42px;"><a href="{{url('/analysis')}}"
                                                                                title=" @lang('navbar.analysis')"
                                                                              ><i
                                    class="fa fa-line-chart" aria-hidden="true"></i><span>Analysic</span></a></li>
                    <!--analysic-->
                    <!--user-->
                    <li class="{{ set_active(['users', 'users/*']) }}" style="padding-right: 67px;"><a href="{{url('/users')}}"
                                                                          title="@lang('navbar.users')"
                                                                          ><i
                                    class="fa fa-user-md" aria-hidden="true"></i><span>User</span></a></li>
                                    <!--user-->
                                    <!--medicine-->
                    <li class="dropdown" title=" @lang('navbar.products')" style="padding-right:15px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money">
                            </i><span>Money Transection</span><span class="caret"></span></a>
                        @if(outStockCount() + expiredCount() !== 0)
                            <div class="col-md-1 col-md-offset-9 col-sm-offset-9" id="notif-circle-product">
                                <span><p>{{outStockCount() + expiredCount()}}</p></span>
                            </div>
                        @endif
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('product') }}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                    <p> Send Money </p></a></li>
                            <li><a href="{{ url('product') }}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                    <p>Received Money</p></a></li>
                        </ul>
                    </li>
                    <!--medicine-->
                    <li class="dropdown">
                        <!--tools-->
                    <li class="dropup" title="@lang('navbar.tools')" style="margin-right:58px; ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-puzzle-piece">
                            </i><span>Tools</span><span class="caret"></span></a>
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
                    <--tools-->
                    <!--setting-->
                    <li class="dropup" id="settingNav" title="@lang('navbar.setting')"  style="margin-right:58px; ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sliders">
                            </i><span>Setting</span><span class="caret"></span></a>
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
                    </li> <!--setting-->  <!-- end li #settingNav-->
                </ul>
            </div> <!-- end div .navbar -->
        </div> <!-- end div #sideNavbar -->

        @endif
        <div class="col-md-11 col-sm-11 col-xs-12 content">
            @yield('content')
        </div> <!-- end div #content -->
    </div> <!-- end div .container-fluid -->
