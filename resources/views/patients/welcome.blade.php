@extends('partials.master')

@section('page_title')
    All Registered Patients
@endsection
@section('page_buttons')
    <a href="{{route('patients.create')}}" class="btn btn-success">New Patient</a>
@endsection

@section('content')

    <form id="search-form" role="form">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Branch Name</label>
                <select class="js-example-basic-single form-control" name="branch" id="branch">
                    <option value="">All Branches</option>
                    @if($branches)
                        @foreach($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach
                    @endif
                </select>


            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Patient Name / Patient Number</label>
                <input type="text" class="form-control" name="patient_name" id="patient_name"
                       onkeyup="search();">
            </div>
        </div>
        {{--<button type="submit" class="btn btn-primary">Search</button>--}}
    </form>


    <hr/>
    <div class="row">
        <div id="patients"></div>
    </div>

@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->



    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script type="text/javascript">
        $(window).on('unload', function () {

            $(window).scrollTop(0);
        });

        var csrf_token = $('meta[name="csrf-token"]').attr('content');

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

                $.get('{{route('patients.data')}}', {
                    'page': track_page,
                    "_token": csrf_token,
                    'patient_name': $('#patient_name').val(),
                    'branch_id': $('#branch').val(),
                }, function (data) {
                    loading = false; //set loading flag off once the content is loaded
                    if (data.trim().length == 0) {
                        //notify user if nothing to load
                        $('.loading-info').html("");
                        return;
                    }else{
                        if($('#patient_name').val() != ""){
                            $("#patients").html("");
                        }
                        $('.loading-info').hide(); //hide loading animation once data is received
                        $("#patients").append(data); //append data into #results element
                    }


                }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                })
            }
        }

        function search() {
            console.log('Search');
            $("#patients").html("");
            loading = false;

            load_contents(1);
        }
    </script>
@endsection

