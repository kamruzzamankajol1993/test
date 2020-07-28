@extends('layouts.branch-app')
@section('title', '| Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><b>{{ $bankName }}</b> Bank,<b>{{ $branchName }}</b> branch Information</div>

        <div class="panel-body">
            <div id="tablePanel">
                <!--<a href="{{url('/bank/create')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i>Create Bank
                    </button>
                </a>-->
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
                 <div class="col-md-6 col-sm-6 col-xs-6">
                   <div class="table-responsive">
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Check No</th>
      <th scope="col">Check Page No</th>
   
    </tr>
  </thead>
  <tbody>
      @php($i=1)
    @foreach($details as $prov)
    @if(Session::get('customerId') == $prov->branch_id)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td>{{$prov->check_no}}</td>
      <td>
        @foreach($details1 as $prov1)
        @if($prov->id == $prov1->check_id )
        {{$prov1->checkpage_no}},
        @endif
    @endforeach
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
    </div>               
                   
                    </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <h6>Add Check Info</h6>
                         <form action="{{ route('check.store') }}" class="" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
               
                <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd"><b>Check No:</b></label>
    <div class="">
      <input type="text" name="check_no" class="form-control" id="pwd" placeholder="Enter Check No">
      <input type="hidden" name="bank_id" value="{{ $bankId }}" class="form-control" id="pwd" placeholder="Enter Check No">
       <input type="hidden" name="branch_id" value="{{ Session::get('customerId') }}" class="form-control" id="email" placeholder="Enter Name">
    </div>
  </div>
                </div>
               
              </div>
  
  <div class="row" >
                <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
             <div class="form-group " style="clear: both;">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Check Page No:</label>
                                        <div class="col-sm-6">
                                            <input type="text"  name="checkpage_no[]" class="form-control" id="fname" placeholder="Put Page Here">
                                        </div>
                                        <div class="col-md-3">
                                    
                                    <button type="button" class="btn btn-success btn-block mr-3 addextras" id="inputextras">Add</button>
                                </div>
                                    </div>
                                    <div class="input_field_wrapper">
                              </div>
                </div>
               
               
              </div>
  
 
  
  
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Upload</button>
    </div>
  </div>
</form>             
                   
                    </div>
                </div>
                </div> <!-- end col-md-3 -->
            

        </div>  <!-- end div #provideDiv -->
    </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel-->

    <script type="text/javascript">
    $(document).ready(function(){
    var maxFieldLimit = 20; //Input fields increment limitation
    var add_more_field = $('.addextras'); //Add button selector
    var Fieldwrapper = $('.input_field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="form-group row" style="clear: both;"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Check Page No:</label><div class="col-sm-3"><input type="text"  name="checkpage_no[]" class="form-control" id="fname" placeholder="Put Page Here"></div>';

    var x = 1; //Initial field counter is 1
    $(".addextras").click(function(){ //Once add button is clicked

        if(x < maxFieldLimit){ //Check maximum number of input fields
            x++; //Increment field counter
            $(Fieldwrapper).append(fieldHTML); // Add field html
        }
    });
    $(Fieldwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
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