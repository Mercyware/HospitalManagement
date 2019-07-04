@extends('partials.master')
@section('page_title')
    All Patients
@endsection
@section('page_buttons')
    @can('add_patients')
        <a href="{{route('blood.history.create')}}" class="btn btn-success">New Blood Request</a>
    @endcan
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#New_Patient_Modal"
                            data-whatever="New Patient">New Patient
                    </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#New_Family_Modal"
                            data-whatever="New Patient">New Family
                    </button>

                    <button type="button" class="btn btn-success">Print</button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th width="9%">S/N</th>

                                <th width="29%">Name</th>
                                <th width="18%">Phone #</th>
                                <th width="13%">Gender</th>
                                <th width="17%">Bld Grp/Gtype</th>
                                <th width="14%">Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




@endsection
@section('jsfiles')
    <!-- DataTables JavaScript -->
    <script src="/css/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/css/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
@endsection

    
