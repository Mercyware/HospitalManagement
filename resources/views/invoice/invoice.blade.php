@extends('partials.master')
@section('page_title')
    Personal Invoice : {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
@endsection
@section('content')



    <div class="col-md-12">


        {{--Diagnosis --}}
        <div class="col-md-6">

            <h4 class="text-center">Medical Care Invoice</h4>
            <?php

            $finalBill = $diagnosisBills->sum('totalPrice')

            ?>
            <?php



            $amountPaid = $diagnosisPayment->sum('totalPaid');
            $balance = $finalBill - $amountPaid;
            if ($balance == 0) {
                $panel = "panel-success";
                $header = "Fully Paid Invoice";
            } else {
                $panel = "panel-danger";
                $header = "Invoice With Outstanding Payment";
            }
            ?>
            <div class="panel <?= $panel ?>">
                <div class="panel panel-heading">
                    <h4 class=""><?= $header ?></h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">


                        <h4 class="text-black"><strong>Total Bill : <a
                                        href="#"
                                        class="text-blueblack"># <?php echo number_format($finalBill) ?></a></strong>
                        </h4>

                        <h5 class="text-black text-right"><strong>Amount Paid
                                :</strong> <?php echo number_format($amountPaid); ?>
                        </h5>
                        <h5 class="text-black text-right"><strong>Balance
                                :</strong> <?php echo number_format($balance); ?>
                        </h5>
                    </div>
                </div>

                <div class="panel-footer text-right">

                    @if($balance >0)
                        <a href="{{route('makepayment',[$patient->id,1])}}" class="btn btn-primary">
                            <span class="fa fa-money"></span> Make Payment</a>
                    @endif
                    <a href="{{route('invoice.patient.diagnosis',$patient->id)}}"
                       class="btn btn-primary"><span class="fa fa-eye"></span> View Invoice</a>

                    <a href="{{route('payments.patient.list',$patient->id)}}"
                       class="btn btn-primary"> <span class="fa fa-eye"></span> View Payments</a>


                </div>
            </div>
        </div>


        {{--Diagnostic --}}
        <div class="col-md-6">

            <h4 class="text-center">Diagnostic Invoice</h4>
            <?php
            $finalBill = 0;



            $finalBill = $diagnosticBills->sum('price');
            $amountPaid = $diagnosticPayment->sum('amount');
            $balance = $finalBill - $amountPaid;

            if ($balance == 0) {
                $panel = "panel-success";
                $header = "Fully Paid Invoice";
            } else {
                $panel = "panel-danger";
                $header = "Invoice With Outstanding Payment";
            }
            ?>
            <div class="panel <?= $panel ?>">
                <div class="panel panel-heading">
                    <h4 class=""><?= $header ?></h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">


                        <h4 class="text-black"><strong>Total Bill : <a
                                        href="#"
                                        class="text-blueblack"># <?php echo number_format($finalBill) ?></a></strong>
                        </h4>

                        <h5 class="text-black text-right"><strong>Amount Paid
                                :</strong> <?php echo number_format($amountPaid); ?>
                        </h5>
                        <h5 class="text-black text-right"><strong>Balance
                                :</strong> <?php echo number_format($balance); ?>
                        </h5>
                    </div>
                </div>
                <div class="panel-footer text-right">

                    @if($balance >0)
                        <a href="{{route('makepayment',[$patient->id,3])}}" class="btn btn-primary">
                            <span class="fa fa-money"></span> Make Payment</a>
                    @endif

                    <a href="/invoice/patient/diagnostic/{{$patient->id}}"
                       class="btn btn-primary"><span class="fa fa-eye"></span> View Invoice</a>

                    <a href="#"
                       class="btn btn-primary"> <span class="fa fa-eye"></span> View Payments</a>

                </div>
            </div>
        </div>


        {{--Laboratory --}}
        <div class="col-md-6">

            <h4 class="text-center">Laboratory Invoice</h4>
            <?php
            $finalBill = 0;

            $finalBill = $laboratoryBills->sum('price');



            $amountPaid = $laboratoryPayment->sum('amount');
            $balance = $finalBill - $amountPaid;
            if ($balance == 0) {
                $panel = "panel-success";
                $header = "Fully Paid Invoice";
            } else {
                $panel = "panel-danger";
                $header = "Invoice With Outstanding Payment";
            }
            ?>
            <div class="panel <?= $panel ?>">
                <div class="panel panel-heading">
                    <h4 class=""><?= $header ?></h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">


                        <h4 class="text-black"><strong>Total Bill : <a
                                        href="#"
                                        class="text-blueblack"># <?php echo number_format($finalBill) ?></a></strong>
                        </h4>

                        <h5 class="text-black text-right"><strong>Amount Paid
                                :</strong> <?php echo number_format($amountPaid); ?>
                        </h5>
                        <h5 class="text-black text-right"><strong>Balance
                                :</strong> <?php echo number_format($balance); ?>
                        </h5>
                    </div>
                </div>
                <div class="panel-footer text-right">

                    @if($balance >0)
                        <a href="{{route('makepayment',[$patient->id,2])}}" class="btn btn-primary">
                            <span class="fa fa-money"></span> Make Payment</a>
                    @endif
                    <a href="{{route('invoice.patient.laboratory',$patient->id)}}"
                       class="btn btn-primary"><span class="fa fa-eye"></span> View Invoice</a>

                    <a href="#"
                       class="btn btn-primary"> <span class="fa fa-eye"></span> View Payments</a>

                </div>
            </div>
        </div>


        {{--<div id="results"></div>--}}
        {{--<div class="loading-info"><img src="/Images/ajax-loader.gif"/></div>--}}


    </div>



    <meta name="csrf-token" content="{{ csrf_token() }}">


@endsection
@section('jsfiles')
    {{--<script type="text/javascript">--}}
    {{--$(window).on('unload', function () {--}}

    {{--$(window).scrollTop(0);--}}
    {{--});--}}

    {{--var csrf_token = $('meta[name="csrf-token"]').attr('content');--}}

    {{--var track_page = 1; //track user scroll as page number, right now page number is 1--}}
    {{--var loading = false; //prevents multiple loads--}}
    {{--//$("#results").empty();--}}
    {{--load_contents(track_page);--}}

    {{--$(window).scroll(function () { //detect page scroll--}}
    {{--if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page--}}
    {{--//      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {--}}

    {{--track_page++; //page number increment--}}
    {{--load_contents(track_page); //load content--}}
    {{--}--}}
    {{--});--}}
    {{--//Ajax load function--}}
    {{--function load_contents(track_page) {--}}

    {{--if (loading == false) {--}}
    {{--loading = true;  //set loading flag on--}}
    {{--$('.loading-info').show(); //show loading animation--}}

    {{--$.post('/invoice/patient/ajaxcall/{{$patient->id}}/' + track_page, {--}}
    {{--'page': track_page,--}}
    {{--"_token": csrf_token,--}}

    {{--}, function (data) {--}}
    {{--loading = false; //set loading flag off once the content is loaded--}}
    {{--if (data.trim().length == 0) {--}}
    {{--//notify user if nothing to load--}}
    {{--$('.loading-info').html("<div class='col-md-12'> No  records found!</div>");--}}
    {{--return;--}}
    {{--}--}}
    {{--$('.loading-info').hide(); //hide loading animation once data is received--}}
    {{--$("#results").append(data); //append data into #results element--}}

    {{--}).fail(function (xhr, ajaxOptions, thrownError) { //any errors?--}}
    {{--alert(thrownError); //alert with HTTP error--}}
    {{--})--}}
    {{--}--}}
    {{--}--}}


    {{--</script>--}}


@endsection

