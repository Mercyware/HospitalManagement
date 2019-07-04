@extends('partials.master')
@section('page_title')
    Company Contact
@endsection
@section('page_buttons')


@endsection
@section('content')


    <form action="{{route('contact.createStore')}}" method="post" enctype="multipart/form-data">

        @include('partials.errors')
        {{csrf_field()}}

        <input type="hidden" name="company_id" value="@if($company){{$company->id}}@endif">
        <div class="col-sm-12">


            <div class="form-group">
                <label>Company Name</label>
                <input class="form-control" placeholder=" Name"
                       name="name" autocomplete="off" value="@if($company){{$company->name}}@endif">

            </div>
            <div class="form-group">
                <label>Company Phone Number</label>
                <input class="form-control"
                       placeholder=" Phone Number" name="phone" autocomplete="off"
                       value="@if($company){{$company->phone}}@endif">
            </div>

            <div class="form-group">
                <label>Company Email </label>
                <input class="form-control" placeholder=" Email"
                       name="email" autocomplete="off"
                       value="@if($company){{$company->email}}@endif">
            </div>


            <div class="form-group">
                <label>Company Address</label>
                <textarea class="form-control" rows="3" name="address"
                          placeholder=" Address" autocomplete="off"
                >@if($company){{$company->address}}@endif</textarea>
            </div>

            <div class="form-group">
                <label>Company Logo</label>
                <input class="form-control" name="file" type="file"
                       placeholder=" Upload Image"/>
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->

        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-success btn-md pull-right"
                   value="@if($company) Update @else Add @endif Company">

        </div>
    </form>



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection


    
