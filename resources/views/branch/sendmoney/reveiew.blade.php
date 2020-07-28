@extends('layouts.branch-app')
@section('title', '| Reveiew')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"></div>

        <div class="panel-body">
            <div id="tablePanel">
                <!--<a href="{{url('/sendmoney/add')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> Send
                    </button>
                </a>--->
            </div>  <!-- end div #tablePanel -->
            <hr> <!-- line -->
            <!--form-->
            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-inline" method="GET" action="{{route('branch.sendmoney.search') }}">
                <div class="row">
                    <div class="col-md-6">
  <div class="form-group">
    <label for="email">NID Number/Phone Number</label>
    <input type="text" name="from"  class="form-control" id="email">
  </div>
</div>

<div class="col-md-6">
  <button type="submit" class="btn btn-success text-light">Search</button>
</div>
</div>
</form>
</div>

</div>
            <!--form-->
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                              <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <b>Date:</b> {{$prov->date}}
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">

                    <h5><b>Sender Location:</b> {{$prov->sender_location}}</h5>
               
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <b>Time:</b> {{$prov->time}}
                </div>
            </div>
                            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Sender Name:</b> {{$prov->sender_name}}</h5>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Sender Nid:</b> {{$prov->sender_nid}}</h5>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Sender Number:</b> {{$prov->sender_number}}</h5>
                </div>
                
                        </div>
                        <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Pin:</b> {{$prov->pin}}</h5>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Amount:</b> {{$prov->amount}}</h5>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Cost:</b> {{$prov->cost}}</h5>
                </div>
                
                        </div>
                     <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Receiver Name:</b> {{$prov->receiver_name}}</h5>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Receiver Number:</b> {{$prov->receiver_number}}</h5>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Receiver Location:</b> {{$prov->receiver_location}}</h5>
                </div>
               
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-4">
                                       <form action="{{ route('bstatus.update') }}"  method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

<input type="hidden" name="id" value="{{$prov->id}}">
<input type="hidden" name="status" value="2">
<button  type="submit" class="btn btn-info text-light" id="btnNewGroup">Print</button>
          </form>
                                </div>
                                <div class="col-md-4">
                                    <button  type="button" class="btn btn-success text-light" data-toggle="modal" data-target="#myModal">Post</button> 
                                </div>
                                <div class="col-md-4">
                                     <a href="{{url('/branch/sendmoney')}}" type="button" class="btn btn-danger text-light" >Cancel</a> 
                                </div>
                            </div>
                          

       
                        </div>
                    </div>
                            
                
                    </div>
                </div>
                </div> <!-- end col-md-3 -->
            

        </div>  <!-- end div #provideDiv -->
    </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel-->
    <!--new-->
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-danger">Please Print Receipt Before Send Money</h4>
      </div>
      <div class="modal-body">
              <form action="{{ route('status.update') }}"  method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}


<input type="hidden" name="sender_name" value="{{$prov->sender_name}}">
<input type="hidden" name="sender_nid" value="{{$prov->sender_nid}}">
<input type="hidden" name="sender_number" value="{{$prov->sender_number}}">
<input type="hidden" name="sender_location" value="{{$prov->sender_location}}">
<input type="hidden" name="pin" value="{{$prov->pin}}">
<input type="hidden" name="amount" value="{{$prov->amount}}">
 <th><input type="hidden" name="cost" value="{{$prov->cost}}"></th>
        <th><input type="hidden" name="receiver_name" value="{{$prov->receiver_name}}"></th>
        <th><input type="hidden" name="receiver_number" value="{{$prov->receiver_number}}"></th>
        <th><input type="hidden" name="receiver_nid" value="{{$prov->receiver_nid}}"></th>
        <th><input type="hidden" name="receiver_location" value="{{$prov->receiver_location}}"></th>
<button  type="submit" class="btn btn-success text-light" id="btnNewGroup">Confirm</button>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <!--new-->
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
        function deleteAgent(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
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
function approveAgent(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to Active This User ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, active it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The Agent  Remain Inactive :)',
                        'info'
                    )
                }
            })
        }

         function inactiveAgent(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to Inactive This User ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, inactive it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('inactive-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The Agent  Remain Active :)',
                        'info'
                    )
                }
            })
        }
    </script>
@endsection