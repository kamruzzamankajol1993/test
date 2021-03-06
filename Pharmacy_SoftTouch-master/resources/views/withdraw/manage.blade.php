@extends('layouts.branch-app')
@section('title', '| Withdraw Money')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Withdraw Money</div>

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
            <form class="form-inline" method="GET" action="{{route('withdraw.search') }}">
                <div class="row">
                    <div class="col-md-6">
  <div class="form-group">
    <label for="email">Check Page Number</label>
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
 <!-- <hr>  
            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-inline" method="GET" action="{{route('sendmoney.search') }}">
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

</div>-->
            <!--form-->
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
     
      <th scope="col">Bank Name</th>
      <th scope="col">Check Number</th>
      <th scope="col">Check Page Number</th>
      <th scope="col">Amount</th>
      <th scope="col">Signature</th>
      <th scope="col">Bearer Name</th>
      <th scope="col">Designation</th>
      <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
     @php($i=1)
    @foreach($details as $prov)
    @if(Session::get('customerId') == $prov->branch_id)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td>{{ $prov->date }}</td>
      <td>
          @foreach($bankNames as $name)

        @if($name->id == $prov->bank_id)
        {{$name->bankname}}
         
        
        @endif
        @endforeach
    </td>
      <td>
        @foreach($checkNames as $name)

        @if($name->id == $prov->check_id)
        {{$name->check_no}}
         
        
        @endif
        @endforeach
    </td>
    <td>
      {{ $prov->checkpage_no }}
         
    </td>
    <td>
      {{ $prov->amount }}
    </td>
    <td>{{ $prov->signature }}</td>
    <td>{{ $prov->barreidBy }}</td>
    <td>{{ $prov->desi }}</td>
      
   </tr>
    @endif
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