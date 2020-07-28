@extends('layouts.app')
@section('title', '| List')

@section('content')
    <style>

    </style>
    <div class="panel panel-default">
        <div class="panel-heading custom_h_typography"><h3>Sales</h3></div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-xm-12 col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="custom_typography">
                                <td>Sale Invoice</td>
                                <td>Sale Date</td>
                                <td>Customer</td>
                                <td>Payment Type</td>
                                <td>Invoice Details</td>
                                <td>Paid Amount</td>
                                <td>Due Amount</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales_master as $r)
                                <tr class="custom_typography">
                                    <td>{{$r->sales_master_id}}</td>
                                    <td>{{$r->date}}</td>
                                    <td>{{$r->customer->name}}</td>
                                    <td>{{$r->payment_type}}</td>
                                    <td>{{$r->invoice_details}}</td>
                                    <td>{{$r->paid_amount}}</td>
                                    <td>{{$r->due}}</td>
                                    <td>
                                        <a href="{{route('sales.show',$r->sales_master_id)}}" class="btn btn-info btn-sm">Show</a>
                                        <a href="{{route('sales.edit',$r->sales_master_id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        {{Form::open(['route'=>['sales.destroy',$r->sales_master_id],'method'=>'delete'])}}
                                        <button {{route('sales.destroy',$r->sales_master_id)}} class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){return true;}else{return false}">Delete</button>
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
