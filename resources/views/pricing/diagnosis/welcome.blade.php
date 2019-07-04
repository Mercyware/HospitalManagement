@extends('partials.master')
@section('page_title')
    Medical Care Pricing
@endsection
@section('page_buttons')

    <a href="{{route('pricing.diagnosis.price.create')}}" class="btn btn-success">New Medical Care
        Price</a>

@endsection
@section('content')




    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Medical Care Name</th>
                <th>Price</th>
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
                    url: '{!! route('pricing.diagnosis.price.data') !!}',
                    type: "POST",
                    data: function (d) {
                        d.branch = $('select[name=branch]').val();
                        d._token = csrf_token;
                    },
                },

                columns: [

                    {data: 'name', name: 'name'},

                    {data: 'price', name: 'price'},
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

