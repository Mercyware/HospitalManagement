@extends('partials.master')
@section('page_title')
    Payments : {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    <a href="{{route('getinvoice',$patient->id)}}" class="btn btn-success">Invoices Home</a>
@endsection
@section('content')


    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Payment Date</th>
                <th>Amount Paid</th>
                {{--<th></th>--}}


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
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/api/sum().js"></script>

    <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var oTable = $('#users-table').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('payments.patient.list.data') !!}',
                type: "POST",
                data: function (d) {
                    d.patient_id = {!! $patient->id !!};
                    d._token = csrf_token;
//                    //  d.post = $('input[name=post]').val();
                }

            },
//            ajax: {
//
//                data: function (d) {
//                    //   d.name = $('input[name=name]').val();
//
//                    //  d.post = $('input[name=post]').val();
//                }
//            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'date', name: 'name'},

                {data: 'amount', name: 'amount', searchable: false},
                // {data: 'action', name: 'action', searchable: false},

            ],

        });

        $('#search-form').on('submit', function (e) {
            oTable.draw();

            e.preventDefault();
        });
    </script>






@endsection

