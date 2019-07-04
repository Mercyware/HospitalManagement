@extends('partials.master')
@section('page_title')
    All Patients Invoices
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    <a href="{{route('getinvoice',$patient->id)}}" class="btn btn-success">Invoices Home</a>
@endsection
@section('content')

    <!-- /.row -->

    <form method="POST" id="search-form" class="form-inline" role="form">
        <div class="form-group">
            <label for="email"> </label>
            <select name="usertype" id="usertype" class="form-control">
                <option value="0">All Patients</option>
                <option value="1">Only Debtors</option>
                <option value="2">Full Paid</option>

            </select>

        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <hr/>

    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Patient #</th>
                <th>Name</th>
                <th>Invoice Balance</th>
                <th></th>


            </tr>
            </thead>

            <tfoot>
            <tr>
                <th colspan='3'>
                    <span style="float:right;" id='totalSalary'>00 </span>
                </th>
                <td></td>
            </tr>
            </tfoot>
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
                url: '/invoices',
                type: "POST",
                data: function (d) {
                    d.usertype = $('select[name=usertype]').val();
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
                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount', searchable: false},
                {data: 'action', name: 'action', searchable: false},

            ],
            "sPaginationType": "full_numbers",
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // total_salary over all pages
                total_salary = api.column(2).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(2, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                //   $('#totalSalary').html(total_page_salary.toFixed(2)+"/"+total_salary.toFixed(2));
                $('#totalSalary').html(total_salary.toFixed(2));
            },
        });

        $('#search-form').on('submit', function (e) {
            oTable.draw();

            e.preventDefault();
        });
    </script>






@endsection

