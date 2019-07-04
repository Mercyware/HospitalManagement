@extends('partials.master')
@section('page_title')
    All Staff
@endsection
@section('page_buttons')
    @can('add_staff')
        <a href="/user/create" class="btn btn-primary">New Staff</a>
    @endcan
@endsection
@section('content')


    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="users-table">
            <thead>
            <tr>
                <th width="9%">S/N</th>

                <th width="29%">Name</th>
                <th width="18%">Position</th>
                <th width="13%">Branch</th>
                <th width="17%">Phone</th>
                <th width="14%">Action</th>
            </tr>
            </thead>
            <tbody>


            </tbody>
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
                    url: '{!! route('user.data') !!}',
                    type: "POST",
                    data: {
                        "_token": csrf_token,

                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position'},
                    {data: 'branch', name: 'branch'},
                    {data: 'phone', name: 'phone'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection

    
