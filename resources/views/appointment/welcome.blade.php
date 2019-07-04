@extends('partials.master')
@section('page_title')
    Appointments : {{$patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    {{--@include('buttons.diagmenu')--}}
    <a href="{{route('appointmentcreate',$patient->id)}}" class="btn btn-primary"> New Appointment</a>
@endsection

@section('content')



    <div class="dataTable_wrapper">
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>S/N</th>
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
                    url: '/appointment',
                    type: 'POST',
                    data: function (d) {
                        d.patient = {{$patient->id}};
                        d._token = csrf_token;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'appointment_date', name: 'appointment_date'},
                    {data: 'user', name: 'user'},
                    {data: 'scheduled', name: 'scheduled'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>



@endsection

