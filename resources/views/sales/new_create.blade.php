@extends('layouts.app')
@section('title', '| Sell')
@section('content')
    <style>
        .dynamic_expire p{
            color: green;
            text-align: center;
            padding-top: 11px;
            font-size: 17px;
            font-family: Cabin Condensed,sans-serif;
        }
        .custom_m_b{
            margin-bottom: 0px !important;
        }

        .my-form-control{
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
        .custom_input_typography{
            font-weight: bolder;
            font-size: 16px;
            font-family: Cabin Condensed,sans-serif;
            color:black !important;
        }
        .custom_btn_typography{
            font-weight: bolder;
            font-size: 16px;
            font-family: Cabin Condensed,sans-serif;
            color:white !important;
        }
    </style>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>New invoice</h5>
                <hr>
                {{Form::open(['route'=>'sales.store'],['method'=>'post'])}}


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="customer_name" class="col-sm-2 col-form-label custom_input_typography">Customer name</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" id="customer_name" name="customer_name" onkeyup="customer_autocomplete()">
                                    <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id"  value="{customer_id}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-sm-2 col-form-label custom_input_typography">Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="datepicker form-control " name="date" id="date" placeholder="Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="payment_type" class="col-sm-2 col-form-label custom_input_typography">Payment Type</label>
                                <div class="col-sm-10">
                                    <select name="payment_type" class="my-form-control" id="payment_type">
                                        <option value="">Select</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="normalinvoice">
                                <thead>
                                <tr>
                                    <td class="custom_t_head_t_center">Item information</td>
                                    <td class="custom_t_head_t_center" style="width: 136px;">Batch ID</td>
                                    <td class="custom_t_head_t_center">Avg Qty</td>
                                    <td class="custom_t_head_t_center" style="width: 136px;">Expiry</td>
                                    <td class="custom_t_head_t_center">Unit</td>
                                    <td class="custom_t_head_t_center">Qty</td>
                                    <td class="custom_t_head_t_center">Price</td>
                                    <td class="custom_t_head_t_center">Discount</td>
                                    <td class="custom_t_head_t_center">Total</td>
                                    <td class="custom_t_head_t_center">Action</td>
                                </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                <tr>
                                    <td >
                                        <input type="text" class="form-control custom_input_m_t productSelection" name="product_name" onkeyup="invoice_productList(1);"  id="product_name_1" tabindex="7" >
                                        <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId" />
                                    </td>
                                    <td>
                                        <select class="my-form-control custom_input_m_t" id="batch_id_1"  name="batch_id[]" required="required" onchange="product_stock(1)" tabindex="8">
                                            <option>Select Batch</option>
                                        </select>
                                    </td>
                                    <td >
                                        <input type="text" name="available_quantity[]" class="form-control custom_input_m_t text-right available_quantity_1" value="0" readonly="" id="available_quantity_1"/>
                                    </td>
                                    <td id="expire_date_1" class="dynamic_expire">

                                    </td>
                                    <td >
                                        <input name="" id="unit_1" class="form-control custom_input_m_t text-right unit_1 valid" value="None" readonly="" aria-invalid="false" type="text">
                                    </td>
                                    <td >
                                        <input type="text" name="quantity[]" onkeyup="quantity_calculate(1),checkqty(1);" onchange="quantity_calculate(1),stockLimit(1);" class="total_qntt_1 form-control custom_input_m_t text-right" id="total_qntt_1" placeholder="0.00"  min="0" tabindex="9" required/>
                                    </td>
                                    <td >
                                        <input type="text" name="rate[]" id="price_item_1" class="price_item1 price_item form-control custom_input_m_t text-right" tabindex="10" required=""  onchange="quantity_calculate(1);" placeholder="0.00" min="0" value="0" readonly/>
                                    </td>
                                    <td >
                                        <input type="text" name="discount[]" onkeyup="quantity_calculate(1),checkqty(1);"  onchange="quantity_calculate(1);" id="discount_1" type="text" class="form-control custom_input_m_t ">
                                        <input type="hidden" value="1" name="discount_type" id="sale_discount_type_1">
                                    </td>
                                    <td ><input type="text" class="form-control custom_input_m_t total_price" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" ></td>
                                    <td>
                                        <!-- Discount calculate start-->
                                        <input type="hidden" id="total_discount_1" class="" value="0"   />
                                        <input type="hidden" id="all_discount_1" class="total_discount" name="per_product_dis_percent[]"/>
                                        <!-- Discount calculate end -->
                                        <button type="button" class="btn btn-sm btn-primary" onClick="addInputField('addinvoiceItem');"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td   colspan="7" rowspan="2" class="custom_t_head_t_center" >
                                        Invoice Details
                                        <textarea name="invoice_details" id="invoice_details_1" cols="30" rows="3" class="form-control " ></textarea>
                                    </td>
                                    <td class="custom_t_td_text_right" >Invoice Discount</td>
                                    <td  ><input type="text" id="invdcount" name="invoice_discount" class="form-control custom_input_m_t " onkeyup="calculateSum(),checknum();" onchange="calculateSum()"></td>
                                </tr>
                                <tr>
                                    <td class="custom_t_td_text_right">Total Discount</td>
                                    <td><input type="text" id="total_discount_ammount" name="total_discount" readonly class="form-control custom_input_m_t "></td>
                                </tr>
                                <tr >
                                    <td class="custom_t_td_text_right" colspan="8">Vat</td>
                                    <td><input type="text" class="form-control custom_input_m_t "></td>
                                </tr>
                                <tr >
                                    <td class="custom_t_td_text_right" colspan="8">Total Tax</td>
                                    <td><input type="text" class="form-control custom_input_m_t " readonly></td>
                                </tr>
                                <tr >
                                    <td class="custom_t_td_text_right" colspan="8">Grand Total</td>
                                    <td><input type="text" id="grandTotal" name="grand_total" class="form-control custom_input_m_t " readonly></td>
                                </tr>
                                <tr>
                                    <td class="custom_t_td_text_right" colspan="8">Previous</td>
                                    <td><input type="text" id="previous" name="previous_due" class="form-control custom_input_m_t " readonly></td>
                                </tr>
                                <tr >
                                    <td class="custom_t_td_text_right" colspan="8">Net Total</td>
                                    <td><input type="text" id="n_total" name="net_total" class="form-control custom_input_m_t " readonly></td>
                                </tr>
                                <tr >
                                    <td class="custom_t_td_text_right" colspan="8">Paid Amount</td>
                                    <td><input type="text" id="paidAmount" name="paid_amount" onkeyup="calculateSum(),checknum();" class="form-control custom_input_m_t " ></td>
                                </tr>
                                <tr >
                                    <td  style="border:none !important; display: flex;">
                                        <button type="button" class="btn btn-danger btn-sm custom_btn_typography" onclick="full_paid()">Full paid</button>
                                        <button type="submit" class="btn btn-warning btn-sm custom_btn_typography" style="margin-left: 12px">Submit</button>
                                    </td>
                                    <td class="custom_t_td_text_right" colspan="7">Due Amount</td>
                                    <td><input type="text" id="dueAmmount" name="due" class="form-control custom_input_m_t " readonly></td>
                                </tr>
                                <tr >
                                    <td class="custom_t_td_text_right"  colspan="8">Change</td>
                                    <td><input type="text" id="change" class="form-control custom_input_m_t "></td>
                                </tr>
                                </tfoot>

                            </table>
                        </div>

                    </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection

