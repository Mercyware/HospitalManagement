@extends('partials.master')
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">New Drug Registration</h1>
        </div>

        <div id="server_message"></div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-6 col-md-offset-3">
            @include('partials.flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    Please Supply Valid Information
                </div>
                <div class="panel-body">
                    <form action="/drugs/update/{{$drug->id}}" method="post">

                        @include('partials.errors')
                        {{csrf_field()}}
                        {{ method_field('PATCH') }}
                        <div class="col-sm-12">


                            <div class="form-group">
                                <label>Drug Name</label>
                                <input class="form-control" placeholder="Drug Name"
                                       name="drugname" value="{{$drug->drugname}}">

                            </div>


                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" placeholder=" Drug Price"
                                       name="price" value="{{$drug->price}}">
                            </div>

                            <div class="form-group">
                                <label>Current Quantity</label>
                                <input class="form-control" placeholder="Drug Quantity"
                                       name="cqty" value="{{$drug->qty}}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Operation </label>
                                <select class="form-control" name="operation">
                                    <option value="0">Change Product Information</option>
                                    <option value="1">Add to Current Stock</option>
                                    <option value="2">Remove from Current Stock</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>New Quantity</label>
                                <input class="form-control" placeholder="Drug Quantity"
                                       name="qty">

                            </div>

                            <div class="form-group">
                                <label>Reason / Description <span style="font-size: 10px; color: red"> * effective only when quantity is affected</span>
                                </label>
                                <textarea class="form-control" name="reason"
                                          placeholder="Description & Reasons for Updating"></textarea>
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <div class="col-sm-12 ">

                            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Update Drug">

                        </div>
                    </form>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection


    
