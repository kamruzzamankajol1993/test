@extends('layouts.branch-app')
@section('title', '| Send Money')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Send Money</div>

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
                  <div class="table-responsive">
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Sender Name</th>
         <th scope="col">Sender Nid</th>
      <th scope="col">Sender Number</th>
      <th scope="col">Sender Location</th>
   
     
      <th scope="col">Amount</th>
      <th scope="col">Cost</th>
      <th scope="col">Receiver Name</th>
      <th scope="col">Receiver Nid</th>
      <th scope="col">Receiver Location</th>
       
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($details as $key=>$prov)
  
    <tr>
        <th scope="row">{{ $key+1 }}</th>
        <form action="{{ route('branch.sendmoney.store') }}"  method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
        <th><input type="text" name="sender_name" value="{{$prov->sender_name}}"></th>
        <th><input type="text" name="sender_nid" value="{{$prov->sender_nid}}"></th>
        <th><input type="text" name="sender_number" value="{{$prov->sender_number}}"></th>
        <th><input type="text" name="sender_location" value="{{ Session::get('customerAddress') }}"></th>
        
        <th><input type="text" name="amount"></th>
        <th><input type="text" name="cost"></th>
        <th><input type="text" name="receiver_name" value="{{$prov->receiver_name}}"></th>
        <th><input type="text" name="receiver_nid" value="{{$prov->receiver_nid}}"></th>
        
        <th>
         <select name="receiver_location" id="pet-select">
    <option value="">--Please choose an option--</option>
    
    @foreach($bName as $name)
    <option value="{{ $name->add }}">{{ $name->add }}</option>
     
    @endforeach
    <option value="anywhere">Anywhere</option>
</select></th>
       
        <th>  
                           <script >
    $(document).ready(function () {
  $("#btnNewGroup").click(function () {        
       $("#newGroup").toggle();        
  });
});
        </script>                   
              <button  type="button" class="btn btn-info text-light" id="btnNewGroup">Yes</button>
              <div>
              <button type="submit" class="btn btn-success waves-effect" id="newGroup" style="display:none" name="submit" value="btn1">Submit</button>
              </div>
                            <script >
    $(document).ready(function () {
  $("#btnNewGroup1").click(function () {        
       $("#newGroup1").toggle();        
  });
});
        </script>                   
              <button  type="button" class="btn btn-danger text-light" id="btnNewGroup1">No</button>
              <div>
              <button type="submit" class="btn btn-success waves-effect" id="newGroup1" style="display:none" name="submit" value="btn2">print</button>
              </div>
                   </th>
                 </form>
    </tr>
   
    @endforeach

  </tbody>
</table>
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