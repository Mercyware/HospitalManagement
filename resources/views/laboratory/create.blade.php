@extends('partials.master')
@section('page_title')
    New Laboratory Test: {{$patient->name}}
@endsection
@section('page_buttons')
    @can('add_patients')
        <a href="{{route('laboratory.patient.test',$patient->id)}}" class="btn btn-success">New
            Laboratory
            Test</a>
    @endcan
@endsection
@section('content')
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>



    <form class="form-horizontal" method="POST" action="/laboratory/test/{{$patient->id}}"
          id="createOrderForm">
        <div class="col-md-12">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="orderDate" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control DatePicker" id="orderDate"
                               name="orderDate"
                               placeholder="Order date" value="<?php echo date("d/m/Y"); ?>"
                               autocomplete="off"/>
                    </div>
                </div>
            </div>


        </div>


        <div class='row'>
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="2%">
                            <input id="check_all" class="formcontrol" type="checkbox"/></th>
                        <th width="38%">Test Name</th>
                        <th width="15%">Result</th>
                        <th width="15%">Normal Range</th>
                        <th width="15%">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                        <td><input class="case" type="checkbox"/></td>
                        <td><input type="text" data-type="ProductName" name="itemName[]"
                                   id="itemName_1" class="form-control autocomplete_txt" required
                                   autocomplete="off"></td>
                        <td>
                            <input type="text" name="days[]" id="days_1"
                                   class="form-control totalLinePrice" autocomplete="off"
                                   ondrop="return false;" required
                                   onpaste="return false;">
                        </td>
                        <td><input type="text" name="quantity[]" id="quantity_1"
                                   class="form-control changesNo" autocomplete="off" required readonly="readonly"
                                   ondrop="return false;"
                                   onpaste="return false;"></td>
                        <td>
                            <input type="number" name="price[]" id="price_1" readonly="readonly"
                                   class="form-control changesNo" autocomplete="off"
                                   onkeypress="return IsNumeric(event);" ondrop="return false;"
                                   onpaste="return false;">

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class='row' style="padding-bottom: 10px">
            <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
                <button class="btn btn-danger delete" type="button">- Delete</button>
                <button class="btn btn-success addmore" type="button">+ Add More</button>
            </div>


        </div>
        <hr/>


        <div class="form-group submitButtonFooter">
            <div class="col-sm-offset-8  col-sm-4 ">

                <button type="submit" id="createOrderBtn" data-loading-text="Loading..."
                        class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save
                    Changes
                </button>

                <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i
                            class="glyphicon glyphicon-erase"></i> Reset
                </button>
            </div>
        </div>
    </form>






@endsection

@section('jsfiles')
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

    <script src="/js/labtest.js"></script>
    {{--<script src="custom/js/order.js"></script>--}}


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
@endsection