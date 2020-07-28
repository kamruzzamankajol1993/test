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
        	
        		 <form action="{{ route('subuser.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Branch Name</label>
    <div class="">
      <input type="text" name="detail" class="form-control" id="email" placeholder="Enter Name">
      <input type="hidden" name="sub_branch_id" value="{{ Session::get('customerId') }}" class="form-control" id="email" placeholder="Enter Name">
      
    </div>
  </div>
                </div>
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd">Branch Email:</label>
    <div class="">
      <input type="email" name="email" class="form-control" id="pwd" placeholder="Enter  Email">
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
    <label class="control-label" for="pwd">Branch Phone:</label>
    <div class="">
    <input type="text" name="phone" class="form-control" id="pwd" placeholder="Enter Phone">
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