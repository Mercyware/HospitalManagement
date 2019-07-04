@extends('partials.master')
@section('page_title')
    Diagnostic Invoices : {{$patient->name}}
@endsection
@section('page_buttons')

    <a href="{{route('getinvoice',$patient->id)}}" class="btn btn-success">Invoices Home</a>
    <a href="{{route('makepayment',[$patient->id,3])}}" class="btn btn-primary">Make Payment</a>
@endsection
@section('content')



    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Date</th>
                <th>Bill Title</th>

                <th>Amount</th>


            </tr>
            </thead>
        </table>
    </div>


    <meta name="csrf-token" content="{{ csrf_token() }}">



@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->



    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>


    <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $(function () {
            $('#users-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('invoice.patient.diagnostic.data',$patient->id)}}',
                    type: 'POST',
                    data: function (d) {
                        d.patient = {{$patient->id}};
                        d._token = csrf_token;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'name', name: 'name'},
                    {data: 'amount', name: 'amount'},

                ]
            });
        });
    </script>



@endsection

