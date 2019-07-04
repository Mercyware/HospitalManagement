@extends('partials.master')
@section('page_title')
    Expenses List
@endsection
@section('page_buttons')
    <a href="/expenses/create" class="btn btn-primary">Create Expenses</a>
@endsection
@section('content')



    <form method="POST" id="search-form" class="form-inline" role="form">

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
            <label for="email">Between </label>
            <input type="text" class="form-control DatePicker" name="fromdate" id="fromdate">
        </div>

        <div class="form-group">
            <label for="email">and </label>
            <input type="text" class="form-control DatePicker" name="todate" id="todate">
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <hr/>

    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Date</th>
                <th>Title/Desc</th>
                <th>Amount</th>
                <th>Staff Name</th>

            </tr>
            </thead>

            <tfoot>
            <tr>
                <th colspan='4'>
                    <span style="float:right;" id='totalSalary'>00 </span>
                </th>
                <td></td>
            </tr>
            </tfoot>
        </table>
    </div>




@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/api/sum().js"></script>


    <script>
        //datepicker
        $(function () {
            $.fn.datepicker.defaults.format = "dd/mm/yyyy";
            $('.DatePicker').datepicker({
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });


        });
    </script>


    <script>
        $(function () {
            var oTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/expenses',
                    data: function (d) {
                        //  v = $("#branch").val();
                        //  dd($('input[name=branch]').val());
                        d.branch = $("#branch").val();
                        d.fromdate = $("#fromdate").val();
                        d.todate = $("#todate").val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'date_received', name: 'date_received'},
                    {data: 'tittle', name: 'tittle'},
                    {data: 'amount', name: 'amount'},
                    {data: 'user_id', name: 'user_id'},

                ],
                "sPaginationType": "full_numbers",
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // total_salary over all pages
                    total_salary = api.column(3).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // total_page_salary over this page
                    total_page_salary = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
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
        });
    </script>
@endsection

