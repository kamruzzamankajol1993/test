<script src="{{asset('js/material.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/material-kit.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/bootbox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/plugins/Trumbowyg/dist/trumbowyg.js')}}"></script>
<script src="{{asset('/js/treeview/jquery.treemenu.js')}}"></script>
<script src="{{asset('/js/sell_invoice.js')}}"></script>
<script src="{{asset('/js/purchase.js')}}"></script>
<script>
    $('textarea#textarea').trumbowyg();
    $(".tree").treemenu({delay:500}).openActive();

</script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    $('.datepicker').datepicker({
        dateFormat:'yy-mm-dd',
    });
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
        progressBar: true,
    });
    @endforeach
    @endif

    //product purhcase
    function product_pur_or_list(sl) {
        // Auto complete

        var options = {
            minLength: 0,

            source: function( request, response ) {

                var product_name = $('#product_name_'+sl).val();
                $.ajax( {
                    url: "{{route('product_search')}}",
                    method: 'get',
                    dataType: "json",
                    data: {
                        term: request.term,
                        product_name:product_name,
                    },
                    success: function( data ) {
                        response( data );
                        console.log(data)
                    }
                });
            },
            focus: function( event, ui ) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function( event, ui ) {
                $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
                var sl = $(this).parent().parent().find(".sl").val();

                var product_id          = ui.item.value;

                var  manufacturer_id=$('#manufacturer_id').val();


                var base_url    = $('.baseUrl').val();


                var available_quantity    = 'available_quantity_'+sl;
                var product_rate    = 'product_rate_'+sl;




                $.ajax({
                    type: "get",
                    url:"{{route('product_select')}}",
                    data: {product_id:product_id},
                    cache: false,
                    success: function(data)
                    {

                        obj = JSON.parse(data);
                      //  $('#'+available_quantity).val(obj.total_product);
                        console.log(obj);
                        $('#'+product_rate).val(obj.supplier_rate);
                        $('#'+available_quantity).val(obj.stock);
                    }
                });

                $(this).unbind("change");
                return false;
            }
        }
        console.log(options);
        $('body').on('keydown.autocomplete', '.product_name', function() {
            $(this).autocomplete(options);
        });
    }


    //end product purhcase

    //find customer
    function customer_autocomplete(sl) {

        var customer_id = $('#customer_id').val();
        // Auto complete
        var options = {
            minLength: 0,
            source: function( request, response ) {
                var customer_name = $('#customer_name').val();

                $.ajax( {
                    url: "{{route('find_customer')}}",
                    method: 'get',
                    dataType: "json",
                    data: {
                        term: request.term,
                        customer_id:customer_name,
                    },
                    success: function( data ) {
                        // alert(data);
                        response( data );

                    }
                });
            },
            focus: function( event, ui ) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function( event, ui ) {
                $(this).parent().find("#autocomplete_customer_id").val(ui.item.value);
                var customer_id          = ui.item.value;
               // customer_due(customer_id);

                $(this).unbind("change");
                return false;
            }
        }

        $('body').on('keydown.autocomplete', '#customer_name', function() {
            $(this).autocomplete(options);
        });

    }
    //end customer

    //sale_product list
    function invoice_productList(sl) {

        var priceClass = 'price_item'+sl;

        var unit = 'unit_'+sl;
        var tax = 'total_tax_'+sl;
        var discount_type = 'discount_type_'+sl;
        var batch_id = 'batch_id_'+sl;

        // Auto complete
        var options = {
            minLength: 0,
            source: function( request, response ) {
                var product_name = $('#product_name_'+sl).val();
                $.ajax( {
                    url: "{{route('product_query_on_sale')}}",
                    method: 'get',
                    dataType: "json",
                    data: {
                        term: request.term,
                        product_name:product_name,
                    },
                    success: function( data ) {
                        response( data );

                    }
                });
            },
            focus: function( event, ui ) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function( event, ui ) {
                $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);
                // var sl = $(this).parent().parent().find(".sl").val();
                var id=ui.item.value;
                var dataString = 'product_id='+ id;


                $.ajax
                ({
                    type: "get",
                    url: "{{route('get_data_of_selected_item')}}",
                    data: dataString,
                    cache: false,
                    success: function(data)
                    {
                        var obj = jQuery.parseJSON(data);
                        for (var i = 0; i < (obj.txnmber); i++) {
                            var txam = obj.taxdta[i];
                            var txclass = 'total_tax'+i+'_'+sl;
                            $('.'+txclass).val(txam);
                        }

                        $('.'+priceClass).val(obj.p_price);
                        $('.'+unit).val(obj.unit);
                        $('.'+tax).val(obj.tax);
                        $('#txfieldnum').val(obj.txnmber);
                        $('#'+discount_type).val(obj.discount_type);
                        $('#'+batch_id).html(obj.batch);

                        //This Function Stay on others.js page
                        quantity_calculate(sl);

                    }
                });

                $(this).unbind("change");
                return false;
            }
        }

        $('body').on('keydown.autocomplete', '.productSelection', function() {
            $(this).autocomplete(options);
        });

    }
    //end saleproduct list

    //product expire and stock by batch id
    function product_stock(sl) {

        var  batch_id=$('#batch_id_'+sl).val();
        var dataString = 'batch_id='+ batch_id;

        var available_quantity    = 'available_quantity_'+sl;
        var product_rate    = 'product_rate_'+sl;
        var expire_date    = 'expire_date_'+sl;
        $.ajax({
            type: "get",
            url: "{{route('get_product_by_batch_id')}}",
            data: dataString,
            cache: false,
            success: function(data)
            {
                obj = JSON.parse(data);

                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();

                if(dd<10){
                    dd='0'+dd;
                }
                if(mm<10){
                    mm='0'+mm;
                }
                var today = yyyy+'-'+mm+'-'+dd;

                aj = new Date(today);
                exp = new Date(obj.expire);

                // alert(today);

                if (aj >= exp) {

                    alert('Date Expired, please choose another batch!');
                    $('#batch_id_'+sl)[0].selectedIndex = 0;


                    $('#'+expire_date).html('<p style="color:red;">'+obj.expire+'</p>');
                    document.getElementById('expire_date_'+sl).innerHTML = '';


                }else{
                    $('#'+expire_date).html('<p style="color:green;">'+obj.expire+'</p>');
                }
                $('#'+available_quantity).val(obj.avg);

            }
        });

        $(this).unbind("change");
        return false;



    }
    //edn product expire and stock by batchid


    //Quantity calculat
    function quantity_calculate(item) {

        var quantity    = $("#total_qntt_" + item).val();

        var price_item  = $("#price_item_" + item).val();
        var discount    = $("#discount_" + item).val();
        var invoice_discount = $("#invdcount").val();
        var total_tax   = $("#total_tax_" + item).val();
        var total_discount = $("#total_discount_" + item).val();
        var dis_type    = $("#sale_discount_type_"+item).val();
        var taxnumber = $("#txfieldnum").val();

        if (quantity > 0 || discount > 0) {

            if (dis_type == 1) {

                var price = quantity * price_item;


                // Discount cal per product
//            var dis = +(price * discount / 100) + +invoice_discount;
                var dis = +(price * discount / 100)+  + invoice_discount;


                $("#all_discount_" + item).val(dis);

                //Total price calculate per product
                var temp = price - dis;
                var ttletax = 0;
                $("#total_price_" + item).val(price);
                for(var i=0;i<taxnumber;i++){
                    var tax = (temp-ttletax) * $("#total_tax"+i+"_" + item).val();
                    ttletax += Number(tax);
                    $("#all_tax"+i+"_" + item).val(tax);
                }


            }else if(dis_type == 2){
                var price = quantity * price_item;

                // Discount cal per product
                var dis   = discount * quantity;
                $("#all_discount_" + item).val(dis);

                //Total price calculate per product

                var temp = price - dis;
                $("#total_price_" + item).val(price);

                var ttletax = 0;
                for(var i=0;i<taxnumber;i++){
                    var tax = (temp-ttletax) * $("#total_tax"+i+"_" + item).val();
                    ttletax += Number(tax);
                    $("#all_tax"+i+"_" + item).val(tax);
                }

            }else if(dis_type == 3){
                var total_price = quantity * price_item;

                // Discount cal per product
                $("#all_discount_" + item).val(discount);

                //Total price calculate per product
                var price = total_price - dis;
                $("#total_price_" + item).val(total_price);

                var ttletax = 0;
                for(var i=0;i<taxnumber;i++){
                    var tax = (price-ttletax) * $("#total_tax"+i+"_" + item).val();
                    ttletax += Number(tax);
                    $("#all_tax"+i+"_" + item).val(tax);
                }
            }
        }else {

            var n = quantity * price_item;
            var c = quantity * price_item * total_tax;
            $("#total_price_" + item).val(n),
                $("#all_tax_" + item).val(c)
        }

        calculateSum();
        invoice_paidamount();
    }
    //Calculate Sum
    function calculateSum() {
        document.getElementById("change").value = '';
        var taxnumber = $("#txfieldnum").val();

        var t = 0,
            a = 0,
            e = 0,
            o = 0,
            f = 0,
            p = 0,
            invdis =  $("#invdcount").val();
        //Total Tax
        for(var i=0;i<taxnumber;i++){

            var j = 0;
            $(".total_tax"+i).each(function () {
                isNaN(this.value) || 0 == this.value.length || (j += parseFloat(this.value))
            });
            $("#total_tax_amount"+i).val(j.toFixed(2, 2));

        }
        //Total Discount
        $(".total_discount").each(function() {
            isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
        }),

            $("#total_discount_ammount").val(p.toFixed(2,2)),

            $(".totalTax").each(function () {
                isNaN(this.value) || 0 == this.value.length || (f += parseFloat(this.value))
            }),
            $("#total_tax_amount").val(f.toFixed(2, 2)),

            //Total Price
            $(".total_price").each(function() {
                isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
            }),

            o = a.toFixed(2,2),
            e = t.toFixed(2,2);
        tx = f.toFixed(2, 2),
            ds = p.toFixed(2, 2);

        var test = +tx + +e + -ds+ -invdis;
        // var invdis    = $("#invdcount").val();
        var totaldiscount = +ds + +invdis;
        $("#grandTotal").val(test.toFixed(2, 2));
        $("#total_discount_ammount").val(totaldiscount.toFixed(2, 2));
        var previous    = $("#previous").val();
        var gt          = $("#grandTotal").val();

        var grnt_totals = +gt+ +previous;
        $("#n_total").val(grnt_totals.toFixed(2,2));
        invoice_paidamount();

    }

    //Invoice Paid Amount
    function invoice_paidamount() {

        var t = $("#n_total").val(),

            a = $("#paidAmount").val(),
            e = t - a;
        d = a - t;
        if(e > 0){
            $("#dueAmmount").val(e.toFixed(2,2))
        }else{
            $("#dueAmmount").val(0);
            $("#change").val(d.toFixed(2,2))

        }
    }
    //Stock Limit
    function stockLimit(t) {
        var a = parseInt($("#total_qntt_" + t).val()),
            e = $(".product_id_" + t).val();
           stock=parseInt($("#available_quantity_"+t).val());

            if(a > stock){
                alert('Stock out please purchase');
                $("#total_qntt_" + t).val('');
            }


    }



    //Invoice full paid
    function full_paid() {
        var grandTotal = $("#n_total").val();
        $("#paidAmount").val(grandTotal);
        invoice_paidamount();
        calculateSum();
    }

    function invoice_discount(){
        var gt = $("#n_total").val();
        var invdis    = $("#invdcount").val();
        var grnt_totals = gt-invdis;

        $("#total_discount_ammount").val(grnt_totals.toFixed(2,2))
        $("#invtotal").val(grnt_totals.toFixed(2,2))
        $("#dueAmmount").val(grnt_totals.toFixed(2,2))

    }
    //discount and paid check
    function checknum(){
        var dis=$("#invdcount").val();
        var paid=$("#paidAmount").val();
        if (isNaN(dis))
        {
            alert("Invoice discount should be numeric");
            document.getElementById("invdcount").value = '';
            return false;
        }
        if (isNaN(paid))
        {
            alert("Paid amount should be numeric");
            document.getElementById("paidAmount").value = '';
            return false;
        }
    }
</script>

<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>