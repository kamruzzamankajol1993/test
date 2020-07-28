// Counts and limit for purchase order
var count = 1;
var limits = 500;

function addPurchaseOrderField1(divName) {

    count++;
    if (count == limits) {
        alert("limit exceed");
    } else {
        var newdiv = document.createElement('tr');
        var tabin = "product_name_" + count;
        tabindex = count * 7 ,
            newdiv = document.createElement("tr");
        tab1 = tabindex + 1;

        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tabindex + 6;
        tab7 = tabindex + 7;
        tab8 = tab7 + 1;


        newdiv.innerHTML = '<td class="span3 manufacturer">\n' +
            '        <input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_pur_or_list('+ count +');" placeholder="" id="product_name_'+ count +'"\n' +
            '               tabindex="\'+tab1+\'" > <input type="hidden" class="autocomplete_hidden_value product_id_'+ count +'" name="product_id[]" id="SchoolHiddenId" /> <input type="hidden" class="sl" value="'+ count +'" />\n' +
            '    </td>\n' +
            '    <td><input type="text" name="batch_id[]" id="batch_id_'+ count +'" tabindex="\'+tab2+\'" class="form-control text-right" required tabindex="11" placeholder="" /></td>\n' +
            '    <td><input type="text" name="expire_date[]" onchange="checkExpiredate('+ count +')" id="expire_date_'+ count +'" required class="form-control datepicker" tabindex="\'+tab3+\'" placeholder="" /></td>\n' +
            '    <td class="wt"><input type="text" id="available_quantity_'+ count +'" class="form-control text-right stock_ctn_'+ count +'" placeholder="0.00" readonly /></td>\n' +
            '    <td class="text-right">\n' +
            '        <input\n' +
            '                type="text"\n' +
            '                name="quantity[]"\n' +
            '                tabindex="\'+tab4+\'"\n' +
            '                required\n' +
            '                id="quantity_'+ count +'"\n' +
            '                class="form-control text-right store_cal_' + count + '"\n' +
            '                onkeyup="calculate_store(' + count + '),checkqty(' + count + ');"\n' +
            '                onchange="calculate_store(' + count + ');"\n' +
            '                placeholder="0.00"\n' +
            '                value=""\n' +
            '                min="0"\n' +
            '        />\n' +
            '    </td>\n' +
            '    <td class="test">\n' +
            '        <input\n' +
            '                type="text"\n' +
            '                name="rate[]"\n' +
            '                readonly\n' +
            '                required\n' +
            '                onkeyup="checkqty('+count+'),calculate_store('+count+')"\n' +
            '                onchange="calculate_store('+count+');"\n' +
            '                id="product_rate_'+count+'"\n' +
            '                class="form-control product_rate_'+count+' text-right"\n' +
            '                placeholder="0.00"\n' +
            '                value=""\n' +
            '                min="0"\n' +
            '                tabindex="'+tab5+'"\n' +
            '        />\n' +
            '    </td>\n' +
            '    <td class="text-right"><input class="form-control total_price text-right total_price_'+ count +'" type="text" name="total_amount[]" id="total_price_'+ count +'" value="0.00" readonly="readonly" /></td>\n' +
            '    <td>\n' +
            '        <input type="hidden" id="total_discount_'+count+'" class="" /><input type="hidden" id="all_discount_'+count+'" class="total_discount" />\n' +
            '        <button style="text-align: right;" class="btn btn-danger red btn-sm" type="button" value="" onclick="deleteRow(this)" tabindex="\'+tab6+\'">Delete</button>\n' +
            '    </td>';


        document.getElementById(divName).appendChild(newdiv);
        document.getElementById(tabin).focus();
        // document.getElementById("add_invoice_item").setAttribute("tabindex", tab7);
        // document.getElementById("add_purchase").setAttribute("tabindex", tab8);

        $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });

        console.log( $(".datepicker").datepicker());


    }

}

function deleteRow(e) {
    var t = $("#purchaseTable > tbody > tr").length;
    if (1 == t) alert("There only one row you can't delete.");
    else {
        var a = e.parentNode.parentNode;
        a.parentNode.removeChild(a)
    }
    calculateSum();
}

function checkExpiredate(sl) {
    var purdates =  $("#purdate").val();
    var expiredate = $("#expire_date_"+sl).val();
    var purchasedate = new Date(purdates);
    var expirydate = new Date(expiredate);
    if (expirydate <= purchasedate ) {
        alert('Expire Date should be greater than purhcase date');
        document.getElementById("expire_date_"+sl).value = '';
        return false;
    }
    return true;
}

function checkqty(sl)
{

    var y=$("#quantity_"+sl).val();
    var x=$("#product_rate_"+sl).val();

    // if (isNaN(y)){
    //     alert('quantity  should be numeric value');
    //     document.getElementById("quantity_"+sl).value = '';
    //     //$("#quantity_"+sl).val() = '';
    //     return false;
    // }
    // if (isNaN(x))
    // {
    //     alert('quantity and supplier rate can not be empty and should be numeric value');
    //     document.getElementById("product_rate_"+sl).value = '';
    //     return false;
    // }
}

function calculate_store(sl) {
    console.log('this is called after onchange dynamic');
    var gr_tot = 0;
    var item_ctn_qty    = $("#quantity_"+sl).val();
    var vendor_rate = $("#product_rate_"+sl).val();


    var total_price  = item_ctn_qty * vendor_rate;
    $("#total_price_"+sl).val(total_price.toFixed(2));


    //Total Price
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });

    $("#grandTotal").val(gr_tot.toFixed(2,2));
}
function calculateSum() {

    var t = 0,
        a = 0,
        e = 0,
        o = 0,
        p = 0;

    //Total Discount
    $(".total_discount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }),

        $("#total_discount_ammount").val(p.toFixed(2,2)),

        //Total Price
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
        }),

        e = t.toFixed(2,2);
    f = p.toFixed(2,2);

    var test = +e+ -f;
    $("#grandTotal").val(test.toFixed(2,2));
}