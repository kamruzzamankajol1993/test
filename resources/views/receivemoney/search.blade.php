@extends('layouts.branch-app')
@section('title', '| Receive Money')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Search History</div>

        <div class="panel-body">
            <div id="tablePanel">
               
            </div>  <!-- end div #tablePanel -->
            <hr> <!-- line -->
            <!--form-->
       <hr> <!-- line -->
            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-inline" method="GET" action="{{route('receivemoney.search') }}">
                <div class="row">
                    <div class="col-md-4">
  <div class="form-group">
    <label for="email">First date</label>
    <input type="date" name="from" value="<?php echo date("Y-m-d") ?>"  class="form-control" id="email">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
    <label for="pwd">Last date</label>
    <input type="date" name="to" value="<?php echo date("Y-m-d") ?>" class="form-control" id="pwd">
  </div>
</div>

<div class="col-md-4">
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
                          <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
       <th scope="col">Date</th>
        <th scope="col">Time</th>
      <th scope="col">Sender Name</th>
      <th scope="col">Sender Number</th>
      <th scope="col">Sender Location</th>
      <th scope="col">Sender Nid</th>
      <th scope="col">Pin Number</th>
      <th scope="col">Amount</th>
     
      <th scope="col">Receiver Name</th>
      <th scope="col">Receiver Number</th>
       <th scope="col">Receiver By</th>
       <th scope="col">Status</th>
      
    </tr>
  </thead>
  <tbody>
    @foreach($details as $key=>$prov)
 @if( Session::get('customerAddress') == $prov->receiver_location && Session::get('customerId') == $prov->branch_id || Session::get('customerAddress') == $prov->user_id )
    <tr>
        <th scope="row">{{ $key+1 }}</th>
       <th>{{$prov->date}}</th>
        <th>{{$prov->time}}</th>
        <th>{{$prov->sender_name}}</th>
        <th>{{$prov->sender_number}}</th>
        <th>{{ $prov->sender_location }}</th>
        <th>{{$prov->sender_nid}}</th>
        <th>{{ $prov->pin }}</th>
        <th>{{ $prov->amount }}</th>
        <th>{{$prov->receiver_name}}</th>
        <th>{{$prov->receiver_number}}</th>
        <th>
            @if($prov->receiver_location == "anywhere")
           Anywere\ {{$prov->user_id}}
            @else
            {{ $prov->receiver_location}}
            @endif
        </th>
        <th>
             @if($prov->status == 5)
        <span class="label label-warning">Received</span>
        @else
        <span class="label label-success">Avaiable</span>
        @endif
       </th>
       
       
                 
    </tr>
   @endif
    @endforeach
  </tbody>
</table>
                   
                
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