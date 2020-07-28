function addInputField(t) {
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
    var limits = 500;
    var tbfild ='';
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name_" + count,
            tabindex = count * 5,
            e = document.createElement("tr");
        tab1 = tabindex + 1;
        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tabindex + 6;
        tab7 = tabindex + 7;
        tab8 = tabindex + 8;
        tab9 = tabindex + 9;
        tab10 = tabindex + 10;
        tab11 = tabindex + 11;
        e.innerHTML = "<td>" +
            "<input type='text' name='product_name' onkeyup='invoice_productList(" + count + ");' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' placeholder='Product Name' id='" + a + "' required tabindex='"+tab1+"'><input type='hidden' class='autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td>" +
            "<td><select class='my-form-control custom_input_m_t' id='batch_id_" + count + "' name='batch_id[]' required='required' onchange='product_stock(" + count + ")' tabindex='" + count + "'>\n" +
            "                                            <option>Select Batch</option>\n" +
            "                                        </select></td> " +
            "<td><input type='text' name='available_quantity[]' id='available_quantity_" + count + "' class='form-control text-right available_quantity_" + count + "' value='0' readonly='readonly' /></td> " +

            "<td id='expire_date_" + count + "' class='dynamic_expire'></td>" +
            "<td><input class='form-control text-right unit_" + count + " valid' value='None' readonly='' aria-invalid='false' type='text'></td>" +
            "<td> <input type='text' name='quantity[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + "),stockLimit(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='total_qntt_" + count + " form-control text-right' placeholder='0.00' min='0' tabindex='"+tab3+"' required/></td>" +
            "<td><input type='text' name='rate[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='price_item"+count+" form-control text-right' required placeholder='0.00' readonly min='0' tabindex='"+tab4+"'/></td>" +
            "<td><input type='text' name='discount[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' tabindex='"+tab5+"' /><input type='hidden' value='1' name='discount_type' id='sale_discount_type_" + count + "'></td>" +
            "<td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></td><" +
            "td>" + tbfild + "<input type='hidden' id='all_discount_" + count + "' class='total_discount' name='per_product_dis_percent[]'/><a tabindex='"+tab6+"' style='text-align: right;' class='btn btn-danger btn-sm'  value='Delete' onclick='SaledeleteRow(this)'><i class='fa fa-close'></i></a>" +
            "</td>",
            document.getElementById(t).appendChild(e),
            document.getElementById(a).focus(),
        //     document.getElementById("add_invoice_item").setAttribute("tabindex", tab7);
        // document.getElementById("invdcount").setAttribute("tabindex", tab8);
        // document.getElementById("paidAmount").setAttribute("tabindex", tab9);
        // document.getElementById("full_paid_tab").setAttribute("tabindex", tab10);
        // document.getElementById("add_invoice").setAttribute("tabindex", tab11);
        count++
    }
}

//Delete a row of table
function SaledeleteRow(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) alert("There is only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e),
            calculateSum();
        invoice_paidamount();
    }
}

