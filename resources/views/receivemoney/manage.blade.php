@extends('layouts.app')
@section('title', '| Receive Money')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Receive Money</div>

        <div class="panel-body">
            <div id="tablePanel">
                <!--<a href="{{url('/sendmoney/add')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> Send
                    </button>
                </a>-->
            </div>  <!-- end div #tablePanel -->
            <hr> <!-- line -->
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
            @foreach ($details as $prov)
            @if(Auth::user()->name == $prov->receiver_name)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div id="provideDiv">
                        <strong id="info">Receiver Name</strong>
                        <p>{{$prov->receiver_name}}</p>
                        <strong id="info">Receiver Number</strong>
                        <p>{{$prov->receiver_number}}</p>
                         <strong id="info">Sender Name</strong>
                        <p>{{$prov->sender_name}}</p>
                        <strong id="info">Sender Location</strong>
                        <p>{{$prov->sender_location}}</p>
                        <strong id="info">Pin Number</strong>
                        <p>{{$prov->pin}}</p>
                        <strong id="info">Amount</strong>
                        <p>{{$prov->receive_amount}}</p>
                        <strong id="info">Receiver NID Number</strong>
                        <p>{{$prov->reciver_nidnumber}}</p>
                       <div class="btnProviderDiv">
                         <!-- <button  type="button" class="btn btn-danger text-light" onclick="deleteAgent({{ $prov->id }})">delete</button>
                    <form id="delete-form-{{ $prov->id }}" action="{{ route('sendmoney.destroy',$prov->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    
                                                </form>-->
                      @if($prov->status == 0)                         
                    <a href="{{ route('receivemoney.edit',$prov->id) }}" type="button" class="btn btn-info text-light">Get the Money</a>
                   @else
                       <a href="{{route('receivemoney.print',['id'=>$prov->id])}}" type="button" class="btn btn-info text-light">Print Receipt</a>
                       <a href="{{route('receivemoney.show',['id'=>$prov->id])}}" type="button" class="btn btn-success text-light">View NID</a>
                   @endif
                        </div>  <!-- end div #btnProviderDiv -->
                    </div>
                </div> <!-- end col-md-3 -->
                @endif
            @endforeach

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