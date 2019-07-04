<div class="modal fade " id="Payment_Patient_Modal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Patient Diagnosis Bill Payment</h4>
            </div>
            <div class="ct">
                <h4 style="margin-top: 10px;padding-top: 0px;margin-bottom: 0px;padding-bottom: 0px; margin-left: 20px;">
                    Patient Name : {{$patient->name}}</h4>
                <form method="post" action="/billing/{{$patient->id}}/store" role="form"
                      enctype="multipart/form-data"
                      id="Billing_Patient_Form">
                    {{csrf_field()}}
                    <div class="modal-body">

                        <div class="panel-body">

                            <div class="row">


                                <div class="col-xs-12">


                                    <input type="hidden" name="PatientID" id="id" value="1"/>


                                    <div class="col-xs-12" style="margin-left:0px; padding-left:0px;">
                                        <div class="col-xs-6" style="margin-left:0px;  padding-left:0px;">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input class="form-control DatePicker" type="text"
                                                       placeholder="Enter Date" name="BillDate"
                                                       value="{{ date('d/m/Y') }}"/>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xs-12"
                                         style="margin-left:0px;  padding-left:0px; margin-top: 10px;">

                                        <label>Amount Paid</label>

                                        <div class="form-group">



                                            <div class="col-xs-4" style="margin-left:0px;  padding-left:0px;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control totalLinePrice"
                                                           name="Amount[0].Amounts"
                                                           placeholder="Amount" onkeyup="calculateTotal()"/>
                                                </div>

                                            </div>

                                            <div class="col-xs-2">
                                                <button type="button" class="btn btn-default FremoveButton"><i
                                                            class="fa fa-minus"></i>
                                                </button>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group hide" id="Fees">
                                        <div class="col-xs-12"
                                             style="margin-left:0px;  padding-left:0px; margin-top: 10px;">

                                            <div class="col-xs-6" style="margin-left:0px;  padding-left:0px;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control FeeName" name="FeeNames"
                                                           placeholder="Fee Name"/>
                                                </div>

                                            </div>
                                            <div class="col-xs-4" style="margin-left:0px;  padding-left:0px;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control totalLinePrice"
                                                           name="Amounts"
                                                           placeholder="Amount" onkeyup="calculateTotal()"/>

                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <button type="button" class="btn btn-default FremoveButton"><i
                                                            class="fa fa-minus"></i>
                                                </button>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-xs-4"
                                             style="margin-left:0px; padding-left:0px; margin-top:10px;">
                                            <button type="button" class="btn btn-default FaddButton"><i
                                                        class="fa fa-plus"></i> Add
                                                Additional Fee
                                            </button>
                                        </div>
                                    </div>


                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-left">
                            <h5 class="text-info" id="TotalBill"><strong></strong></h5>
                        </div>
                        <input type="submit" class="btn btn-primary " value="Save Patient Bill">
                        &nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>