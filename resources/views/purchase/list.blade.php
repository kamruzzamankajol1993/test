@extends('layouts.app')
@section('title', '| Create')

@section('content')
    <style>

    </style>
    <div class="panel panel-default">
        <div class="panel-heading custom_h_typography"><h3>Purchase</h3></div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-xm-12 col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="custom_typography">
                                <td>Chalan</td>
                                <td>Purchase Invoice</td>
                                <td>Purchase Date</td>
                                <td>Supplier</td>
                                <td>Purchase Details</td>
                                <td>Payment Type</td>
                                <td>Grand Total</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase_master as $r)
                                    <tr class="custom_typography">
                                        <td>{{$r->chalan_no}}</td>
                                        <td>{{$r->purchase_master_id}}</td>
                                        <td>{{$r->purchase_date}}</td>
                                        <td>{{$r->supplier->name}}</td>
                                        <td>{{$r->purchase_details}}</td>
                                        <td>{{$r->payment_type}}</td>
                                        <td>{{$r->grand_total}}</td>
                                        <td>
                                            <a href="{{route('purchase.show',$r->purchase_master_id)}}" class="btn btn-info btn-sm">Show</a>
                                            <a href="{{route('purchase.edit',$r->purchase_master_id)}}" class="btn btn-primary btn-sm">Edit</a>
                                            {{Form::open(['route'=>['purchase.destroy',$r->purchase_master_id],'method'=>'delete'])}}
                                            <button {{route('purchase.destroy',$r->purchase_master_id)}} class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){return true;}else{return false}">Delete</button>
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
