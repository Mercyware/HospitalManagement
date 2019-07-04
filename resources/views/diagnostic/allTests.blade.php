@extends('partials.master')
@section('page_title')
    All Diagnostics Test : {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    @can('add_patients')
        <a href="{{route('diagnostics.test',$patient->id)}}" class="btn btn-success">New Diagnostic
            Test</a>
    @endcan
@endsection
@section('content')

    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Test Date</th>
                <th>Test</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
            </thead>
        </table>
    </div>





@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->



    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">




    <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $(function () {
            var oTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('diagnostics.test.data') !!}',
                    type: "POST",
                    data: function (d) {
                        d.patient_id = {!! $patient->id !!};
                        d._token = csrf_token;
                    },
                },

                columns: [

                    {data: 'date', name: 'date'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });


            $('#search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });
    </script>
@endsection

