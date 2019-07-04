@extends('partials.master')
@section('page_title')
    Payment : {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    <a href="{{route('getinvoice',$patient->id)}}" class="btn btn-success">Invoices Home</a>
@endsection
@section('content')




    <div class="col-md-6 col-md-offset-3">
        <form action="{{route('makepayment.post')}}" method="post">

            @include('partials.errors')
            {{csrf_field()}}

            <input type="hidden" name="patient_id" value="{{$patient->id}}">
            <input type="hidden" name="invoice" value="{{$invoice}}">
            <input type="hidden" name="outstanding" value="{{$outstanding}}">

            <div class="col-sm-12">

                <div class="callout callout-info">
                    <h4>Patient Outstanding : {{number_format($outstanding)}}</h4>
                </div>

                @if($outstanding <= 0)
                    <div class="callout callout-danger">
                        <p><em>No Payment to make. Patient balance is {{number_format($outstanding)}}</em></p>
                    </div>
                @endif
                <div class="form-group">
                    <label>Date</label>
                    <input class="form-control DatePicker" placeholder="Payment Date"
                           name="date" autocomplete="off" required value="{{date("d/m/Y")}}">

                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input class="form-control"
                           placeholder="Amount Paid" name="amount" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="name">Branch Name</label>
                    <select class="js-example-basic-single form-control" name="branch_id" id="branch">

                        @if($branches)
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>Payment Method </label>
                    <select class="form-control" name="pay_type" required>
                        <option value="">Select an Option</option>
                        <option value="1">Cash</option>
                        <option value="2">Cheque</option>
                        <option value="3">POS</option>
                        <option value="4">Transfer</option>
                    </select>
                </div>


            </div>
            <!-- /.col-lg-6 (nested) -->

            <div class="col-sm-12 ">
                @if($outstanding > 0)
                    <input type="submit" class="btn btn-success btn-md pull-right" value="Make Payment">
                @endif
            </div>
        </form>
    </div>
    <!-- /.row (nested) -->



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection

@section('jsfiles')

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
@endsection
    
