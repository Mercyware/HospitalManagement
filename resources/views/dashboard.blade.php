@extends('partials.master')
@section('page_title')
    Dashboard
@endsection

@section('content')




    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="box">
                <div class="box-body">


                    <form method="GET" id="search-form" role="form" action="{{route('dashboard')}}">

                        <div class="form-group">


                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label for="email">Between </label>
                                    <input type="text" class="form-control DatePicker" name="date_from" id="fromdate"
                                           autocomplete="false">
                                </div>


                                <div class="col-md-6">
                                    <label for="email">and </label>
                                    <input type="text" class="form-control DatePicker" name="date_to" id="todate"
                                           autocomplete="false">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12" style="margin-top: 10px">
                                <button type="submit" class="btn btn-primary pull-right">Load Report</button>
                            </div>
                        </div>
                    </form>


                    <h3 class="">@if($date_from== null) Today's Summary Report @else Report
                        from {{date('d/m/Y', strtotime($date_from))}}
                        to {{date('d/m/Y', strtotime($date_to))}} @endif</h3>
                    <?php

                    ?>
                    <div class="col-md-3">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    {{
                                   count($visits)
                                    }}
                                </h3>


                                <p>Total Patient Visits </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bar-chart"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <h3>
                                    {{
                                    count($patients)
                                    }}
                                </h3>


                                <p>Newly Registered </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pie-chart"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>
                                    {{
                                    count($medicalCare)
                                    }}
                                </h3>


                                <p>Visits for Medical Care </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-stethoscope"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="small-box bg-yellow-gradient">
                            <div class="inner">
                                <h3>
                                    {{
                                  count($laboratoryTests) + count($diagnosticTests)
                                    }}
                                </h3>


                                <p>Visits to Lab & Diagnostics </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-stethoscope"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->

        @if(count($patients->where('created_at', '>=', \Carbon\Carbon::today()->toDateString())) >0 )
            <div class="row">
                <div class="col-md-12">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registered Patient Today</h3>

                            <div class="box-tools pull-right">
                                <span class="label label-danger">{{count($patients->where('created_at', '>=', \Carbon\Carbon::today()->toDateString()))}}
                                    Patients</span>
                                {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i--}}
                                {{--class="fa fa-minus"></i>--}}
                                {{--</button>--}}
                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i--}}
                                {{--class="fa fa-times"></i>--}}
                                {{--</button>--}}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">

                                @foreach($patients->where('created_at', '>=', \Carbon\Carbon::today()->toDateString()) as $patient)
                                    <li>
                                        <img src="{{asset('/Images/PatientPhoto/patient.jpg')}}"
                                             alt="{{$patient->name}}" width="100" height="100">
                                        <a class="users-list-name" href="#">{{ucwords($patient->name)}}</a>
                                        {{--<span class="users-list-date">{{$patient->gender}}</span>--}}
                                    </li>

                                @endforeach

                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{route('patients.index')}}" class="uppercase">View All Users</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col -->
            </div>

        @endif

        <div class="row">
            <div class="col-md-6">
                <canvas id="lineChart" width="400" height="200"></canvas>

            </div>
            <div class="col-md-6">
                <canvas id="pieChart" width="400" height="200"></canvas>

            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
