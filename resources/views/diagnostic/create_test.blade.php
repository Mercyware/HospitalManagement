@extends('partials.master')
@section('page_title')
    New Diagnostic Test: {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    @can('add_patients')
        <a href="{{route('diagnostics.test',$patient->id)}}" class="btn btn-success">New Diagnostic
            Test</a>
    @endcan
@endsection
@section('content')
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>

    <form class="form-horizontal" method="POST" action="{{route('diagnostics.test.store',$patient->id)}}"
          id="createOrderForm">
        {{csrf_field()}}
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

                <table class="table table-condensed table-bordered" style="border-collapse:collapse;" id="testTable">

                    <thead>
                    <tr>
                        <th>&nbsp;</th>

                        <th>Test Name</th>
                        <th>Normal Range</th>
                        <th>Price</th>
                        <th>Discount</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($diagnostics as $test)


                        <tr data-toggle="collapse" data-target="#table{{$test->id}}"
                            class="accordion-toggle">
                            <td>
                                <input type="checkbox" name="test[{{$test->id}}]" class="table{{$test->id}}">
                                <input type="hidden" name="test_id[{{$test->id}}]" value="{{$test->id}}">
                                <input type="hidden" name="test_name[{{$test->id}}]" value="{{$test->name}}">

                            </td>
                            <td>{{$test->name}}</td>
                            <td>{{$test->normal_range}} {{$test->unit}}</td>
                            <td>{{$test->price}}</td>
                            <td><input type="text" name="discount[{{$test->id}}]" class="form-control"></td>


                        </tr>

                    @endforeach
                    </tbody>
                </table>

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




    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection

@section('jsfiles')
    <link href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"/>
    <script src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

    {{--<script src="/js/diagnostic_test.js"></script>--}}
    {{--<script src="custom/js/order.js"></script>--}}


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
    <script>
        $(document).ready( function () {
            $('#testTable').DataTable();
        } );
    </script>
@endsection