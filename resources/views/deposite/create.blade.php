@extends('layouts.branch-app')
@section('title', '| Create Deposite')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">
          <div class="row">
            <div class="col-md-6">
             <h6 class="text-info"> <b>Deposite From Here</b></h6>
            </div>
            <div class="col-md-6">
              <!--button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Location</button>-->
            </div>
          </div>
        
      </div>

        <div class="panel-body">
          
             <form action="{{ route('deposite.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
             <div class="form-group">
        <label class="control-label" for="pwd">Bank Name</label>
    <select class="form-control" id="prod_cat_id" name="bank_id">
      @foreach($bankNames as $name)
      @if(Session::get('customerId') == $name->branch_id)
    <option value="{{ $name->id }}">{{ $name->bankname}}</option>
    @endif
    @endforeach
  </select>
  </div>
                </div>
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
                 <div class="form-group" id="subcategory">
        <label class="control-label " for="pwd">Account Number</label>
    <select class="form-control productname"  name="accountnumber">
     
    <option value="0" disabled="true" selected="true">Select</option>
    
    
  </select>
  </div>
                </div>
               
              </div>
  
 
  <div class="row">
    
    <div class="col-md-4" style="padding-left: 30px;padding-right: 30px;">
      <div class="form-group">
    <label class="control-label" for="pwd">Amount:</label>
    <div class="">
      <input type="text" name="amount" class="form-control" id="pwd" placeholder="Enter Amount">
      <input type="hidden" name="branch_id" value="{{ Session::get('customerId') }}" class="form-control" id="pwd" placeholder="Enter Amount">
    </div>
  </div>
    </div>
     <div class="col-md-4" style="padding-left: 30px;padding-right: 30px;">
            <div class="form-group">
        <label class="control-label" for="pwd">Depositor Name</label>
    <select class="form-control" id="sel1" name="depositeBy">
      @foreach($branchNames as $name)
      @if(Session::get('customerId') == $name->sub_branch_id)
    <option value="{{ $name->branch_id}}">{{ $name->branch_id}}</option>
    @endif
    @endforeach
  </select>
  </div>
                </div>
                <div class="col-md-4" style="padding-left: 30px;padding-right: 30px;">
            <div class="form-group">
        <label class="control-label" for="pwd">Status</label>
    <select class="form-control" id="sel1" name="status">
    
    <option value="1">Cash</option>
    <option value="2">Check</option>
    <option value="3">Interest</option>
  </select>
  </div>
                </div>
    
  </div>
  
  
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success" name="btnSubmit" value="button1">Add</button>
      <button type="submit" class="btn btn-info" name="btnSubmit" value="button2">Print</button>
    </div>
  </div>
  
</form>
       </div>
   </div>
<!-- Modal -->
<script type="text/javascript">

    $(document).ready(function(){

        $('#prod_cat_id').on('change',function(){
            //console.log("hmm its change");

            var cat_id=$(this).val();
             //console.log(cat_id);
             var div=$(this).parent();


             var op=`  <label class="control-label " for="pwd">Account Number</label>
    <select class="form-control productname"  name="accountnumber">
                             
                            
                               
                             `;

             $.ajax({
                type:'get',
                url:'{!!URL::to('findProductName1')!!}',
                data:{'id':cat_id},
               success:function(data){

                  //console.log('success');

                    //console.log(data);

                    //console.log(data.length);

                   // op+='<option value="0" selected disabled>choose sub-category</option>';
                    for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].accountnumber+'">'+data[i].accountnumber+'</option>';
                   }
                  // console.log(op)

                  op+= `</select>`

                 $('#subcategory').html(op);
                  // div.find('#subcategory').append(op);


               },
               error:function(){

                }

             });

        });
    });
   
</script>

@endsection