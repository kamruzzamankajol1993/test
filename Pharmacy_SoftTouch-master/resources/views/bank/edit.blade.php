@extends('layouts.branch-app')
@section('title', '| Create new Bank')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">
          <div class="row">
            <div class="col-md-6">
             <h6 class="text-info"> <b>Add Bank Info</b></h6>
            </div>
            <div class="col-md-6">
              <!--button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Location</button>-->
            </div>
          </div>
        
      </div>

        <div class="panel-body">
        	
        		 <form action="{{ route('bank.update') }}" class="" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
               
                <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd">Bank Name:</label>
    <div class="">
      <input type="text" name="bankname" value="{{ $detail->bankname }}" class="form-control" id="pwd" placeholder="Enter  Bank Name">
      <input type="hidden" name="id" value="{{ $detail->id }}" class="form-control" id="pwd" placeholder="Enter  Bank Name">
       <input type="hidden" name="branch_id" value="{{ Session::get('customerId') }}" class="form-control" id="email" placeholder="Enter Name">
    </div>
  </div>
                </div>
               
              </div>
  
  <div class="row" >
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Branch Name</label>
    <div class="">
      <input type="text" name="branchname" value="{{ $detail->branchname }}" class="form-control" id="email" placeholder="Enter Name">
    
      
    </div>
  </div>
                </div>
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Account Number</label>
    <div class="">
      <input type="text" name="accountnumber" value="{{ $detail->accountnumber }}" class="form-control" id="email" placeholder="Enter Number">
    
      
    </div>
  </div>
                </div>
               
              </div>
  
 
  
  
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Add</button>
    </div>
  </div>
</form>
       </div>
   </div>
<!-- Modal -->

@endsection