@extends('partials.master')
@section('page_title')
    Blood Bank History
@endsection
@section('page_buttons')
    @can('add_patients')
        <a href="{{route('blood.history.create')}}" class="btn btn-success">New Blood Request</a>
    @endcan
@endsection
@section('content')

    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Patient Name</th>
                <th>Phone</th>
                <th>Blood Group</th>
                <th>Price</th>
                <th>Date</th>


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
                    url: '{!! route('blood.history.data') !!}',
                    type: "POST",
                    data: function (d) {
                        d.branch = $('select[name=branch]').val();
                        d._token = csrf_token;
                    },
                },

                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'blood_group', name: 'blood_group'},
                    {data: 'price', name: 'price'},
                    {data: 'date_donated', name: 'date_donated'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });


            $('#search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });
    </script>
@endsection

