@extends('layouts.app')
@section('title', '| Create new supplied')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">Send Money</div>

        <div class="panel-body">
        	
        		 <form action="{{ route('sendmoney.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Sender Name</label>
    <div class="col-sm-10">
      <input type="text" name="sender_name" class="form-control" id="email" placeholder="Enter Name">
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" id="email" placeholder="Enter Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Sender Number:</label>
    <div class="col-sm-10">
      <input type="text" name="sender_number" class="form-control" id="pwd" placeholder="Enter  Number">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Sender Location:</label>
    <div class="col-sm-10">
     <select class="form-control" id="sel1" name="sender_location">
    <option>Mirpur</option>
    <option>Uttara</option>
    
  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Amount:</label>
    <div class="col-sm-10">
      <input type="number" name="amount" class="form-control" id="pwd" placeholder="Enter amount">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Receiver Location:</label>
    <div class="col-sm-10">
     <select class="form-control" id="sel1" name="reciver_location">
    <option>Mirpur</option>
    <option>Uttara</option>
    
  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Receiver Name</label>
    <div class="col-sm-10">
      <input type="text" name="reciver_name" class="form-control" id="email" placeholder="Enter Reciver Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Status:</label>
    <div class="col-sm-10">
     <select class="form-control" id="sel1" name="status">
    <option value="paid">Paid</option>
    <option value="unpaid">UnPaid</option>
    
  </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
       </div>
   </div>

@endsection