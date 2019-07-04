@extends('partials.master')
@section('page_title')
    Update Appointment : {{$appointment->patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    @include('buttons.diagmenu')
@endsection
@section('content')

    <form action="/appointment/update/{{$appointment->patient->id}}" method="post" name="" id="Appointment_Form">
        @include('partials.errors')

        {{csrf_field()}}
        {{ method_field('PATCH') }}

        <div class="col-sm-12">


            <div class="form-group">
                <label>Appointment Date/Time</label>
                <input class="form-control" placeholder="Date & time of Appointment"
                       id="datetimepicker1"
                       value="{{ date('d/m/Y H:m:i', strtotime($appointment->appointment_date))}} ?>"
                       name="appointment_date">

            </div>

            <div class="form-group">
                <label>Doctor's Name </label>
                <select class="js-example-basic-single form-control" name="user">
                    @if($users)
                        @foreach($users as $user)
                            <option value="{{$user->id}}"
                                    @if($appointment->doc_id == $user->id)
                                    selected="selected"
                                    @endif
                            >{{$user->name}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label>Branch Name </label>
                <select class="js-example-basic-single form-control" name="branch">
                    @if($branches)
                        @foreach($branches as $branch)
                            <option value="{{$branch->id}}"
                                    @if($appointment->branch_id == $branch->id)
                                    selected="selected"
                                    @endif
                            >{{$branch->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->

        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-success btn-md pull-right" value="Update Appointment">

        </div>
    </form>



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection
@section('jsfiles')
    <script type="text/javascript" src="/js/datepicker/moment.min.js"></script>

    <script type="text/javascript" src="/js/datepicker/bootstrap-datetimepicker.min.js"></script>


    <link rel="stylesheet" href="/js/datepicker/bootstrap-datetimepicker.min.css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.min.js"></script>
    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#Appointment_Form')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
//                    valid: 'glyphicon glyphicon-ok',
//                    invalid: 'glyphicon glyphicon-remove',
//                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {


                        appointment_date: {
                            validators: {
                                notEmpty: {},

                                date: {
                                    format: 'DD/MM/YYYY g:ii a',

                                },
                            }
                        },
                        user: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        },
                        branch: {
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

    
