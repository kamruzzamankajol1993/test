@extends('layouts.branch-app')
@section('title', '| Create new Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">
          <div class="row">
            <div class="col-md-6">
             <h6 class="text-info"> <b>Add Customer</b></h6>
            </div>
            <div class="col-md-6">
              <!--button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Location</button>-->
            </div>
          </div>
        
      </div>

        <div class="panel-body">
        	
        		 <form action="{{ route('subbranch.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Sender Name</label>
    <div class="">
      <input type="text" name="sender_name" class="form-control" id="email" placeholder="Enter Name">
      <input type="hidden" name="user_id" value="{{ Session::get('customerId') }}" class="form-control" id="email" placeholder="Enter Name">
     
    </div>
  </div>
                </div>
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd">Sender Nid:</label>
    <div class="">
      <input type="text" name="sender_nid" class="form-control" id="pwd" placeholder="Enter  Nid Number">
    </div>
  </div>
                </div>
               
              </div>
  
 
  <div class="row">
    
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Sender Number:</label>
    <div class="">
      <input type="text" name="sender_number" class="form-control" id="pwd" placeholder="Enter Sender Number">
    </div>
  </div>
    </div>
     <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="pwd">Receiver Number:</label>
    <div class="">
    <input type="text" name="receiver_number" class="form-control" id="pwd" placeholder="Enter  Receiver Number">
    
  </select>
    </div>
  </div>
                </div>
    
  </div>
  <div class="row">
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Receiver Name:</label>
    <div class="">
    <input type="text" name="receiver_name" class="form-control" id="pwd" placeholder="Enter Receiver Name">
    </div>
  </div>
    </div>
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
       <div class="form-group">
    <label class="control-label" for="email">Description</label>
    <div class="">
        <input type="text" name="receiver_nid" class="form-control" id="pwd" placeholder="Enter Receiver Nid">
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