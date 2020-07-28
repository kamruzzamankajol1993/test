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
                <h5>Show invoice</h5>
                <hr>



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-2 col-form-label custom_input_typography">Customer name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="customer_name" name="customer_name" onkeyup="customer_autocomplete()" value="{{$sales_master->customer->name}}">
                                <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id"  value="{{$sales_master->customer_id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label custom_input_typography">Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="datepicker form-control " name="date" id="date" placeholder="Date" value="{{$sales_master->date}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="payment_type" class="col-sm-2 col-form-label custom_input_typography">Payment Type</label>
                            <div class="col-sm-10">
                                <select name="payment_type" class="my-form-control" id="payment_type">
                                    <option value="">Select</option>
                                    <option value="cash" {{$sales_master->payment_type=='cash'? 'selected':''}}>Cash</option>
                                    <option value="bank" {{$sales_master->payment_type=='bank'? 'selected':''}}>Bank</option>
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

                            </tr>
                            </thead>
                            <tbody id="addinvoiceItem">
                            @foreach($sales_master->Saledetails as $r)
                                <tr>
                                    <td >
                                        <input type="hidden" name="sales_detail_id[]" value="{{$r->sales_detail_id}}">
                                        <input type="text" class="form-control custom_input_m_t productSelection" name="product_name" value="{{$r->product->p_bname}}" onkeyup="invoice_productList({{$loop->iteration}});"  id="product_name_{{$loop->iteration}}" tabindex="7" >
                                        <input type="hidden" class="autocomplete_hidden_value product_id_{{$loop->iteration}}" name="product_id[]" value="{{$r->product->p_id}}" id="SchoolHiddenId" />
                                    </td>
                                    <td>
                                        <select class="my-form-control custom_input_m_t" id="batch_id_{{$loop->iteration}}"  name="batch_id[]" required="required" onchange="product_stock(1)" tabindex="8">
                                            <option value="{{$r->batch_id}}">{{$r->batch_id}}</option>
                                        </select>
                                    </td>
                                    <td >
                                        <input type="text" name="available_quantity[]" class="form-control custom_input_m_t text-right available_quantity_{{$loop->iteration}}" value="0" readonly="" id="available_quantity_{{$loop->iteration}}"/>
                                    </td>
                                    <td id="expire_date_{{$loop->iteration}}" class="dynamic_expire">
                                        {{$r->getExpireDate->expire_date}}
                                    </td>
                                    <td >
                                        <input name="" id="unit_{{$loop->iteration}}"  class="form-control custom_input_m_t text-right unit_{{$loop->iteration}} valid" value="PCS" readonly="" aria-invalid="false" type="text">
                                    </td>
                                    <td >
                                        <input type="text" name="quantity[]" onkeyup="quantity_calculate({{$loop->iteration}}),checkqty({{$loop->iteration}});" value="{{$r->quantity}}" onchange="quantity_calculate({{$loop->iteration}});" class="total_qntt_{{$loop->iteration}} form-control custom_input_m_t text-right" id="total_qntt_{{$loop->iteration}}" placeholder="0.00"  min="0" tabindex="9" required/>
                                    </td>
                                    <td >
                                        <input type="text" name="rate[]" id="price_item_{{$loop->iteration}}" value="{{$r->rate}}" class="price_item1 price_item form-control custom_input_m_t text-right" tabindex="10" required=""  onchange="quantity_calculate({{$loop->iteration}});" placeholder="0.00" min="0"  readonly/>
                                    </td>
                                    <td >
                                        <input type="text" name="discount[]" onkeyup="quantity_calculate({{$loop->iteration}}),checkqty({{$loop->iteration}});" value="{{$r->discount}}"  onchange="quantity_calculate({{$loop->iteration}});" id="discount_{{$loop->iteration}}" type="text" class="form-control custom_input_m_t ">
                                        <input type="hidden" value="1" name="discount_type" id="sale_discount_type_{{$loop->iteration}}">
                                    </td>
                                    <td ><input type="text" class="form-control custom_input_m_t total_price" type="text" value="{{$r->total_price}}" name="total_price[]" id="total_price_{{$loop->iteration}}"  readonly="readonly" ></td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td   colspan="7" rowspan="2" class="custom_t_head_t_center" >
                                    Invoice Details
                                    <textarea readonly name="invoice_details" id="invoice_details_" cols="30" rows="3" class="form-control " >{{$sales_master->invoice_details}}</textarea>
                                </td>
                                <td class="custom_t_td_text_right" >Invoice Discount</td>
                                <td  ><input type="text" id="invdcount" class="form-control custom_input_m_t " name="invoice_discount" value="{{$sales_master->invoice_discount}}" onkeyup="calculateSum(),checknum();" onchange="calculateSum()"></td>
                            </tr>
                            <tr>
                                <td class="custom_t_td_text_right">Total Discount</td>
                                <td><input type="text" id="total_discount_ammount" readonly class="form-control custom_input_m_t " name="total_discount" value="{{$sales_master->total_discount}}"></td>
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
                                <td><input type="text" id="grandTotal" name="grand_total" class="form-control custom_input_m_t " value="{{$sales_master->grand_total}}" readonly></td>
                            </tr>
                            <tr>
                                <td class="custom_t_td_text_right" colspan="8">Previous</td>
                                <td><input type="text" id="previous" name="previous_due" class="form-control custom_input_m_t " readonly></td>
                            </tr>
                            <tr >
                                <td class="custom_t_td_text_right" colspan="8">Net Total</td>
                                <td><input type="text" id="n_total" name="net_total" class="form-control custom_input_m_t " value="{{$sales_master->net_total}}" readonly></td>
                            </tr>
                            <tr >
                                <td class="custom_t_td_text_right" colspan="8">Paid Amount</td>
                                <td><input type="text" id="paidAmount" name="paid_amount" onkeyup="calculateSum(),checknum();" value="{{$sales_master->paid_amount}}" class="form-control custom_input_m_t " ></td>
                            </tr>
                            <tr >

                                <td class="custom_t_td_text_right" colspan="8">Due Amount</td>
                                <td><input type="text" id="dueAmmount" name="due" class="form-control custom_input_m_t " value="{{$sales_master->due}}" readonly></td>
                            </tr>
                            <tr >
                                <td class="custom_t_td_text_right"  colspan="8">Change</td>
                                <td><input type="text" id="change" class="form-control custom_input_m_t "></td>
                            </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <script>
        $('input').each(function (i,v) {
           $(v).prop('readonly',true);
        })
    </script>
@endsection

