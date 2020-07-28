@extends('layouts.branch-app')
@section('title', '| Create new Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">
          <div class="row">
            <div class="col-md-6">
             <h6 class="text-info"> <b>Add Amount</b></h6>
            </div>
            <div class="col-md-6">
              <!--button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Location</button>-->
            </div>
          </div>
        
      </div>

        <div class="panel-body">
        	
        		 <form action="{{ route('fund.store') }}" class="" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row" >
               
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
           <div class="form-group">
        <label class="control-label" for="pwd">Branch User Number:</label>
    <select class="form-control" id="prod_cat_id" name="Branch_name">
        @foreach($userNames as $name)
        @if(Session::get('customerId') == $name->sub_branch_id)
    <option value="{{$name->id}}">{{$name->phone}}</option>
    @endif
    @endforeach
    
  </select>
  </div>
                </div>
                
                <div class="col-md-6" style="padding-left: 30px;padding-right: 30px;">
           <div class="form-group" id="subcategory">
        <label class="control-label" for="pwd">Branch User Name:</label>
    <select class="form-control productname"  name="Branch_number">
        <option value="0" disabled="true" selected="true">Select</option>
    
  </select>
  </div>
                </div>
               
              </div>
  
  <div class="row" >
                <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
                  <div class="form-group">
    <label class="control-label" for="email">Amount</label>
    <div class="">
      <input type="text" name="send_amount" class="form-control" id="email" placeholder="Enter Amount">
    <input type="hidden" name="user_id" class="form-control" value="{{Session::get('customerId')}}" id="email" placeholder="Enter Amount">
      
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
<script type="text/javascript">

    $(document).ready(function(){

        $('#prod_cat_id').on('change',function(){
            //console.log("hmm its change");

            var cat_id=$(this).val();
             //console.log(cat_id);
             var div=$(this).parent();


             var op=` <label class="control-label" for="pwd">Branch User Name:</label> <select class="form-control productname"  name="Branch_number" >
                             
                            
                               
                             `;

             $.ajax({
                type:'get',
                url:'{!!URL::to('findProductName')!!}',
                data:{'id':cat_id},
               success:function(data){

                  //console.log('success');

                    //console.log(data);

                    //console.log(data.length);

                   // op+='<option value="0" selected disabled>choose sub-category</option>';
                    for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].branch_id+'">'+data[i].branch_id+'</option>';
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