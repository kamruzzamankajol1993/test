@extends('layouts.app')
@section('title', '| Show')

@section('content')
    <style>
        .my-form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1.5rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .custom_input_m_t{
            margin-top: 7px;
        }
        .custom_t_head_t_center{
            text-align: center;
            font-weight: bolder;
            font-size: 16px;
            font-family: Cabin Condensed,sans-serif;
        }
        .custom_t_td_text_right{
            text-align: right;
            font-weight: bolder;
            font-size: 16px;
            font-family: Cabin Condensed,sans-serif;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading custom_h_typography"><h3>Purchase</h3></div>

        <div class="panel-body">

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {{Form::label('supplier','Supplier',['class'=>'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            {{Form::select('supplier_id',$supplier,$purchase_master->supplier->id,['class'=>'my-form-control','readonly'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('purchase_invoice','Invoice',['class'=>'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            {{Form::text('chalan_no',$purchase_master->chalan_no,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('payment_type',"Payment Type",['class'=>'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            {{Form::select('payment_type',array('cash'=>'Cash','bank'=>"Bank"),$purchase_master->payment_type,['class'=>'my-form-control','readonly'])}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xx-12">
                    <div class="form-group">
                        {{Form::label('purchase_date',"Purchase Date",['class'=>'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            {{Form::text('purchase_date',$purchase_master->purchase_date,['class'=>'datepicker form-control','data-date-format' => 'yyyy-mm-dd','id'=>'purdate'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('details',"Details",['class'=>'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            {{Form::textarea('purchase_details',$purchase_master->purchase_details,['class'=>'form-control','rows'=>3,'readonly'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12 col-xs-12">
                    <div class="responsive">
                        <table class="table table-bordered" id="purchaseTable">
                            <thead >
                            <tr>
                                <td class="custom_t_head_t_center">Item Information</td>
                                <td class="custom_t_head_t_center">Batch ID</td>
                                <td class="custom_t_head_t_center">Expiry Date</td>
                                <td class="custom_t_head_t_center">Stock</td>
                                <td class="custom_t_head_t_center">Quantity</td>
                                <td class="custom_t_head_t_center">Supplier Price</td>
                                <td class="custom_t_head_t_center">Total</td>

                            </tr>
                            </thead>
                            <tbody id="addPurchaseItem">
                            @foreach($purchase_master->details as $detail)
                                <tr>
                                    <td>
                                        {{Form::text('product_name',$detail->product->p_bname,[
                                        'class'=>'form-control text-right custom_input_m_t product_name productSelection',
                                        'id'=>'product_name_1',
                                        'onkeyup'=>'product_pur_or_list(1)'
                                        ])
                                        }}

                                        <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" value="{{$detail->product_id}}"/>

                                        <input type="hidden" class="sl" value="1">
                                        <input type="hidden" name="purchase_details_id[]" value="{{$detail->purchase_details_id}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right custom_input_m_t" name="batch_id[]"  value="{{$detail->batch_id}}">
                                    </td>
                                    <td>
                                        <input type="text" class="datepicker form-control text-right custom_input_m_t" id="expire_date_{{$loop->iteration}}" value="{{$detail->expire_date}}" required onchange="checkExpiredate({{$loop->iteration}})" name="expire_date[]"   >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right custom_input_m_t" readonly  id="available_quantity_1"   >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right custom_input_m_t" id="quantity_1" value="{{$detail->quantity}}" onkeyup="checkqty(1),calculate_store(1)" onchange="checkqty(1)" name="quantity[]"   >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right custom_input_m_t" value="{{$detail->rate}}"  readonly id="product_rate_1" name="rate[]"   >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right custom_input_m_t total_price" id="total_price_1" value="{{$detail->total_amount}}" name="total_amount[]"   >
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>

                                <td colspan="6" class="custom_t_td_text_right">
                                    Grand Total
                                </td>
                                <td>
                                    <input type="text" class="form-control custom_input_m_t" id="grandTotal" name="grand_total"  value="{{$purchase_master->grand_total}}" >
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

        </div>  <!-- end div .panel-body -->
        <script>
            $('input').each(function (i,v) {
                $(v).prop('readonly',true);
            });

        </script>
    </div>  <!-- end div .panel-->

@endsection
