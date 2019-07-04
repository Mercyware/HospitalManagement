@extends('partials.master')
@section('page_title')
    Appointment : {{$appointment->patient->name}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    @include('buttons.diagmenu')
@endsection
@section('content')



    <form action="/appointment/update/{{$appointment->id}}" method="post" name="" id="Appointment_Form">

        @include('partials.errors')
        {{csrf_field()}}
        <div class="col-sm-12">


            <div class="form-group">
                <label>Appointment Date/Time
                    : {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $appointment->appointment_date)->format('d/m/Y H:i:s')}}</label>


            </div>

            <div class="form-group">
                <label>Doctor's Name : {{$appointment->doctor->name}}</label>

            </div>

            <div class="form-group">
                <label>Branch Name : {{$appointment->branch->name}}</label>

            </div>

            <div class="form-group">

                <p><em>This appointment was scheduled by {{$appointment->doctor->name}}
                        on {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $appointment->created_at)->format('d/m/Y ')}} </em>
                </p>
            </div>

            @if($appointment->status ==0)
                <div class="alert alert-info">
                    <strong>NOTE:</strong> Appointment is still PENDING
                </div>

                <div class="col-md-12 pull-right">
                    <a href="/appointment/confirm/{{$appointment->id}}"
                       class="btn btn-primary">Confirm</a>
                    <a href="/appointment/cancel/{{$appointment->id}}"
                       class="btn btn-primary">Cancel</a>
                    <a href="/appointment/delete/{{$appointment->id}}" class="btn btn-danger">Delete</a>
                </div>
            @endif
            @if($appointment->status ==1)
                <div class="alert alert-success">
                    <strong>NOTE:</strong> Appointment has been CONFIRMED
                </div>
            @endif

            @if($appointment->status ==2)
                <div class="alert alert-warning">
                    <strong>NOTE:</strong> Appointment has been CANCELLED
                </div>


            @endif
        </div>


        <!-- /.col-lg-6 (nested) -->

    </form>
    <!-- /.row (nested) -->



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection

    
