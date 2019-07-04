@extends('partials.master')
@section('page_title')
    Patient Invoice : {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
@endsection
@section('content')

    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>



    <form action="/invoice/pay/{{$patient->id}}/{{$date_received}}" method="post" id="Register_Patient_Form">
        {{csrf_field()}}
        <div class="form-group row">
            <div class="col-xs-2">
                <label for="ex1">Payment Date</label>
                <input class="form-control DatePicker" id="ex1" required type="text"
                       name="date_received" autocomplete="off">
            </div>
            <div class="col-xs-2">
                <label for="ex2">Amount Payed</label>
                <input class="form-control" required id="ex2" type="text" name="amount" autocomplete="off">
            </div>
            <div class="col-xs-4">
                <label for="ex3">Payment Type</label>
                <select class="form-control" name="paytype" required>
                    <option value="">Select an Option</option>
                    <option value="1">Cash</option>
                    <option value="2">Cheque</option>
                    <option value="3">POS</option>
                    <option value="4">Transfer</option>
                </select>
            </div>
            <div class="col-xs-4">
                <label for="ex3">&nbsp;</label>
                <input type="submit" class=" form-control btn btn-md btn-primary" name="submit"
                       value="Make Payment">
            </div>
        </div>
    </form>

    <hr/>
    <div class="col-md-12">

        <div class="dataTable dataTables_paginate dataTable_wrapper ">
            <table class="table table-bordered " id="users-table">
                <thead>
                <tr>

                    <th>Bill Title</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Billed By</th>


                </tr>


                </thead>
                <tbody>

                </tbody>

            </table>
            <div id="results"></div>
            <div class="loading-info"><img src="/Images/ajax-loader.gif"/></div>

        </div>


    </div>



    <meta name="csrf-token" content="{{ csrf_token() }}">



@endsection
@section('jsfiles')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.min.js"></script>
    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.js"></script>
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        $(window).on('unload', function () {

            $(window).scrollTop(0);
        });

        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var track_page = 1; //track user scroll as page number, right now page number is 1
        var loading = false; //prevents multiple loads
        //$("#results").empty();
        load_contents(track_page);

        $(window).scroll(function () { //detect page scroll
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page
                //      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {

                track_page++; //page number increment
                load_contents(track_page); //load content
            }
        });

        //Ajax load function
        function load_contents(track_page) {

            if (loading == false) {
                loading = true;  //set loading flag on
                $('.loading-info').show(); //show loading animation

                $.post('/invoice/makepayment/ajaxcall/{{$patient->id}}/{{$date_received}}/' + track_page, {
                    'page': track_page,
                    "_token": csrf_token,
                }, function (data) {
                    loading = false; //set loading flag off once the content is loaded
                    if (data.trim().length == 0) {
                        //notify user if nothing to load
                        $('.loading-info').html("");
                        return;
                    }
                    $('.loading-info').hide(); //hide loading animation once data is received
                    $("#users-table").append(data); //append data into #results element

                }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                })
            }
        }


    </script>
    <script>
        //datepicker
        $(function () {


            $.fn.datepicker.defaults.format = "dd/mm/yyyy";
            $('.DatePicker').datepicker({
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });


        });


    </script>




    {{--<script language="javascript" type="text/javascript" src="public/js/validator.min.js"></script>--}}
    {{--<script language="javascript" type="text/javascript" src="public/js/validator.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('#Register_Patient_Form')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
//                    valid: 'glyphicon glyphicon-ok',
//                    invalid: 'glyphicon glyphicon-remove',
//                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {


                        date_received: {
                            validators: {
                                notEmpty: {},

                                date: {
                                    format: 'DD/MM/YYYY',

                                },
                            }
                        },
                        paytype: {
                            validators: {
                                notEmpty: {},
                            }
                        },
                        amount: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        }


                    }
                })
        });
    </script>

@endsection

