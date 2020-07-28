@extends('layouts.branch-app')
@section('title', '| Create new Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">
          <div class="row">
            <div class="col-md-6">
             <h6 class="text-info"> <b>Add User</b></h6>
            </div>
            <div class="col-md-6">
              <!--button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Location</button>-->
            </div>
          </div>
        
      </div>

        <div class="panel-body">
        	
        		 <form action="{{ route('user_profile.store') }}" class="" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
               
                <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd">Branch User Email:</label>
    <div class="">
      <input type="email" name="email" class="form-control" id="pwd" placeholder="Enter  Email">
       <input type="hidden" name="sub_branch_id" value="{{ Session::get('customerId') }}" class="form-control" id="email" placeholder="Enter Name">
    </div>
  </div>
                </div>
               
              </div>
  
  <div class="row" >
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Branch User Name</label>
    <div class="">
      <input type="text" name="name" class="form-control" id="email" placeholder="Enter Name">
    
      
    </div>
  </div>
                </div>
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd">Branch User Image:</label>
    <div class="">
      <input type="file" name="photo" class="" id="pwd" placeholder="Enter  Image" style="opacity: 1;
    position: inherit;">
    </div>
  </div>
                </div>
               
              </div>
  <div class="row">
    
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Password:</label>
    <div class="">
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>
    </div>
     <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="pwd">Confirm Password:</label>
    <div class="">
    <input type="password" name="password_confirmation" class="form-control" id="pwd" placeholder="Enter  Password Again">
    
  </select>
    </div>
  </div>
                </div>
    
  </div>
  <div class="row">
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Branch User Phone:</label>
    <div class="">
    <input type="text" name="phone" class="form-control" id="pwd" placeholder="Enter Phone">
    </div>
  </div>
    </div>
   <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
        <label class="control-label" for="pwd">Status:</label>
    <select class="form-control" id="sel1" name="mstatus">
    <option value="1">Active</option>
    <option value="0">Inactive</option>
    
  </select>
  </div>
    </div>
    
  </div>
  <div class="row">
   
   <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
        <label class="control-label" for="pwd">Fund Status:</label>
    <select class="form-control" id="sel1" name="fund_status">
    <option value="1">Unlimited</option>
    <option value="2">limited</option>
    
  </select>
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