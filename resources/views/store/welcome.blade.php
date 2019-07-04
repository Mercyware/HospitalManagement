@extends('partials.master')
@section('page_title')
    Update Stock : {{$item->product}}
@endsection
@section('page_buttons')

@endsection
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url'=>'/store/store/storetake','method' => 'POST']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="roleModalLabel">Item Usage </h4>
                </div>
                <div class="modal-body edit-content">
                    <!-- name Form Input -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <!-- Submit Form Button -->
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inventory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            @include('partials.flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    @can('add_stock')
                        <a href="/store/create" class="btn btn-success">Add New Item to Stock</a>
                    @endcan

                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">

                    <form id="search-form" class="form-inline" role="form">
                        <div class="form-group">
                            <label for="name">Branch Name</label>
                            <select class="js-example-basic-single form-control" name="branch" id="branch">
                                <option value="">Select A Branch</option>
                                @if($branches)
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email"> </label>
                            <select name="stocklevel" id="stocklevel" class="form-control">
                                <option value="0">All Items</option>
                                <option value="1">Out Of Stock Items</option>


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
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th></th>

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
                    url: '/store/all',
                    type: "POST",
                    data: function (d) {
                        //   d.name = $('input[name=name]').val();
                        d.stocklevel = $('select[name=stocklevel]').val();
                        d.branch = $('select[name=branch]').val();
                        //  d.post = $('input[name=post]').val();
                        d._token = csrf_token;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'product', name: 'product'},
                    {data: 'qty', name: 'qty'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]

            });


            $('#search-form').on('submit', function (e) {

                oTable.draw();
                e.preventDefault();
            });
        });


    </script>

    <script>
        $('#itemModal').on('show.bs.modal', function (e) {

            var $modal = $(this),
                item = e.relatedTarget.id;

            $.ajax({
                cache: false,
                type: 'GET',
                url: '/store/take/' + item,
//                data: 'itemID=' + item,
                success: function (data) {
                    $modal.find('.edit-content').html(data);
                }
            });
        })
    </script>
@endsection

