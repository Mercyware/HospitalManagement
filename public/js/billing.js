$(document).ready(function () {
    var titleValidators = {
            // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {}
            }
        },


        priceValidators = {
            validators: {
                notEmpty: {},
                numeric: {}
            }
        },

        bookIndex2 = 0;

    $('#Billing_Patient_Form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
//             valid: 'glyphicon glyphicon-ok',
//           invalid: 'glyphicon glyphicon-remove',
//           validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'FeeName[0].FeeNames': titleValidators,
                'Amount[0].Amounts': priceValidators,
                BillDate: {
                    validators: {
                        notEmpty: {},
                        date: {
                            format: 'DD/MM/YYYY',
                        }
                    }
                },


            }
        })
        .on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv = $form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    // ... Process the result ...
                    $("#Diagnosis_message").html(result);
                    // alert( result );

                    $('.totalLinePrice').each(function () {
                        $(this).val("");
                    });


                    $('#Bill_Patient_Modal').modal('hide');

                    //$('#Billing_Patient_Form').formV('resetForm', true);
                }
            });
        })
        // Add button click handler
        .on('err.field.fv', function (e, data) {
            // $(e.target)  --> The field element
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            // Hide the messages
            data.element
                .data('fv.messages')
                .find('.help-block[data-fv-for="' + data.field + '"]').hide();
        })

        // Add button click handler
        .on('click', '.FaddButton', function () {
            bookIndex2++;
            var $template = $('#Fees'),
                $clone = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id')
                    .attr('data-book-index', bookIndex2)
                    .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="FeeNames"]').attr('name', 'FeeName[' + bookIndex2 + '].FeeNames').end()
                .find('[name="Amounts"]').attr('name', 'Amount[' + bookIndex2 + '].Amounts').end()


            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            $('#Billing_Patient_Form')
                .formValidation('addField', 'FeeName[' + bookIndex2 + '].FeeNames', titleValidators)
                .formValidation('addField', 'Amount[' + bookIndex2 + '].Amounts', priceValidators)
//                 .formValidation('addField', 'book[' + bookIndex + '].price', priceValidators);
        })

        // Remove button click handler
        .on('click', '.FremoveButton', function () {
            var $row = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // Remove element containing the fields
            $row.remove();
        });
});

//    $(document).on('change keyup blur', '#Amount', function () {
//
//    });
//total price calculation
function calculateTotal() {


    total = 0;


    $('.totalLinePrice').each(function () {
        if ($(this).val() != '') total += parseFloat($(this).val());
    });


    $("#TotalBill").html("<strong>Total Bill : " + total.toFixed(2) + "</strong>");
}

//datepicker
$(function () {


    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $('.DatePicker').datepicker({
        autoclose: true,
        clearBtn: true,
        todayHighlight: true
    });


});
