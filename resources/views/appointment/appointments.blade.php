@extends('partials.master')
@section('page_title')
    All Appointments
@endsection
@section('page_buttons')
    <a href="{{route('patients.index')}}" class="btn btn-primary"><span class="fa fa-user"></span> All Patient</a>
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
            <label for="email">Appointment Date </label>
            <input type="text" class="form-control DatePicker" name="fromdate" id="appointdate">
        </div>


        <button type="submit" class="btn btn-success">Search</button>
    </form>
    <hr/>

    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Patient Name</th>
                <th>Appointment Date</th>
                <th>Appointment with</th>
                <th>Scheduled On</th>
                <th>Action</th>

            </tr>
            </thead>
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
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $(function () {
            var oTable = $('#users-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: '/appointments',
                    type: 'POST',
                    data: function (d) {
                        d.branch = $("#branch").val();
                        d.appointdate = $("#appointdate").val();
                        d._token = csrf_token;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'patient', name: 'patient'},
                    {data: 'appointment_date', name: 'appointment_date'},
                    {data: 'user', name: 'user'},
                    {data: 'scheduled', name: 'scheduled'},
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

