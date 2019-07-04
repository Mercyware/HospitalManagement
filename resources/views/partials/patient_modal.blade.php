@foreach($patients as $patient)

    <?php
    $count++;
    $color = $bgColors[$count % 2];
    $PhotoName = 'patient.jpg';
    if ($patient->photo != "") {
        //  if (file_exists(public_path('/PatientPhoto/' . $patient->photo))) {
        // return redirect()->back()->withInput()->withErrors([' File already exists.']);
        $PhotoName = $patient->photo;
        //  }
    }



    ?>

    <a href="{{route('patients.show',$patient->id)}}">
        <div class="col-md-4 " style="margin-bottom: 10px">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-{{$color}}">
                    <div class="widget-user-image">
                        <img class="img-circle" src="/Images/PatientPhoto/{{$PhotoName}}" alt="{{$patient->name}}">
                    </div>
                    <!-- /.widget-user-image -->
                    <h4 class="widget-user-username">{{ucfirst($patient->name)}}</h4>
                    <h5 class="widget-user-desc">{{$patient->phone}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Age <span class="pull-right badge bg-blue">@if($patient->date_of_birth)<strong>
                    {{
            \Carbon\Carbon::parse($patient->date_of_birth)->toFormattedDateString() }} </strong> ( {{   ucwords(age(new DateTime($patient->date_of_birth))) . ""
                            }})@else
                                        Not Set @endif</span></a></li>

                        <li><a href="#">Status
                                <span class="pull-right badge bg-green">@if($patient->patientAdmitted)
                                        Admitted @else Not admitted @endif</span></a></li>
                        {{--<li><a href="#"> Total Invoice Balance <span class="pull-right badge bg-aqua"> # </span></a></li>--}}

                        <li>

                            <a href="{{route('patients.edit',$patient->id)}}" class="btn btn-warning"><span
                                        class="fa fa-pencil"></span> Edit </a>
                        </li>


                    </ul>


                </div>


            </div>
            <!-- /.widget-user -->


        </div>
    </a>
@endforeach