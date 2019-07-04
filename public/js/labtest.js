/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//adds extra table rows
var i = $('table tr').length;
$(".addmore").on('click', function () {
    html = '<tr>';
    html += '<td><input class="case" type="checkbox"/></td>';
    html += '<td><input type="text" data-type="ProductName" name="itemName[]" id="itemName_' + i + '" class="form-control autocomplete_txt" autocomplete="off"></td>';
    html += '<td><input type="text" name="days[]" id="days_' + i + '" class="form-control totalLinePrice" autocomplete="off"  ondrop="return false;" onpaste="return false;" ></td>';
    html += '<td><input type="text" name="quantity[]" id="quantity_' + i + '" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;" readonly="readonly"></td>';
    html += '<td><input type="text" name="price[]" id="price_' + i + '" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly="readonly"></td>';
    html += '</tr>';
    $('table').append(html);
    i++;
});

//to check all checkboxes
$(document).on('change', '#check_all', function () {
    $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function () {
    $('.case:checkbox:checked').parents("tr").remove();
    $('#check_all').prop("checked", false);
    calculateTotal();
});

//autocomplete script
$(document).on('focus', '.autocomplete_txt', function () {
    type = $(this).data('type');


    if (type == 'ProductName') autoTypeNo = 0;

    $(this).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/laboratory/gettests',
                dataType: "json",
                method: 'post',
                data: {
                    name_startsWith: request.term,
                    type: type,
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        //  var code = item.split("|");

                        return {
                            label: item['name'],
                            value: item['name'],
                            data: item
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0,
        select: function (event, ui) {

            // console.log(ui.item.data);
            var names = ui.item.data;
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            //$('#itemNo_'+id[1]).val(names[0]);
            $('#itemName_' + id[1]).val(names['name']);

            $('#quantity_' + id[1]).val(names['lower'] + "/" + names['higher'] + " " + names['unit']);

            $('#price_' + id[1]).val(names['price']);
            //    $('#total_' + id[1]).val(1 * names[1]);
            //calculateTotal();
        }
    });
});

//price change
$(document).on('change keyup blur', '.changesNo', function () {
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    quantity = $('#quantity_' + id[1]).val();
    price = $('#price_' + id[1]).val();
    if (quantity != '' && price != '') $('#total_' + id[1]).val((parseFloat(price) * parseFloat(quantity)).toFixed(2));
    calculateTotal();
});

$(document).on('change keyup blur', '#tax', function () {
    calculateTotal();
});

$(document).on('change keyup blur', '#discountAmount', function () {
    calculateTotal();
});

//total price calculation 
function calculateTotal() {
    subTotal = 0;
    total = 0;
    discount = 0;

    $('.totalLinePrice').each(function () {
        if ($(this).val() != '') subTotal += parseFloat($(this).val());
    });
    $('#subTotal').val(subTotal.toFixed(2));

    tax = $('#tax').val();

    if (tax != '' && typeof(tax) != "undefined") {
        taxAmount = subTotal * ( parseFloat(tax) / 100 );
        $('#taxAmount').val(taxAmount.toFixed(2));
        total = subTotal + taxAmount;
    } else {
        $('#taxAmount').val(0);
        total = subTotal;
    }

    discountAmount = $('#discountAmount').val();

    if (discountAmount != '' && typeof(discountAmount) != "undefined") {

        total = total - discountAmount;
    }


    $('#totalAftertax').val(total.toFixed(2));
    calculateAmountDue();
}

$(document).on('change keyup blur', '#amountPaid', function () {
    calculateAmountDue();
});

//due amount calculation
function calculateAmountDue() {
    amountPaid = $('#amountPaid').val();
    total = $('#totalAftertax').val();
    if (amountPaid != '' && typeof(amountPaid) != "undefined") {
        amountDue = parseFloat(total) - parseFloat(amountPaid);
        $('.amountDue').val(amountDue.toFixed(2));
    } else {
        total = parseFloat(total).toFixed(2);
        $('.amountDue').val(total);
    }
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8, 46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log(keyCode);
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}


function PaidAllFunctions() {


    $(this).click(function () {

        var totalAftertaxID = $("#totalAftertax");

        var amountPaidID = $("#amountPaid");

        var AmountPaid = totalAftertaxID.val();

        //if ($("#PaidAll").prop("checked", true)) {
        if (document.getElementById("PaidAll").checked == true) {

            amountPaidID.val(AmountPaid);
            calculateAmountDue()
        } else {
            amountPaidID.val(0);
            calculateAmountDue()
        }

    });
}