@extends('partials.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">All Drugs</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @can('add_drugs')
                        <a href="/drugs/create" class="btn btn-success">New Drug</a>
                    @endcan

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <form method="POST" id="search-form" class="form-inline" role="form">
                        <div class="form-group">
                            <label for="email"> </label>
                            <select name="branch" id="branch" class="form-control">
                                @if($branches)
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                @endif

                            </select>

                        </div>
                        <div class="form-group">
                            <label for="email">Between </label>
                            <input type="text" class="form-control DatePicker" name="fromdate" id="fromdate">
                        </div>

                        <div class="form-group">
                            <label for="email">and </label>
                            <input type="text" class="form-control DatePicker" name="todate" id="todate">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>

            <div class="dataTable_wrapper">
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Patient Name</th>
                        <th>Drug Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Date</th>

                    </tr>
                    </thead>
                </table>
            </div>

            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <meta name="csrf-token" content="{{ csrf_token() }}">


@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->
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

    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>


    <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $(function () {
            var oTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('drugsreports')}}',
                    type: 'POST',
                    data: function (d) {
                        //   d.name = $('input[name=name]').val();
                        d.branch = $('select[name=branch]').val();
                        d.fromdate = $("#fromdate").val();
                        d.todate = $("#todate").val();
                        //  d.post = $('input[name=post]').val();
                        d._token=csrf_token;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'patient', name: 'patient'},
                    {data: 'drugname', name: 'drugname'},
                    {data: 'qty', name: 'qty'},
                    {data: 'price', name: 'price'},
                    {data: 'tprice', name: 'tprice'},
                    {data: 'date', name: 'date'},

                ]

            });


            $('#search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });


    </script>
@endsection

