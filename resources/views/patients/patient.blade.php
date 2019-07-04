@extends('partials.master')
@section('page_title')
    {{ucwords($patient->name)}}
@endsection
@section('page_buttons')
    @include('buttons.diagmenu')
@endsection
@section('content')


    <div class="col-md-12">
        <div class="col-md-3">
            <a href="#" class="thumbnail">
                <?php
                $PhotoName = 'patient.jpg';
                if ($patient->photo != "") {
                    //  if (file_exists(public_path('/PatientPhoto/' . $patient->photo))) {
                    // return redirect()->back()->withInput()->withErrors([' File already exists.']);
                    $PhotoName = $patient->photo;
                    //  }
                }



                ?>

                <img src="/Images/PatientPhoto/{{$PhotoName}}" alt="{{$patient->name}}" data-src="holder.js/100%x180"
                     class="Profile_Picture" id="previewing">
            </a>
        </div>
        <div class="col-md-9">
            <h4 class="text-primary">{{$patient->name}}</h4>
            <p class="text-black"> {{$patient->phone}}</p>
            <p class="text-black"> {{$patient->email}}</p>
            <p class="text-black">@if($patient->date_of_birth)<strong>
                    {{
            \Carbon\Carbon::parse($patient->date_of_birth)->toFormattedDateString() }} </strong> ( {{   ucwords(age(new DateTime($patient->date_of_birth))) . ""
                            }})@else
                    Date of Birth  Not Set @endif</p>
            <p class="text-black">
                <?php
                if ($patient->sex == 2) {

                    echo $Sex = 'Female';
                } else {
                    echo $Sex = 'Male';
                }
                ?>..
            </p>
            <p class="text-black">{{$patient->address}}</p>

        </div>
    </div>

    <div class="col-md-12">
        <h4 class="text-black">Patient Information Summary</h4>

        <div class="callout-info callout">
            @if($patient->date_of_birth)

                {{$patient->name}} is a {{   ucwords(age(new DateTime($patient->date_of_birth),null,1))   }} years
                old {{$Sex}}.
            @else
                {{$patient->name}} is a {{$Sex}} with age unknown
            @endif

            <br/>
            {{$patient->name}} has blood group <strong>{{$patient->bloodgroup}}</strong> and
            genotype <strong> {{$patient->genotype}}</strong>
        </div>
    </div>
    <!-- /.row (nested) -->



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection


