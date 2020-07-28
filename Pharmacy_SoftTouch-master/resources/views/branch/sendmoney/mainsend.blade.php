@extends('layouts.branch-app')
@section('title', '| Reveiew')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Send</div>

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
                        @if($prov->status == 8)
                        <h1 class="text-danger">Please Print First</h1>
                        @else
                        
                        <div class="panel-body">
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
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Sender Location:</b> {{$prov->sender_location}}</h5>
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
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <h5><b>Receiver Name:</b> {{$prov->receiver_name}}</h5>
                </div>
                        </div>
                     <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h5><b>Description:</b> {{$prov->receiver_nid}}</h5>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h5><b>Receiver Location:</b> {{$prov->receiver_nid}}</h5>
                </div>
               
                        </div>
                        <div class="panel-footer">
                            <form action="{{ route('status.update') }}"  method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

<input type="hidden" name="id" value="{{$prov->id}}">
<input type="hidden" name="status" value="0">
<button  type="submit" class="btn btn-info text-light" id="btnNewGroup">Post</button>
          </form> 

       
                        </div>
                    </div>
                  @endif          
                
                    </div>
                </div>
                </div> <!-- end col-md-3 -->
            

        </div>  <!-- end div #provideDiv -->
    </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel-->
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