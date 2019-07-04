@extends('partials.master')
@section('page_title')
    Patient Visitation (Eye): {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    <a href="/patient/eye/history/{{$patient->id}}" class="btn btn-primary"><span
                class="fa fa-eye"></span> Patient Eye History </a>

    @can('bill_patient')
        <a href="{{route('patient.diagnosis.billing',$patient->id)}}" class="btn btn-primary"><span
                    class="fa fa-user"></span>
            Patient Billing </a>

        {{--<button--}}
        {{--type="button"--}}
        {{--class="btn btn-primary btn-md"--}}
        {{--data-toggle="modal"--}}
        {{--data-target="#Bill_Patient_Modal">--}}
        {{--<span class="fa fa-money"></span> Patient Billing--}}
        {{--</button>--}}
    @endcan
@endsection
@section('content')



                    {{--<form action="/diagnose/eye/{{$patient->id}}" method="post" enctype="multipart/form-data"--}}
                    {{--id="Diagnose_Patient_Form">--}}
                    {!! Form::model($patient, ['method' => 'PUT', 'route' => ['eye.update',  $patient->id] , 'files' => true,'id'=>"Diagnose_Patient_Form"] ) !!}
                    <div class="col-md-12" style="margin-bottom: 10px">
                        <div class="col-md-3">
                            <div class="circle">

                                {!! Form::text('left', null,['class' => 'form-control']) !!}


                            </div>
                        </div>
                        <div class="col-md-3 ">
                        </div>
                        <div class="col-md-3 ">
                        </div>
                        <div class="col-md-3 ">
                            <div class="circle ">
                                {!! Form::text('right',null,  ['class' => 'form-control']) !!}
                            </div>
                        </div>


                    </div>

                @include('partials.diagnosisform')

                {!! Form::close() !!}


    <!-- /#page-wrapper -->





@endsection

@section('jsfiles')



    {{--<script language="javascript" type="text/javascript" src="public/js/validator.min.js"></script>--}}
    {{--<script language="javascript" type="text/javascript" src="public/js/validator.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('#Diagnose_Patient_Form')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
//                    valid: 'glyphicon glyphicon-ok',
//                    invalid: 'glyphicon glyphicon-remove',
//                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {


                        DiagDate: {
                            validators: {
                                notEmpty: {},

                                date: {
                                    format: 'DD/MM/YYYY',
                                    message: 'The date is not a valid'

                                },
                            }
                        },
                        temperature: {
                            validators: {

                                integer: {},
                            }
                        }, pressure: {
                            validators: {

                                integer: {},
                            }
                        }, weight: {
                            validators: {

                                integer: {},
                            }
                        }, pulse: {
                            validators: {

                                integer: {},
                            }
                        }, diagnosis: {
                            validators: {

                                notEmpty: {},
                            }
                        }, treatment: {
                            validators: {

                                notEmpty: {},
                            }
                        },


                    }
                })


        });
    </script>

    <script type="text/javascript" src="/js/billing.js"></script>




@endsection
    
