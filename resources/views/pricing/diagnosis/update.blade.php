@extends('partials.master')
@section('page_title')
    New Blood Group
@endsection
@section('page_buttons')

@endsection
@section('content')


    {{Form::open(['route' => ['blood.bank.edit'], 'files' => true,'id'=>"Register_Patient_Form"])}}
    {{--@include('partials.errors')--}}
    {{--{{csrf_field()}}--}}
    <input type="hidden" name="blood_group_id" value="{{$blood->id}}">
    <div class="col-sm-6">


        <div class="form-group @if ($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $blood->name, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('qty')) has-error @endif">
            {!! Form::label('qty', 'Quantity') !!}
            {!! Form::text('qty', $blood->qty, ['class' => 'form-control', 'placeholder' => 'Quantity', 'readonly'=>'readonly']) !!}
            @if ($errors->has('qty')) <p
                    class="help-block">{{ $errors->first('qty') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('price')) has-error @endif">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', $blood->price, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
            @if ($errors->has('price')) <p
                    class="help-block">{{ $errors->first('price') }}</p> @endif
        </div>


    </div>
    <!-- /.col-lg-6 (nested) -->
    <div class="col-sm-6">


        <!-- /.col-lg-6 (nested) -->
    </div>
    <div class="col-sm-12 ">

        <input type="submit" class="btn btn-success btn-md pull-left" value="Update">

    </div>

    {!! Form::close() !!}
    {{--</form>--}}
    <!-- /.row (nested) -->



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

