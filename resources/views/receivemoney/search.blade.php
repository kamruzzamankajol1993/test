@extends('layouts.app')
@section('title', '| Send Money')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Send Money</div>

        <div class="panel-body">
            <div id="tablePanel">
                <a href="{{url('/receivemoney/add')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i>Receive
                    </button>
                </a>
            </div>  <!-- end div #tablePanel -->
            <hr> <!-- line -->
            <!--form-->
            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-inline" method="GET" action="{{route('receivemoney.search') }}">
                <div class="row">
                    <div class="col-md-3">
  <div class="form-group">
    <label for="email">First date</label>
    <input type="date" name="from"  class="form-control" id="email">
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="pwd">Last date</label>
    <input type="date" name="to" class="form-control" id="pwd">
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="pwd">Nid Number</label>
    <input type="text" name="reciver_nidnumber" class="form-control" id="pwd">
  </div>
</div>
<div class="col-md-3">
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
      <th scope="col">Sender Name</th>
      <th scope="col">Pin Number</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($details as $key=>$prov)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td>{{$prov->sender_name}}</td>
      <td>{{$prov->pin}}</td>
      <td>{{$prov->receive_amount}}</td>
     
      <td>
        <button  type="button" class="btn btn-danger text-light" onclick="deleteAgent({{ $prov->id }})">delete</button>
                    <form id="delete-form-{{ $prov->id }}" action="{{ route('receivemoney.destroy',$prov->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    
                                                </form>   


      </td>
    </tr>
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