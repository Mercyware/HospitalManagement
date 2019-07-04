@extends('partials.master')
@section('page_title')
    Update Test Information
@endsection
@section('page_buttons')


@endsection
@section('content')


                    <form action="{{route('test.update.patch',$test->id)}}" method="post">

                        @include('partials.errors')
                        {{csrf_field()}}
                        {{ method_field('PATCH') }}

                        <input type="hidden" name="parent_id" value="{{$test->parent_id}}">
                        <input type="hidden" name="id" value="{{$test->id}}">

                        <div class="col-sm-12">


                            <div class="form-group">
                                <label>Test Name</label>
                                <input class="form-control" placeholder="Test Name" value="{{$test->name}}"
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
                                               placeholder="Normal Range" name="normal_range"
                                               value="{{$test->normal_range}}" autocomplete="off">
                                    </div>


                                    <div class="col-md-4">

                                        <input class="form-control"
                                               placeholder="Range Unit" name="unit" value="{{$test->unit}}"
                                               autocomplete="off">
                                    </div>
                                </div>


                            </div>


                            <div class="form-group">
                                <p>&nbsp; </p>
                                <label>Price </label>

                                <input class="form-control" placeholder="Price" value="{{$test->price}}"
                                       name="price" autocomplete="off">
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <div class="col-sm-12 ">

                            <input type="submit" class="btn btn-success btn-lg pull-right" value="Update Test">

                        </div>
                    </form>
                    <!-- /.row (nested) -->



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection


    
