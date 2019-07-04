


{{-- Patient Dental Diagnosis --}}
@can('view_dental')
    <a href="{{route('patients.edit', [str_singular($patient->id) => $patient->id])}}" class="btn btn-success"><span
                class="fa fa-pencil"></span>
       </a>
@endcan

    @can('view_dental')
    <a href="{{route('dental.show', [str_singular($patient->id) => $patient->id])}}" class="btn btn-primary"><span
                class="fa fa-smile-o"></span>
        Patient Diagnosis </a>
@endcan

{{-- Patient Eye Diagnosis --}}
{{--@can('view_eye')--}}
{{--<a href="{{route('eye.show', [str_singular($patient->id) => $patient->id])}}" class="btn btn-primary"><span class="fa fa-eye"></span> Eye Diagnosis</a>--}}

{{--@endcan--}}


{{-- Patient Appointment Booking --}}
@can('view_appointment')
    <a href="/appointment/{{$patient->id}}" class="btn btn-primary"><span class="fa fa-clock-o"></span> Appointment</a>

@endcan

{{-- Patient Drugs Administration --}}
@can('administer_drug')

    {{--<a href="/drugs/administer/{{$patient->id}}" class="btn btn-primary"><span--}}
    {{--class="fa fa-eraser"></span> Administer Drug </a>--}}
@endcan

@can('bill_patient')
    <a href="{{route('patient.diagnosis.billing',$patient->id)}}" class="btn btn-primary"><span
                class="fa fa-user"></span>
        Patient Billing </a>

    {{--<button--}}
    {{--type="button"--}}
    {{--class="btn btn-primary btn-md"--}}
    {{--data-toggle="modal"--}}
    {{--data-target="#Bill_Patient_Modal">--}}
    {{--<span class="fa fa-money"></span> Patient Billing--}}
    {{--</button>--}}
@endcan

{{-- Patient Invoices --}}
@can('view_invoice')

    <a href="/invoice/patient/{{$patient->id}}" class="btn btn-primary"><span class="fa fa-money"></span>
        View Invoice </a>

@endcan

{{-- Patient Laboratory Investigations --}}
@can('run_investigation')
    <a href="{{route('laboratory.test.list',$patient->id)}}" class="btn btn-primary"><span
                class="fa fa-ambulance"></span>
        Laboratory Tests </a>
@endcan

@can('run_investigation')
    <a href="{{route('diagnostics.test.list',$patient->id)}}" class="btn btn-primary"><span
                class="fa fa-ambulance"></span>
        Diagnostic Tests </a>
@endcan





