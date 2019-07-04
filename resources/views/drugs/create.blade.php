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
                    <form action="/drugs/create" method="post" id="Drug_Name">

                        @include('partials.errors')
                        {{csrf_field()}}
                        <div class="col-sm-12">


                            <div class="form-group">
                                <label>Branch Name </label>
                                <select class="js-example-basic-single form-control" name="branch">
                                    <option value="">Select A Branch</option>
                                    @if($branches)
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Drug Name</label>
                                <input class="form-control" placeholder="Drug Name"
                                       name="drugname">

                            </div>


                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" placeholder=" Drug Price"
                                       name="price">
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" placeholder="Drug Quantity"
                                       name="qty">
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <div class="col-sm-12 ">

                            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Add New Drug">

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

@section('jsfiles')


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.min.js"></script>
    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#Drug_Name')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
//                    valid: 'glyphicon glyphicon-ok',
//                    invalid: 'glyphicon glyphicon-remove',
//                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        drugname: {
                            validators: {
                                notEmpty: {},
                            }
                        },
                        price: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        },
                        qty: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        },
                        branch: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        }


                    }
                })
        });
    </script>
@endsection
    
