@extends('partials.master')
@section('page_title')
    Patient Dental Visitation History : {{ucwords($patient->name)}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')
    @include('buttons.diagmenu')
@endsection
@section('content')


    <!-- /.row -->


    <div class="col-md-12">
        <div class="col-md-3">
            <a href="#" class="thumbnail">
                <?php
                $PhotoName = 'patient.jpg';
                if ($patient->photo != "") {
                    if (file_exists(public_path('/Images/PatientPhoto/' . $patient->photo))) {
                        // return redirect()->back()->withInput()->withErrors([' File already exists.']);
                        $PhotoName = $patient->photo;
                    }
                }



                ?>

                <img src="/Images/PatientPhoto/{{$PhotoName}}" alt="..." data-src="holder.js/100%x180"
                     class="Profile_Picture" id="previewing">
            </a>
        </div>
        <div class="col-md-9">
            <h4 class="text-primary">{{$patient->name}}</h4>
            <p class="text-black"><strong>{{
                            \Carbon\Carbon::parse($patient->dob)->toFormattedDateString() }} </strong> ( {{   ucwords(age(new DateTime($patient->dob))) . ""
                            }})</p>
            <p class="text-black">
                <?php
                if ($patient->sex == 0) {

                    echo $Sex = 'Female';
                } else {
                    echo $Sex = 'Male';
                }
                ?>
            </p>
            <p class="text-black">{{$patient->address}}</p>

        </div>
    </div>

    <div class="col-md-12">
        <h5 class="text-black text-center"><strong>{{$patient->name}} Visitation History</strong></h5>
        <hr/>
        <div id="results"></div>
        <div class="loading-info"><img src="/Images/ajax-loader.gif"/></div>
    </div>
    <!-- /.row (nested) -->

    <!-- /.row -->


    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection
@section('jsfiles')
    <script type="text/javascript">
        $(window).on('unload', function () {

            $(window).scrollTop(0);
        });

        var track_page = 1; //track user scroll as page number, right now page number is 1
        var loading = false; //prevents multiple loads
        //$("#results").empty();
        load_contents(track_page);

        $(window).scroll(function () { //detect page scroll
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page
                //      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {

                track_page++; //page number increment
                load_contents(track_page); //load content
            }
        });

        //Ajax load function
        function load_contents(track_page) {

            if (loading == false) {
                loading = true;  //set loading flag on
                $('.loading-info').show(); //show loading animation

                $.get('/patient/dental/history/ajaxcall/{{$patient->id}}/' + track_page, {
                    'page': track_page,
                }, function (data) {
                    loading = false; //set loading flag off once the content is loaded
                    if (data.trim().length == 0) {
                        //notify user if nothing to load
                        $('.loading-info').html("<div class='col-md-12'> No  More records found!</div>");
                        return;
                    }
                    $('.loading-info').hide(); //hide loading animation once data is received
                    $("#results").append(data); //append data into #results element

                }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                })
            }
        }


    </script>


@endsection

