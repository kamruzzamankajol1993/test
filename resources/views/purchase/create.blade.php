@extends('layouts.app')
@section('title', '| Create')

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
            {{Form::open(['route' => ['purchase.store'], 'files' => 'true', 'method' => 'Post', 'class' => 'form-horizontal' ])}}
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('supplier','Supplier',['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::select('supplier_id',$supplier,null,['class'=>'my-form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('purchase_invoice','Invoice',['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::text('chalan_no',null,['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('payment_type',"Payment Type",['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::select('payment_type',array('cash'=>'Cash','bank'=>"Bank"),null,['class'=>'my-form-control'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xx-12">
                <div class="form-group">
                    {{Form::label('purchase_date',"Purchase Date",['class'=>' control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::text('purchase_date', \Carbon\Carbon::now()->format("Y-j-n"),['class'=>'datepicker form-control','data-date-format' => 'yyyy-mm-dd','id'=>'purdate'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('details',"Details",['class'=>'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('purchase_details',null,['class'=>'form-control','rows'=>3])}}
                    </div>
                </div>
            </div>
        </div>
            <div class="row text-center">
                <div class="col-md-12 col-xs-12">
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
                             <td class="custom_t_head_t_center">Action</td>
                        </tr>
                        </thead>
                        <tbody id="addPurchaseItem">
                        <tr>
                            <td>
                                <input type="text" class="form-control text-right custom_input_m_t product_name productSelection" id="product_name_1" name="product_name" onkeypress="product_pur_or_list(1)"  onkeyup="product_pur_or_list(1)" >
                                <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>

                                <input type="hidden" class="sl" value="1">
                            </td>
                            <td>
                                <input type="text" class="form-control text-right custom_input_m_t" name="batch_id[]"   >
                            </td>
                            <td>
                                <input type="text" class="datepicker form-control text-right custom_input_m_t" id="expire_date_1" required onchange="checkExpiredate(1)" name="expire_date[]"   >
                            </td>
                            <td>
                                <input type="text" class="form-control text-right custom_input_m_t" readonly  id="available_quantity_1"   >
                            </td>
                            <td>
                                <input type="text" class="form-control text-right custom_input_m_t" id="quantity_1" onkeyup="checkqty(1),calculate_store(1)" onchange="checkqty(1)" name="quantity[]"   >
                            </td>
                            <td>
                                <input type="text" class="form-control text-right custom_input_m_t"  readonly id="product_rate_1" name="rate[]"   >
                            </td>
                            <td>
                                <input type="text" class="form-control text-right custom_input_m_t total_price" id="total_price_1" name="total_amount[]"   >
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm custom_t_head_t_center" type="button"  onclick="deleteRow(this)" tabindex="10">Delete</button>
                            </td>
                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-primary btn-sm custom_t_head_t_center" id="add_invoice_item" type="button" onClick="addPurchaseOrderField1('addPurchaseItem');"  tabindex="11">Add New</button>
                            </td>
                            <td colspan="4" class="custom_t_td_text_right">
                                Grand Total
                            </td>
                            <td>
                                <input type="text" class="form-control custom_input_m_t" id="grandTotal" name="grand_total"   >
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <button class="btn btn-primary custom_t_head_t_center">Submit</button>
            </div>
            {{Form::close()}}
        </div>  <!-- end div .panel-body -->
    </div>  <!-- end div .panel-->

@endsection
