@extends('partials.master')
@section('page_title')
    New Diagnostic Test
@endsection
@section('page_buttons')
    @can('add_patients')
        <a href="{{route('diagnostics.test',$patient->id)}}" class="btn btn-success">New Diagnostic
            Test</a>
    @endcan
@endsection
@section('content')


    <!-- /.row -->


    {{Form::open(['route' => ['diagnostics.update'], 'files' => true,'id'=>"Register_Patient_Form"])}}
    {{--@include('partials.errors')--}}
    {{--{{csrf_field()}}--}}
    <div class="col-sm-6">

        <input type="hidden" name="id" value="{{$test->id}}">
        <div class="form-group @if ($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $test->name, ['class' => 'form-control', 'placeholder' => 'Name',"autocomplete"=>"off"]) !!}
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('normal_range')) has-error @endif">
            {!! Form::label('normal_range', 'Normal Range') !!}
            {!! Form::text('normal_range', $test->normal_range, ['class' => 'form-control', 'placeholder' => 'Normal Range',"autocomplete"=>"off"]) !!}
            @if ($errors->has('normal_range')) <p
                    class="help-block">{{ $errors->first('normal_range') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('price')) has-error @endif">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', $test->price, ['class' => 'form-control', 'placeholder' => 'Price',"autocomplete"=>"off"]) !!}
            @if ($errors->has('price')) <p
                    class="help-block">{{ $errors->first('price') }}</p> @endif
        </div>


    </div>
    <!-- /.col-lg-6 (nested) -->
    <div class="col-sm-6">


        <!-- /.col-lg-6 (nested) -->
    </div>
    <div class="col-sm-12 ">

        <input type="submit" class="btn btn-success btn-md pull-left" value="Update Test">

    </div>

    {!! Form::close() !!}

    <!-- /.row -->


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
    
