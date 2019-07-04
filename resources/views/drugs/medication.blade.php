@extends('partials.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pending Medication</h1>
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
                    <div class="dataTable_wrapper">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th># Medication</th>
                                <th></th>

                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
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
                    url: '{!! route('medication.data') !!}',
                    type: "POST",
                    data: {
                        "_token": csrf_token,

                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'date_created', name: 'date_created'},
                    {data: 'patientname', name: 'patientname'},
                    {data: 'medication', name: 'medication'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection

