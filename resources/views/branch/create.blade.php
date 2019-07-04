@extends('partials.master')
@section('page_title')
    New Branch Registration
@endsection
@section('page_buttons')
    @can('add_patients')
        <a href="{{route('blood.history.create')}}" class="btn btn-success">New Blood Request</a>
    @endcan
@endsection
@section('content')



    <form action="/branch/create" method="post">

        @include('partials.errors')
        {{csrf_field()}}
        <div class="col-sm-12">


            <div class="form-group">
                <label>Branch Name</label>
                <input class="form-control" placeholder="Branch Name"
                       name="name">

            </div>
            <div class="form-group">
                <label>Branch Phone Number</label>
                <input class="form-control"
                       placeholder="Patient Phone Number" name="phone">
            </div>

            <div class="form-group">
                <label>Branch Email </label>
                <input class="form-control" placeholder="Branch Email"
                       name="email">
            </div>


            <div class="form-group">
                <label>Branch Address</label>
                <textarea class="form-control" rows="3" name="address"
                          placeholder="Branch Address"></textarea>
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->

        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-success btn-md pull-right" value="Register Branch">

        </div>
    </form>
    <!-- /.row (nested) -->



    <!-- /#wrapper -->




@endsection


    
