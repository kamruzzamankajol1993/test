@extends('layouts.branch-app')
@section('title', '| Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Transection History Of <b>{{ $branchName }}</b></h3></div>

        <div class="panel-body">
            <div id="tablePanel">
               
            </div>  <!-- end div #tablePanel -->
           <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form class="form-inline" method="GET" action="{{route('new2.history') }}">
                <div class="row">
                    <div class="col-md-3">
  <div class="form-group">
    <label for="email">First date</label>
    <input type="date" name="from" value="<?php echo date("Y-m-d") ?>"  class="form-control" id="email">
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="pwd">Last date</label>
    <input type="date" name="to" value="<?php echo date("Y-m-d") ?>" class="form-control" id="pwd">
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="pwd">Status</label>
    <select class="form-control" id="sel1" name="status">
         <option value="send">Send Money History</option>
    <option value="receive">Receive Money History</option>
   
    
  </select>
  </div>
</div>
<div class="col-md-3">
  
  <button type="submit" class="btn btn-success text-light">Search</button>
</div>
</div>
</form> 
                   
    </div>               
                  
                    </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="table-responsive">
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
      <th scope="col">Cost</th>
      <th scope="col">Receiver Name</th>
      <th scope="col">Receiver Number</th>
      <th scope="col">Description</th>
      <th scope="col">Receiver Location</th>
       <th scope="col">Status</th>
      
    </tr>
  </thead>
  <tbody>
      @php($i=1)
    @foreach($details as $key=>$prov)
 @if( Session::get('customerAddress') == $prov->sender_location )
    <tr>
        <th scope="row">{{ $i++ }}</th>
        <th>{{$prov->date}}</th>
        <th>{{$prov->time}}</th>
        <th>{{$prov->sender_name}}</th>
         <th>{{$prov->sender_number}}</th>
          <th>{{$prov->sender_location}}</th>
        <th>{{$prov->sender_nid}}</th>
       <th>{{$prov->pin}}</th>
         <th>{{$prov->amount}}</th>
        <th>{{$prov->cost}}</th>
        <th>{{$prov->receiver_name}}</th>
        <th>{{$prov->receiver_number}}</th>
        <th>{{$prov->receiver_nid}}</th>
          <th>{{$prov->receiver_location}}</th>
       
        <th>
          @if($prov->status == 2 && $prov->get_status == 1)
        <span class="label label-success">Ready To Send</span>
        @elseif($prov->status == 1 && $prov->get_status == 0)
        <span class="label label-warning">Received</span>
        @elseif($prov->status == 2 && $prov->get_status == 0)
        <span class="label label-info">Send</span>
         @elseif($prov->status == 8 && $prov->get_status == 0)
        
        <span class="label label-danger">Please Try Again</span>
        @else
        
        @endif
       
      </th>
       
       
                 </form>
    </tr>
   @endif
    @endforeach
  </tbody>
</table>
    </div>               
                  
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                 
                   
    </div>               
                  
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