@extends('partials.master')
@section('page_title')
    {{ucwords($patient->name)}}
@endsection
@section('page_buttons')
    @include('buttons.patientshome')

    <a href="{{route('dental.show', [str_singular($patient->id) => $patient->id])}}"
       class="btn btn-primary"><span class="fa fa-smile-o"></span>
        Dental Diagnosis </a>

    <a href="/patient/dental/history/{{$patient->id}}" class="btn btn-primary"><span
                class="fa fa-history"></span> Patient Dental History </a>
@endsection
@section('content')




                @include('partials.tooth')




    <!-- /#page-wrapper -->


    <!-- /#wrapper -->


    @include('modals.billing')

@endsection


@section('jsfiles')
    <script type="text/javascript" src="/js/billing.js"></script>
    <script>
        function gett(Position, Tooth, Part) {

            //  alert(Part);

            $.get('/patient/tooth/ajaxcall/{{$patient->id}}/' + Position + '/' + Tooth + '/' + Part, {}, function (data) {
                loading = false; //set loading flag off once the content is loaded
                if (data.trim().length == 0) {
                    //notify user if nothing to load
                    $('.loading-info').html("");
                    return;
                }
                ///   $('.loading-info').hide(); //hide loading animation once data is received

                //   alert(data);
                //     $("#users-table").append(data); //append data into #results element
                $("#result" + Position + "" + Tooth).html(data); //append data into #results element

            }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
            })
        }
    </script>

    <script>
        function gettooth(Position, Tooth) {
            //  alert(Position);
            $.get('/patient/tooth/ajaxcall/{{$patient->id}}/' + Position + '/' + Tooth, {}, function (data) {
                loading = false; //set loading flag off once the content is loaded

                ///   $('.loading-info').hide(); //hide loading animation once data is received

                //   alert(data);
                //     $("#users-table").append(data); //append data into #results element

                // var Result =JSON.stringify(data);
                var Result = $.parseJSON(JSON.stringify(data));
                $("#imagePlace" + Position + "" + Tooth).html(Result.img); //append data into #results element

                if (Result.status > 0) {
                    $("#result" + Position + "" + Tooth).hide(); //append data into #results element

                } else if (Result.status == 0) {
                    //  alert('Return');
                    $("#result" + Position + "" + Tooth).show(); //append data into #results element

                    getpatienttooth(Position, Tooth, "T");
                    getpatienttooth(Position, Tooth, "L");
                    getpatienttooth(Position, Tooth, "B");
                    getpatienttooth(Position, Tooth, "R");
                    getpatienttooth(Position, Tooth, "C");
                }

            }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
            })

        }
    </script>

    <script>
        function getpatienttooth(Position, Tooth, Part) {

            // alert(Part);

            $.get('/patient/gettooth/ajaxcall/{{$patient->id}}/' + Position + '/' + Tooth + '/' + Part, {}, function (data) {
                loading = false; //set loading flag off once the content is loaded
                if (data.trim().length == 0) {
                    //notify user if nothing to load
                    $('.loading-info').html("");
                    return;
                }
                ///   $('.loading-info').hide(); //hide loading animation once data is received

                //   alert(data);
                //     $("#users-table").append(data); //append data into #results element
                $("#result" + Position + "" + Tooth).html(data); //append data into #results element

            }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
            })
        }
    </script>
@endsection