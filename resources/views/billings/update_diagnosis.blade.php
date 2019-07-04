@extends('partials.master')
@section('page_title')
    Update  Patient Billing : {{$patient->name}}
@endsection
@section('page_buttons')

    @include('buttons.diagmenu')
@endsection
@section('content')

    <!-- /.row -->
    <form method="POST" id="search-form" class="form-inline" role="form"
          action="{{route('patient.diagnosis.billing.update')}}">
        <input type="hidden" class="form-control " name="patient_id"
               value="{{$patient->id}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @include('buttons.patientshome')
                    </div>
                    <!-- /.panel-heading -->

                    <div class="panel-body">

                        <div class="callout-info callout"><strong> To add discount, use + for positive and - for
                                negatives.
                                For example +1000 will add 1000 Naira and - 1000 will deduct 1000.<br/>
                                Also, not that if there is no discount, leave the discount box at 0</strong></div>
                        <div class="form-group">
                            <label for="email">Billing Date </label>
                            <input type="text" class="form-control DatePicker" name="date" id="todate" required
                                   value="{{$prices[0]->date}}" readonly
                                   autocomplete="off">
                        </div>


                    </div>
                    <!-- /.panel-body -->
                </div>

                <div class="dataTable_wrapper">
                    <table class="table table-bordered" id="users-table">
                        <thead>
                        <tr>

                            <th>Charges Name</th>
                            <th>Price</th>
                            <th>Discount</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prices as $price)
                            <tr>

                                <td>
                                    <input type="hidden" class="form-control " name="price_id[{{$price->id}}]"
                                           value="{{$price->id}}"/>
                                    <input type="hidden" class="form-control " name="price_name[{{$price->id}}]"
                                           value="{{$price->name}}"/>
                                    {{ucwords($price->name)}}
                                </td>
                                <td>
                                    <input type="hidden" class="form-control " name="amount[{{$price->id}}]"
                                           value="{{$price->price}}">
                                    {{$price->price}}</td>
                                <td>

                                    <input type="text" class="form-control " name="qty[{{$price->id}}]"
                                           autocomplete="off"
                                           value=" {{$price->qty}} "
                                           required>
                                </td>
                                <td>

                                    <input type="text" class="form-control " name="discount[{{$price->id}}]"
                                           autocomplete="off"
                                           value="@if($price->is_subtract_discount) {{-$price->discount}} @else {{$price->discount}} @endif"
                                           required>
                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <input class="btn btn-success" type="submit" value="Update Payment"/>
    </form>


@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/api/sum().js"></script>


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

