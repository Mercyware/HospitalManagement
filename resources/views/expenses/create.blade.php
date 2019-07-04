@extends('partials.master')
@section('page_title')
    Create New Expenses
@endsection
@section('page_buttons')
    @can('add_patients')
        <a href="{{route('diagnostics.create')}}" class="btn btn-success">New diagnostic test</a>
    @endcan
@endsection
@section('content')


    <form action="/expenses/create" method="post" id="Drug_Name">

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
                <label>Tittle / Description</label>
                <input class="form-control" placeholder="Tittle / Description"
                       name="title">

            </div>


            <div class="form-group">
                <label>Amount</label>
                <input class="form-control" placeholder="Amount"
                       name="amount">
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="text" class="form-control DatePicker" name="date" id="fromdate">
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->

        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Create New Expenses">

        </div>
    </form>



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection

@section('jsfiles')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <script>
        //datepicker
        $(function () {
            $.fn.datepicker.defaults.format = "dd/mm/yyyy";
            $('.DatePicker').datepicker({
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });


        });
    </script>

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
                        title: {
                            validators: {
                                notEmpty: {},
                            }
                        },
                        amount: {
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

