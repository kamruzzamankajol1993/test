@extends('layouts.app')
@section('title', '| Create new medicine')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            
        </div>

        <div class="panel-body">
                {{Form::open (['route' => ['receivemoney.update', $detail->id], 'files' => 'true', 'method' => 'PUT', 'class' => 'form-horizontal','enctype' => 'multipart/form-data' ])}}
           {!! Form::token() !!}
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('receiver_name','Receiver Name',['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::text('receiver_name',$detail->receiver_name, ['class'=>'form-control'])}}
                    </div>
                </div>
              
                <div class="form-group">
                    {{Form::label('receiver_number','Receiver Number',['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::text('receiver_number',null, ['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('reciver_nidnumber','Receiver Nid Number',['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::text('reciver_nidnumber',null, ['class'=>'form-control'])}}
                    </div>
                </div>
            </div>   <!-- end col 6 -->
            <div class="col-md-6 col-xs-12">
           
                <div class="form-group">
                    {{Form::label('copy','NiD Copy', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        <!-- image-preview-filename input [CUT FROM HERE]-->
                        <div class="input-group image-preview">
                            <input class="form-control image-preview-filename" disabled="disabled" type="text">
                            <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button class="btn btn-default image-preview-clear" style="display:none;" type="button">
                                    <span class="glyphicon glyphicon-remove">
                                    </span>
                                    @lang('products.clear')
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open">
                                    </span>
                                    <span class="image-preview-input-title">
                                    @lang('products.browser')
                                    </span>
                                    <input accept="image/png, image/jpeg, image/gif" name="file" type="file"/>
                                    <!-- rename  it -->
                                </div>
                            </span>
                        </div>
                        <!-- /input-group image-preview [TO HERE]-->
                    </div>
                </div>
                <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">Get</button>
                </div>
            </div>
            </div> 
              <!-- end col 6 -->
        {{Form::close()}}   <!-- end form !-->
        </div>   <!-- end div .panel-body-->
    </div>  <!-- end div .panel-->
@endsection
