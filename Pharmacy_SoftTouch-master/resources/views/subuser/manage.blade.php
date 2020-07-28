@extends('layouts.branch-app')
@section('title', '| Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Branc Transection</div>

        <div class="panel-body">
            <div id="tablePanel">
              
            </div>  <!-- end div #tablePanel -->
            <hr> <!-- line -->
            <!--form-->
            <!--<div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-inline" method="GET" action="{{route('sendmoney.search') }}">
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
    <label for="pwd">Status</label>
    <select class="form-control" id="sel1" name="status">
    <option value="paid">Paid</option>
    <option value="unpaid">UnPaid</option>
    
  </select>
  </div>
</div>
<div class="col-md-3">
  <button type="submit" class="btn btn-success text-light">Search</button>
</div>
</div>
</form>
</div>

</div>--->
            <!--form-->
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="table-responsive">
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Branch Code</th>
      <th scope="col">User_ID</th>
      <th scope="col">Password</th>
      <th scope="col">Email</th>
      <th scope="col">Gsm</th>
     
      <th scope="col">Transection Summery</th>
      
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php($i=1)
    @foreach($details as $prov)
    @if(Session::get('customerId') == $prov->sub_branch_id)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td>{{$prov->add}}</td>
      <td>{{$prov->branch_id}}</td>
      <td>{{$prov->mpass}}</td>
      <td>{{$prov->email}}</td>
      
      <td>{{$prov->phone}}</td>
     
      <td>
         <a href="{{route('subuser.history',['add'=>$prov->id])}}" type="button" class="btn btn-info text-light">see detail</a>
      </td>
      <td>
        <a href="{{route('subuser.edit',['id'=>$prov->id])}}" type="button" class="btn btn-info text-light">edit</a>
        <!--<button  type="button" class="btn btn-danger text-light" onclick="deleteAgent({{ $prov->id }})">delete</button>-->
                    <form id="delete-form-{{ $prov->id }}" action="{{ route('subuser.destroy',$prov->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    
                                                </form>   


      </td>
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