@section('jsfiles')

    {{--Date Pickers--}}

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
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


    <script src="{{asset('/js/app.js')}}"></script>
    {{--Line Chart for Todays Analysis--}}
    <script>


        $(document).ready(function () {

            /**
             * call the data.php file to fetch the result from db table.
             */
            $.ajax({
                url: "/chart/patientbygender/{{$date_from}}/{{$date_to}}",
                type: "GET",
                success: function (data) {
                    console.log(data);

                    var piedata = {
                        Data: [],
                    };

                    var len = data.length;


                    for (var i = 0; i < len; i++) {
                        // if (data[i].Status == "TeamA") {
                        piedata.Data.push(data[i].Data);
                        //  }

                    }


                    console.log(piedata.Data);

                    var ctx1 = $("#pieChart");
                    // var ctx2 = $("#doughnut-chartcanvas-2");

                    var data1 = {
                        labels: ["Male", "Female"],
                        datasets: [
                            {
                                label: "Data",
                                data: piedata.Data,
                                backgroundColor: [


                                    "#36a2eb",
                                    '#ff6384',
                                ],
                                borderColor: [


                                    "#36a2eb",
                                    '#ff6384',
                                ],
                                borderWidth: [1, 1, 1, 1, 1]
                            }
                        ]
                    };


                    var options = {
                        responsive: true,
                        maintainAspectRatio: false,
                        title: {
                            display: true,
                            position: "top",
                            //    text: "Doughnut Chart",
                            fontSize: 18,
                            fontColor: "#111"
                        },
                        legend: {
                            display: true,
                            position: "bottom"
                        },
                        pieceLabel: {
                            mode: 'pie',
                            precision: 2,
                            fontSize: 20,
                            fontStyle: 'bold'


                        }, animation: {
                            onComplete: function () {
                                isChartRendered = true
                            }
                        }, title: {
                            display: true,
                            text: "Patient by Gender"
                        },
                    };


                    var chart1 = new Chart(ctx1, {
                        type: "pie",
                        data: data1,
                        options: options
                    });
                    //  chart1.canvas.parentNode.style.height = '128px';


                },
                error: function (data) {
                    console.log(data);
                }
            });

        });


    </script>


    <script>

        $(document).ready(function () {
            $.ajax({
                url: "/chart/analytics/{{$date_from}}/{{$date_to}}",
                method: "GET",
                success: function (data) {
                    console.log(data);
                    var date = [];
                    var value = [];

                    for (var i in data) {
                        date.push(data[i].Title);
                        value.push(data[i].Data);
                    }

                    var chartdata = {
                        labels: date,


                        datasets: [
                            {

                                label: 'Patient Visits Count',
                                fill: false,
                                lineTension: 0.5,
                                //backgroundColor: "rgba(59, 89, 152, 0.75)",
                                backgroundColor: '#ff6384',
                                borderColor: '#ff6384',
                                pointHoverBackgroundColor: "rgba(153,255,51,0.4)",
                                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                                data: value,
                                spanGaps: false,
                            }
                        ]
                    };

                    var ctx = $("#lineChart");
                    //  var ctx = document.getElementById("line").getContext("2d");
                    // new Chart(ctx, config);

                    var options = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {


                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Number of Patient',

                                },
                                ticks: {
                                    padding: 10,
//                                    min: -100,
//                                beginAtZero: true,
                                    suggestedMax: 10

                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: ''
                                }
                            }],
                        }, animation: {
                            onComplete: function () {
                                isChartRendered = true
                            }
                        }, title: {
                            display: true,
                            text: "Patient Visits Count"
                        },
                    };

                    new Chart(ctx, {
                        type: 'line',
                        data: chartdata,
                        options: options
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        //  document.getElementById("wrapper").style.height = '128px';

    </script>



@endsection

{{--<div class="col-lg-3 col-xs-6">--}}
{{--<!-- small box -->--}}
{{--<div class="small-box bg-yellow">--}}
{{--<div class="inner">--}}
{{--<h3>{{count($patients->where('created_at', '>=', \Carbon\Carbon::today()->toDateString()))}}</h3>--}}

{{--<p>Patients Registrations</p>--}}
{{--</div>--}}
{{--<div class="icon">--}}
{{--<i class="ion ion-person-add"></i>--}}
{{--</div>--}}
{{--<a href="{{route('patients.index')}}" class="small-box-footer">More info <i--}}
{{--class="fa fa-arrow-circle-right"></i></a>--}}
{{--</div>--}}
{{--</div>--}}


{{--<div class="col-lg-3 col-xs-6">--}}
{{--<!-- small box -->--}}
{{--<div class="small-box bg-green">--}}
{{--<div class="inner">--}}
{{--<h3>{{count($medicalCare->where('created_at', '>=', \Carbon\Carbon::today()->toDateString()))}}</h3>--}}


{{--<p>Patient for Medical Care</p>--}}
{{--</div>--}}
{{--<div class="icon">--}}
{{--<i class="fa fa-ambulance"></i>--}}
{{--</div>--}}
{{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<!-- ./col -->--}}

{{--<div class="col-lg-3 col-xs-6">--}}
{{--<!-- small box -->--}}
{{--<div class="small-box bg-aqua">--}}
{{--<div class="inner">--}}
{{--<h3>{{count($laboratoryTests->where('created_at', '>=', \Carbon\Carbon::today()->toDateString()))}}</h3>--}}

{{--<p>Laboratory Tests</p>--}}
{{--</div>--}}
{{--<div class="icon">--}}
{{--<i class="fa fa-stethoscope"></i>--}}
{{--</div>--}}
{{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<!-- ./col -->--}}
{{--<!-- ./col -->--}}
{{--<div class="col-lg-3 col-xs-6">--}}
{{--<!-- small box -->--}}
{{--<div class="small-box bg-red">--}}
{{--<div class="inner">--}}
{{--<h3>{{count($diagnosticTests->where('created_at', '>=', \Carbon\Carbon::today()->toDateString()))}}</h3>--}}

{{--<p>Diagnostics Tests</p>--}}
{{--</div>--}}
{{--<div class="icon">--}}
{{--<i class="fa fa-medkit"></i>--}}
{{--</div>--}}
{{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<!-- ./col -->--}}