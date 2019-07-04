@extends('partials.master')
@section('page_title')
    @if($test)
        {{$test->name}}
    @else
        All Laboratory Tests

    @endif
@endsection
@section('page_buttons')

    @can('add_tests')
        <a href="{{route('test.create', $parent_id)}}" class="btn btn-primary">Add New Test
            @if($test)
                for {{$test->name}}
            @endif
        </a>
    @endcan
@endsection
@section('content')



    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="users-table">
            <thead>
            <tr>
                <th width="9%">S/N</th>

                <th width="29%">Test Name</th>
                <th width="18%">Normal Range</th>
                <th width="18%">Sub Tests</th>
                <th width="13%">Price</th>
                <th width="14%">Action</th>
            </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
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
            $('#users-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('tests.all.data', $parent_id) !!}',

                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'normal', name: 'normal'},
                    {data: 'sub_test', name: 'sub_test'},
                    {data: 'price', name: 'price'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>



@endsection

    
