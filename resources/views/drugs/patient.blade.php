@extends('partials.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pending Medications ({{$patient->name}} ) </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            @include('partials.errors')
            <div class="panel panel-default">
                <div class="panel-heading">
                    @can('add_drugs')
                        <a href="/drugs/create" class="btn btn-success">New Drug</a>
                    @endcan
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                    @include('partials.flash')

                    <form action="/drugs/medication/create/{{$patient->id}}/{{$medications[0]->date_created}}"
                          method="post" enctype="multipart/form-data"
                          id="Medication_Form">
                        {{csrf_field()}}
                        <div class="alert alert-info">
                            The medication was prescribed
                            on {{ \Carbon\Carbon::createFromFormat('Y-m-d', $medications[0]->date_created)->format('d/m/Y') }}
                            by <strong>{{$user->name}} </strong> (<em>{{$user->position}}</em>)
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="BirthDate">Date</label>

                                        <div class="input-group input-append date DatePicker">
                                            <input type="text" class="form-control" name="date_created"
                                                   value="{{ date('d/m/Y') }}"/>
                                            <span class="input-group-addon add-on"><span
                                                        class="glyphicon glyphicon-calendar"></span></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        @foreach ($medications as $medication)
                            <?php
                            $drug = \App\Drug::find($medication->drug_id);
                            $BranchId = auth()->user()->branch_id;

                            ?>
                            @if($drug->branch_id == $BranchId)


                                <div class="col-md-6" style="margin-bottom: 10px">

                                    <div class="form-group">
                                        <h3 class="text-black">{{$drug->drugname}}</h3>

                                        <p><strong>Usage : </strong> {{$medication->usage}} , <strong>No of Days
                                                :</strong> {{$medication->days}}</p>

                                        <p><strong>Quantity Left</strong> : {{$drug->qty}}, <strong>Cost/Unit
                                                :</strong> {{number_format($drug->price)}}</p>

                                        <label class="text-black">Quantity :</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="drug_id[]" value="{{$drug->id}}">
                                                <div class="form-group">
                                                    <input class="form-control input-sm" type="number"
                                                           placeholder="Quantity"
                                                           required
                                                           name="qty[]"/>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            @endif
                        @endforeach

                        <div class="col-sm-12 ">

                            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Save Medication">

                        </div>
                    </form>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




@endsection
@section('jsfiles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.min.js"></script>
    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.js"></script>









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
            $('#Medication_Form')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
//                    valid: 'glyphicon glyphicon-ok',
//                    invalid: 'glyphicon glyphicon-remove',
//                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {


                        date_created: {
                            validators: {
                                notEmpty: {},

                                date: {
                                    format: 'DD/MM/YYYY',

                                },
                            }
                        },
                        'qty[]': {
                            validators: {

                                integer: {},
                            }
                        },


                    }
                })

        });
    </script>







@endsection



