@extends('layouts.app')
@section('title', '| Receive Money')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">Receive Money</div>

        <div class="panel-body">
        	
        		  {{Form::open (['route' => ['receivemoney.update', $detail->id], 'files' => 'true', 'method' => 'PUT', 'class' => 'form-horizontal','enctype' => 'multipart/form-data' ])}}
           {!! Form::token() !!}

            <div class="row form-group">
                    <div class="col col-md-3">{{Form::label('receiver_name','Receiver Name',['class'=>'form-control-label'])}}</div>
                    <div class="col-12 col-md-9">{{Form::text('receiver_name',$detail->receiver_name,['class'=>'form-control'])}}</div>
                    <div class="col-12 col-md-9">{{Form::hidden('user_id',$detail->user_id,['class'=>'form-control'])}}</div>
                    <div class="col-12 col-md-9">{{Form::hidden('id',$detail->id,['class'=>'form-control'])}}</div>
               </div>


               <div class="row form-group">
                    <div class="col col-md-3">{{Form::label('receiver_number','Receiver Number',['class'=>'form-control-label'])}}</div>
                    <div class="col-12 col-md-9">{{Form::text('receiver_number',$detail->receiver_number,['class'=>'form-control'])}}</div>
                   
               </div>

               <div class="row form-group">
                    <div class="col col-md-3">{{Form::label('reciver_nidnumber','Receiver NID Number',['class'=>'form-control-label'])}}</div>
                    <div class="col-12 col-md-9">{{Form::text('reciver_nidnumber',null,['class'=>'form-control'])}}</div>
                   
               </div>

               <div class="row form-group">
                    <div class="col col-md-3">{{Form::label('copy','Receiver NID Copy',['class'=>'form-control-label'])}}</div>
                    <div class="col-12 col-md-9">{{Form::file('copy',null,['class'=>'form-control'])}}</div>
                   
               </div>
               <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">@lang('button.create')</button>
                </div>
            </div>

            {{Form::close()}}
       </div>
   </div>

@endsection