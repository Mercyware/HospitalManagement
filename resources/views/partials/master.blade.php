{{--@include('partials.header')--}}

{{--<div id="wrapper">--}}
    {{--@include('partials.nav')--}}

    {{--<div id="page-wrapper">--}}
        {{--@yield('content')--}}
    {{--</div>--}}


{{--</div>--}}
{{--<!-- /#wrapper -->--}}

{{--@include('partials.footer')--}}
{{--{{User Page Layout}}--}}

{{--Header--}}
@include('layout.administrator.header')
@include('layout.administrator.sidebar')

{{--Navigation Bar--}}
{{--@include('layouts.nav')--}}

{{--Page content--}}

<div class="content-wrapper">

    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-left">
           @yield('page_title')

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

                <!-- Chat box -->
                @include('partials.flash')
                @include('partials.errors')


                <div class="box box-danger">

                    <div class="box-header">
                        <div class="col-md-12">
                            @yield('page_buttons')
                        </div>


                    </div>
                    <div class="box-body">
                        <hr/>

                        @yield('content')

                    </div>
                    <!-- /.chat --></div>
                <!-- /.box (chat box) -->


            </section>

        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
{{--Page Footer--}}
@include('layout.administrator.footer')
