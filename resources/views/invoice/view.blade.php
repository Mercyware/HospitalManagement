@extends('partials.master')
@section('page_title')
    Invoice : {{$patient->name}}
@endsection
@section('page_buttons')
    {{--@include('buttons.patientshome')--}}
@endsection
@section('content')
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>


    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">

            {{--@include('partials.flash')--}}


            <div class="col-xs-12" style="margin-left:0px; padding-left:0px;">
                <div class="col-xs-3">
                    {{--<a href="#" class="thumbnail">--}}
                    {{--<img src="/Images/logo.png" alt="..." data-src="holder.js/100%x180"--}}
                    {{--class="Profile_Picture" id="preview_Accountant">--}}
                    {{--</a>--}}
                </div>

                <div class="col-xs-3" style="margin-left:0px; padding-left:0px;">

                </div>

                <div class="col-xs-6"
                     style="margin-left:0px; padding-left:0px; text-align:right; margin-top: 20px;">

                    <h5>
                        <strong>Date: {{ \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y') }}</strong>
                    </h5>

                </div>
            </div>

            <div class="panel-body">


                <div class="row">

                    <div class="col-xs-12">


                        <div class="col-xs-12"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">


                            <div class="col-xs-6"
                                 style="margin-left:0px; padding-left:0px; text-align:left; ">
                                <strong>Payment To</strong>
                                <h5>{{$company->name}}</h5>
                                <h5>{{$company->address}}</h5>
                                <h5>{{$company->email}}</h5>
                                <h5>{{$company->phone}}</h5>
                            </div>

                            <div class="col-xs-6"
                                 style="margin-left:0px; padding-left:0px; text-align:right;">
                                <strong>Bill To</strong>
                                <h5>{{$patient->name}}</h5>
                                <h5>{{$patient->address}}</h5>
                                <h5>{{$patient->email}}</h5>
                                <h5>{{$patient->phone}}</h5>
                            </div>
                        </div>

                        <div class="col-xs-12"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <h5><strong>Invoice Details</strong></h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bill Name</th>

                                                {{--<th>Qty</th>--}}
                                                {{--<th>Discount</th>--}}
                                                <th>Amount Paid</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $SN = 1;
                                            $amountTotal = 0;
                                            $billTotal = 0;
                                            $totalDiscount = 0;
                                            $totalPreviousPayment = 0;
                                            ?>
                                            @if($diagnosisPays)
                                                @foreach($diagnosisPays as $diagnosisPay)
                                                    <?php

                                                    $amountTotal += ($diagnosisPay->amount);
                                                    //Get Prevoios Payments on this Invoice

                                                    ?>
                                                    <tr>
                                                        <td>{{$SN++}}</td>
                                                        <td>Medical Care Bill Payment</td>


                                                        <td># {{number_format($diagnosisPay->amount)}}</td>

                                                    </tr>

                                                @endforeach
                                            @endif



                                            {{--//Diagnostic--}}
                                            <!--                                            --><?php //$billTotal = 0; ?>
                                            @if($diagnosticPays)
                                                @foreach($diagnosticPays as $diagnosticPay)
                                                    <?php

                                                    $amountTotal += ($diagnosticPay->amount);
                                                    //Get Prevoios Payments on this Invoice


                                                    ?>
                                                    <tr>
                                                        <td>{{$SN++}}</td>
                                                        <td>Payment for Diagnostic Bills</td>


                                                        <td># {{number_format($diagnosticPay->amount)}}</td>

                                                    </tr>

                                                @endforeach
                                            @endif


                                            @if($laboratoryPays)
                                                @foreach($laboratoryPays as $laboratoryPay)
                                                    <?php

                                                    $amountTotal += ($laboratoryPay->amount);
                                                    //Get Prevoios Payments on this Invoice



                                                    ?>
                                                    <tr>
                                                        <td>{{$SN++}}</td>
                                                        <td>Laboratory Payment</td>


                                                        <td># {{number_format($laboratoryPay->amount)}}</td>

                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->


                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">


                            <div class="col-xs-3"
                                 style="margin-left:0px; padding-left:0px; text-align:left; ">

                            </div>

                            <div class="col-xs-9"
                                 style="margin-left:0px; padding-left:0px; text-align:right;">

                                {{--<h5>Bill Total: # {{number_format($billTotal)}}</h5>--}}
                                {{--<h5>Bill Discount: # {{number_format($totalDiscount)}}</h5>--}}

                                <h5><strong>Amount Received : # {{number_format($amountTotal)}}</strong></h5>

                                {{--<h5>Total Paid :{{number_format($totalPreviousPayment)}}</h5>--}}
                                {{--<strong>Balance :--}}
                                {{--# {{number_format($billTotal - $totalDiscount - $totalPreviousPayment)}}</strong>--}}
                            </div>
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

