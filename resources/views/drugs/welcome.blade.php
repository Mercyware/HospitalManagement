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
                            <select name="stocklevel" id="stocklevel" class="form-control">
                                <option value="0">All Drugs</option>
                                <option value="1">Out Of Stock Drugs</option>


                            </select>

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
                        <th>Drug Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>

                    </tr>
                    </thead>
                </table>
            </div>

            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->



    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>


    <script>
        $(function () {
            var oTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/drugs/all',
                    data: function (d) {
                        //   d.name = $('input[name=name]').val();
                        d.stocklevel = $('select[name=stocklevel]').val();
                        //  d.post = $('input[name=post]').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'drugname', name: 'drugname'},
                    {data: 'qty', name: 'qty'},
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

