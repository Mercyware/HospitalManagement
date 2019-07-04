@extends('partials.master')
@section('page_title')
    New Blood Group
@endsection
@section('page_buttons')

@endsection
@section('content')



    {{--<form action="/patients/create" method="post" enctype="multipart/form-data"--}}
    {{--id="Register_Patient_Form">--}}
    {{--{!! Form::open(['route' => ['patients.create'] ]) !!}--}}
    {{--{!! Form::model(['method' => 'POST', 'files' => true, 'route' => ['patients.store' ] ]) !!}--}}

    {{Form::open(['route' => ['blood.bank.store'], 'files' => true,'id'=>"Register_Patient_Form"])}}
    {{--@include('partials.errors')--}}
    {{--{{csrf_field()}}--}}
    <div class="col-sm-6">


        <div class="form-group @if ($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
        </div>

        <div class="form-group @if ($errors->has('rh_factor')) has-error @endif">
            {!! Form::label('rh_factor', 'Rhesus Factor') !!}
            {!! Form::select('rh_factor', ['+'=>'+ (Positive)','-'=>'- (Negative)'],'+',   ['class' => 'form-control']) !!}
            @if ($errors->has('rh_factor')) <p
                    class="help-block">{{ $errors->first('rh_factor') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('qty')) has-error @endif">
            {!! Form::label('qty', 'Quantity') !!}
            {!! Form::text('qty', null, ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
            @if ($errors->has('qty')) <p
                    class="help-block">{{ $errors->first('qty') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('price')) has-error @endif">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
            @if ($errors->has('price')) <p
                    class="help-block">{{ $errors->first('price') }}</p> @endif
        </div>


    </div>
    <!-- /.col-lg-6 (nested) -->
    <div class="col-sm-6">


        <!-- /.col-lg-6 (nested) -->
    </div>
    <div class="col-sm-12 ">

        <input type="submit" class="btn btn-success btn-md pull-left" value="Register">

    </div>

    {!! Form::close() !!}
    {{--</form>--}}



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection

@section('jsfiles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.min.js"></script>
    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.js"></script>










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


                        name: {
                            validators: {
                                notEmpty: {},
                            }
                        },
                        qty: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        }, price: {
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
    
