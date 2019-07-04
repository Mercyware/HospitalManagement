@extends('partials.master')
@section('page_title')
    New Product Registration
@endsection
@section('page_buttons')


@endsection
@section('content')


    <form action="/store/create" method="post" id="Drug_Name">

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
                <label>Product Name</label>
                <input class="form-control" placeholder="Product Name"
                       name="productname">

            </div>


            <div class="form-group">
                <label>Quantity</label>
                <input class="form-control" placeholder="Product Quantity"
                       name="qty">
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->

        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Add New Product">

        </div>
    </form>



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
                        productname: {
                            validators: {
                                notEmpty: {},
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
    
