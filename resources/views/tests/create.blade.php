@extends('partials.master')
@section('page_title')
    New Test
    @if($test)
        for {{$test->name}}

    @endif
@endsection
@section('page_buttons')


@endsection
@section('content')


    <form action="/tests/create" method="post">

        @include('partials.errors')
        {{csrf_field()}}

        <input type="hidden" name="parent_id" value="{{$parent_id}}">
        <div class="col-sm-12">


            <div class="form-group">
                <label>Test Name</label>
                <input class="form-control" placeholder="Test Name"
                       name="name" autocomplete="off">

            </div>
            <div class="col-md-8">
                <label>Normal Range</label>

            </div>

            <div class="col-md-4">
                <label>Unit</label>

            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">

                        <input class="form-control"
                               placeholder="Normal Range" name="normal_range" autocomplete="off">
                    </div>


                    <div class="col-md-4">

                        <input class="form-control"
                               placeholder="Range Unit" name="unit" autocomplete="off">
                    </div>
                </div>


            </div>


            <div class="form-group">
                <p>&nbsp; </p>
                <label>Price </label>

                <input class="form-control" placeholder="Price"
                       name="price" autocomplete="off">
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->

        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-success btn-lg pull-right" value="Add Test">

        </div>
    </form>
    <!-- /.row (nested) -->

    <!-- /.row -->


    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection


    
