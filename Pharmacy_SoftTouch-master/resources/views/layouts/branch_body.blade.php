
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
	   .position{
		   position: inherit !important;
	   }
	    .custom_p_l{
		    padding-left: 9px;
	    }
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
		<div class="col-md-2 col-sm-2 hidden-xs " id="sideNavbar" style="background-color: #404E67">


			<div class="navbar navbar-inverse navbar-fixed-left" style="width: 100%">
				<div class="logo_wrap">
					<a href="">
						<img src="{{ asset('img/pharmacy_logo.png')}}" width="110">
					</a>


				</div>
				<ul class="tree tree_p_l" style="height: 616px;overflow-y: scroll">
					<li class="">
						<div class="user_info">
							<span class="fa fa-user-circle-o"></span>
							<h6>
								{{ Session::get('customerName') }}
							</h6>
							<p>{{Session::get('customerEmail')}}</p>

						</div>

					</li>




                    @if(Session::get('customerStatus') == 1)
                    @if(Request::is('branch/sendmoney/search'))
                    <li class="">
                        <a  onclick="deleteTag(1)"><i class="fa fa-list" ></i>Add Customer</a >
                    </li>
                    <form id="delete-form-1" action="{{ route('redir1',1) }}" method="POST" style="display: none;">
                                                     {{ csrf_field() }}

                                                </form>


<script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,Click Here!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

                    @else
                    <li class="">
                        <a href="{{url('/sub_branch')}}" ><i class="fa fa-list"></i>Add Customer</a>
                    </li>

                    @endif
                    @if(Request::is('branch/sendmoney/search'))
                  <li class="">
                        <a  onclick="deleteTag1(2)"><i class="fa fa-list" ></i>Send Money</a >
                    </li>
                    <form id="delete-form-2" action="{{ route('redir2',2) }}" method="POST" style="display: none;">
                                                     {{ csrf_field() }}

                                                </form>


<script type="text/javascript">
        function deleteTag1(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,Click Here!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
                    @else
                    <li class="">
                        <a href="{{url('/branch/sendmoney')}}"><i class="fa fa-list"></i>Send Money</a>
                    </li>
                    @endif

                    @if(Request::is('branch/sendmoney/search'))
                     <li class="">
                        <a  onclick="deleteTag2(3)"><i class="fa fa-list" ></i>Receive Money</a >
                    </li>
                    <form id="delete-form-3" action="{{ route('redir3',3) }}" method="POST" style="display: none;">
                                                     {{ csrf_field() }}

                                                </form>


<script type="text/javascript">
        function deleteTag2(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,Click Here!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
                    @else
                     <li class="">
                        <a href="{{url('/branch/receivemoney')}}"><i class="fa fa-cart-plus"></i>Receive Money</a>
                    </li>
                    @endif

                    @else
                    <li class="">
                        <a href="{{url('/user_profile')}}"> <span class="tree_typography">Create user</span></a>
                    </li>
                   <li class="" >

                       <span class="tree_typography">Money Exchange History</span>
                        <ul class="tree_p_l custom_bg" role="menu">
                            <li><a href="{{url('/sub_user')}}"><i class="fa fa-money fa fa-1x" aria-hidden="true"></i>
		                            <span class="custom_p_l">User History</span> </a>
                            </li>
                            <li><a href="{{url('/all/history')}}"><i class="fa fa-credit-card fa fa-1x" aria-hidden="true"></i>
		                            <span class="custom_p_l">Branch History</span>
                                  </a>
                            </li>

                            <li><a href="{{url('/sub_user/sender/history/')}}"><i class="fa fa-credit-card fa fa-1x" aria-hidden="true"></i>
		                            <span class="custom_p_l">Sender History</span>
                                  </a>
                            </li>


                        </ul>
                    </li>
                     <li class="dropdown" >
                         <span class="tree_typography">Fund Section</span>


                        <ul class="tree_p_l" >
                            <li><a href="{{url('/fund')}}"><i class="fa fa-money fa fa-1x" aria-hidden="true"></i>
		                            <span class="custom_p_l">Assaign Fund</span> </a>
                            </li>
                            <li><a href="{{url('/fund/return')}}"><i class="fa fa-credit-card fa fa-1x" aria-hidden="true"></i>
		                            <span class="custom_p_l">Return Fund</span>
                                  </a>
                            </li>

                            <li><a href="{{url('/fund/history')}}"><i class="fa fa-credit-card fa fa-1x" aria-hidden="true"></i>
		                            <span class="custom_p_l">Fund History</span>
                                  </a>
                            </li>


                        </ul>
                    </li>
                        <li class="">
                            <span class="tree_typography">
							Account Section
						</span>
    <ul class="tree_p_l" style="background-color: #3B4767;">

      <!--bank section-->

       <li>
           <span class="tree_typography">Bank</span>
        <ul class="tree_p_l" style="background-color: #3B4767;">

          <li><a tabindex="-1" href="{{url('/bank')}}">Create Bank</a></li>
          <li><a tabindex="-1" href="{{url('/deposite')}}">Cash Deposite</a></li>
          <li><a tabindex="-1" href="{{url('/withdraw')}}">Cash Withdraw</a></li>

        </ul>
      </li>

      <!--bank section-->
      <!-- fund receive section-->
       <li class="">
           <span class="tree_typography">
							Fund Receive
						</span>
        <ul class="tree_p_l" style="background-color: #3B4767;">
             <li class="" style="background-color: #3B4767;">
            <span class="tree_typography">Head Office</span>
            <ul class="tree_p_l" style="background-color: #3B4767;">
              <li><a href="#">Bank</a></li>

            </ul>
          </li>
          <li class="dropdown-submenu" style="background-color: #3B4767;">
              <span class="tree_typography">
							Branch
						</span>

            <ul class="tree_p_l" style="background-color: #3B4767;">
              <li><a href="#">Bank</a></li>
             <li><a href="#">Cash</a></li>

            </ul>
          </li>
          <li><a tabindex="-1" href="#">Limited User Fund</a></li>


        </ul>
      </li>
      <!--fund receve section-->
      <!--fund transfer-->
          <li >
        <span class="tree_typography">Fund Transfer</span>
        <ul class="tree_p_l" style="background-color: #3B4767;">
             <li class="" style="background-color: #3B4767;">
            <span class="tree_typography">Head Office</span>
            <ul class="tree_p_l" style="background-color: #3B4767;">
              <li><a href="#">Bank</a></li>

            </ul>
          </li>
          <li class="" style="background-color: #3B4767;">
           <span class="tree_typography">Branch</span>
            <ul class="tree_p_l" style="background-color: #3B4767;">
              <li><a href="#">Bank</a></li>
             <li><a href="#">Cash</a></li>

            </ul>
          </li>
          <li><a tabindex="-1" href="#">Limited User Fund</a></li>


        </ul>
      </li>
      <!--fund transfer-->
      <li><a tabindex="-1" href="#">History</a></li>

    </ul>
  </li>
  <script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
                    @endif
					<!--<li class="">
                        <a href="{{url('/branch/history')}}"><i class="fa fa-cart-plus"></i>History</a>
                    </li>-->

				</ul>
			</div> <!-- end div .navbar -->
		</div> <!-- end div #sideNavbar -->


		<div class="col-md-10 col-sm-10 col-xs-12 content">
			@yield('content')
		</div> <!-- end div #content -->
	</div> <!-- end div .container-fluid -->
