@extends('partials.master')
@section('page_title')
    Patient Visitation {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    <a href="/patient/dental/history/{{$patient->id}}" class="btn btn-primary"><span
                class="fa fa-history"></span> Patient Medical History </a>

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




    {{--<form action="/diagnose/dental/{{$patient->id}}" method="post" enctype="multipart/form-data"--}}
    {{--id="Diagnose_Patient_Form">--}}

    {!! Form::model($patient, ['method' => 'PUT', 'route' => ['dental.update',  $patient->id] , 'files' => true,'id'=>"Diagnose_Patient_Form"] ) !!}

    @include('partials.diagnosisform')
    {!! Form::close() !!}

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

//                .on('success.form.fv', function (e) {
//                    // Prevent form submission
//                    e.preventDefault();
//
//                    var $form = $(e.target),
//                        fv = $form.data('formValidation');
//
//                    // Use Ajax to submit form data
//                    $.ajax({
//                        url: $form.attr('action'),
//                        type: 'POST',
//                        data: $form.serialize(),
//                        dataType: "json",
//
//                        success: function (response) {
//                            // alert(response['success']);
//                            $("#Diagnosis_message").html("<div class='alert alert-success'>" + response['message'] + "</div>");
//                            $("#Diagnose_Patient_Form")[0].reset();
//                            fv.disableSubmitButtons(true);
//                        },
//                        error: function (data) {
//                            // console.log(e.responseText);
//                            //   $("#Diagnosis_message").html(e.responseText)
//                            console.log(data.responseText);
//                            var obj = $.parseJSON(data.responseText);
//                            if (obj.temperature) {
//                                $("#Diagnosis_message").html("<div class='alert alert-danger'> " + obj.temperature +"</div>");
//
//                            }
//
//
//
//                         //   $("#Diagnosis_message").html("<div class='alert alert-danger'> An error has occurred , please check your inputs</div>");
//                         //   $("#Diagnose_Patient_Form")[0].reset();
//                          //  fv.disableSubmitButtons(true);
//                        }
//
//                    });
//                });
        });
    </script>

    <script type="text/javascript" src="/js/billing.js"></script>




@endsection
    
