@extends('layouts.app')
@section('title', '| Create new supplied')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">
          <div class="row">
            <div class="col-md-6">
             <h6 class="text-info"> <b>Send Money</b></h6>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Location</button>
            </div>
          </div>
        
      </div>

        <div class="panel-body">
        	
        		 <form action="{{ route('sendmoney.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Sender Name</label>
    <div class="">
      <input type="text" name="sender_name" class="form-control" id="email" placeholder="Enter Name">
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" id="email" placeholder="Enter Name">
    </div>
  </div>
                </div>
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                   <div class="form-group">
    <label class="control-label" for="pwd">Sender Number:</label>
    <div class="">
      <input type="text" name="sender_number" class="form-control" id="pwd" placeholder="Enter  Number">
    </div>
  </div>
                </div>
               
              </div>
  
 
  <div class="row">
     <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="pwd">Sender Location:</label>
    <div class="">
     <select class="form-control" id="sel1" name="sender_location">
      @foreach($locations as $location)
    <option value="{{ $location->location_name }}">{{ $location->location_name }}</option>
       @endforeach
    
  </select>
    </div>
  </div>
                </div>
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Amount:</label>
    <div class="">
      <input type="number" name="amount" class="form-control" id="pwd" placeholder="Enter amount">
    </div>
  </div>
    </div>
    
    
  </div>
  <div class="row">
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Receiver Location:</label>
    <div class="">
     <select class="form-control" id="sel1" name="reciver_location">
  @foreach($locations as $location)
    <option value="{{ $location->location_name }}">{{ $location->location_name }}</option>
       @endforeach
    <option value="anywhere">Any Where</option>
  </select>
    </div>
  </div>
    </div>
    <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
       <div class="form-group">
    <label class="control-label" for="email">Receiver Name</label>
    <div class="">
      <input type="text" name="reciver_name" class="form-control" id="email" placeholder="Enter Reciver Name">
    </div>
  </div>
    </div>
    
  </div>
  
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Send Money</button>
    </div>
  </div>
</form>
       </div>
   </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add location</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class=col-md-12>
            <form class="form-inline" action="{{ route('location.store') }}"  method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
  <div class="form-group">
    <label for="email">Location Name:</label>
    <input type="text" name="location_name" class="form-control" id="email">
  </div>
  
  <button type="submit" class="btn btn-success">Save</button>
</form>
          </div>
           <div class=col-md-12>
             <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Location Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($locations as $key=>$location)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $location->location_name }}</td>
        <td><a href="{{route('location.destroy',['id'=>$location->id])}}" class="btn btn-danger">
                                       <span><i class="fa fa-trash"></i></span>
                                      </a> </td>
      </tr>
     @endforeach
    </tbody>
  </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection