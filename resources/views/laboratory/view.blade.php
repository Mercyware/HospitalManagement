@extends('partials.master')
@section('page_title')
   Laboratory Results: {{$patient->name}}
@endsection
@section('page_buttons')
    {{--@can('add_patients')--}}
        {{--<a href="{{route('laboratory.patient.test',$patient->id)}}" class="btn btn-success">New--}}
            {{--Laboratory--}}
            {{--Test</a>--}}
    {{--@endcan--}}
@endsection
@section('content')

    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>

    <div class="row">
        <div class="col-lg-12">
            {{--<h1 class="page-header hidden-print">Invoice : {{$patient->name}}</h1>--}}

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">

            {{--@include('partials.flash')--}}


            <div class="col-xs-12" style="margin-left:0px; padding-left:0px;">


                <div class="col-xs-12 text-center" style="margin-left:0px; padding-left:0px;">
                    <h2 class="text-black">{{$company->name}}</h2>
                    <h4>{{$company->address}}</h4>
                    <h5>Email : {{$company->email}}</h5>
                    <h5>Phone : {{$company->phone}}</h5>
                </div>


            </div>


            <div class="panel-body">


                <div class="row">

                    <div class="col-xs-12">


                        <div class="col-xs-12"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">


                            <div class="col-xs-6"
                                 style="margin-left:0px; padding-left:0px; text-align:left; ">

                                <h5>Patient Name : {{$patient->name}}</h5>
                                {{--<h5>Patient Age : {{$patient->a}}</h5>--}}
                                <h5>Date
                                : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $laboratories[0]->date)->format('d/m/Y') }}</h5>
                            </div>

                            <div class="col-xs-6"
                                 style="margin-left:0px; padding-left:0px; text-align:right;">
                                <h5>Specimen : {{$patient->name}}</h5>
                                <h5>Doctor's Name :..............................</h5>
                                <h5>Clinical Summary &
                                    ............................................</h5>

                            </div>
                        </div>

                        <div class="col-xs-12"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <h5><strong>Patient Test / Results</strong></h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Test Name</th>
                                                <th>Result</th>
                                                <th>Normal Range</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $SN = 1;
                                            ?>
                                            @foreach($laboratories as $laboratory)

                                                <tr>

                                                    <td>{{$SN++}}</td>

                                                    <td>{{ ($laboratory->tests->name)}}</td>

                                                    <td>


                                                        <strong>{{$laboratory->result}}</strong>


                                                    </td>
                                                    <td>
                                                        <strong>{{$laboratory->normal_range}}</strong>
                                                    </td>

                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->


                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 text-right"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">

                            <h5>..............................................................</h5>
                            <h5>Laboratory Scientist / Date</h5>


                        </div>


                        <!-- /.panel -->


                    </div>
                </div>
            </div>

            <div class="modal-footer hidden-print">
                &nbsp;
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="print()">Print
                </button>
            </div>


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




@endsection


