@extends('partials.master')
@section('page_title')
    Invoice : {{$patient->name}}
@endsection
{{--@section('page_buttons')--}}
    {{--@include('buttons.patientshome')--}}
{{--@endsection--}}
@section('content')
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>


    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">



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
                        {{--<strong>Date: {{ \Carbon\Carbon::createFromFormat('Y-m-d', $date_received)->format('d/m/Y') }}</strong>--}}
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
                                <h5>Medcrux Integrated Health Services</h5>
                                @if($getbranch)
                                    <h5>{{$getbranch->address}}</h5>
                                    <h5>{{$getbranch->email}}</h5>
                                    <h5>{{$getbranch->phone}}</h5>
                                @else
                                    <p><em>No payment has been made on this invoice</em></p>
                                @endif
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
                                                <th>Amount</th>
                                                <th>Qty</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $SN = 1;
                                            $AmountTotal = 0
                                            ?>
                                            @foreach($patientBills as $patientBill)
                                                <?php
                                                $AmountTotal += ($patientBill->amount * $patientBill->qty);
                                                ?>
                                                <tr>
                                                    <td>{{$SN++}}</td>
                                                    <td>{{$patientBill->bill_title}}</td>
                                                    <td>{{number_format($patientBill->amount)}}</td>
                                                    <td>{{$patientBill->qty}}</td>
                                                    <td>@if($patientBill->is_subtract_discount) {{$patientBill->discount}}
                                                        % @endif </td>
                                                    <td>
                                                        @if($patientBill->is_subtract_discount)
                                                            {{number_format(($patientBill->amount * $patientBill->qty) - (($patientBill->amount * $patientBill->qty) *($patientBill->discount/100) )) }}
                                                        @else
                                                            {{number_format(($patientBill->amount * $patientBill->qty)+ (($patientBill->amount * $patientBill->qty) *($patientBill->discount/100) )) }}
                                                        @endif
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


                        <div class="col-xs-12"
                             style="margin-left:0px; padding-left:0px; margin-top: 10px;">


                            <div class="col-xs-3"
                                 style="margin-left:0px; padding-left:0px; text-align:left; ">

                            </div>

                            <div class="col-xs-9"
                                 style="margin-left:0px; padding-left:0px; text-align:right;">
                                {{--<h5><strong>Amount Received : {{number_format($mybills[0]->totalPayed)}}</strong></h5>--}}
                                <h5>Bill Total: {{number_format($AmountTotal)}}</h5>
                                <h5>Total Paid :{{number_format($bills[0]->totalPayed)}}</h5>
                                <strong>Balance : {{number_format($AmountTotal - $bills[0]->totalPayed)}}</strong>
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


