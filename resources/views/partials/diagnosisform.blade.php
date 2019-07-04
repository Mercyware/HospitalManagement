@include('partials.errors')
{{csrf_field()}}
<div class="col-md-12">
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label" for="BirthDate">Visitation Date</label>

            <div class="input-group input-append date DatePicker">
                <input type="text" class="form-control" name="diagnosis_date"
                       value="{{ date('d/m/Y') }}"/>
                <span class="input-group-addon add-on"><span
                            class="glyphicon glyphicon-calendar"></span></span>

            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" for="BirthDate">Patient Pressure</label>

            <div class="input-group input-append date">
                <input type="text" class="form-control" name="pressure"
                       placeholder="B.P"/>
                <span class="input-group-addon add-on">mm/Hg</span>

            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" for="BirthDate">Temperature</label>

            <div class="input-group input-append date">
                <input type="text" class="form-control" name="temperature"
                       placeholder="Temperature"/>
                <span class="input-group-addon add-on"><sup>o</sup>C</span>

            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" for="BirthDate">Patient Weight</label>

            <div class="input-group input-append date">
                <input type="text" class="form-control" name="weight"
                       placeholder="Weight"/>
                <span class="input-group-addon add-on">Kg</span>

            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" for="BirthDate">Patient Pulse</label>

            <div class="input-group input-append date">
                <input type="text" class="form-control" name="pulse"
                       placeholder="Pulse"/>
                <span class="input-group-addon add-on">/min</span>

            </div>
        </div>
    </div>


</div>

<div class="col-md-12">


    <div class="col-md-6">
        <div class="form-group">
            <label>History of Presenting Complaint</label>
            <textarea class="form-control" rows="3" name="complaint"></textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label>Drug History</label>
            <textarea class="form-control" rows="3" name="drug_history"></textarea>
        </div>
    </div>
</div>

<div class="col-md-12">


    <div class="col-md-6">
        <div class="form-group">
            <label>Past Medical History</label>
            <textarea class="form-control" rows="3" name="med_history"></textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label>Social History</label>
            <textarea class="form-control" rows="3" name="social_history"></textarea>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-6">
        <div class="form-group">
            <label>Diagnosis</label>
            <textarea class="form-control" rows="3" name="diagnosis"></textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Treatment</label>
            <textarea class="form-control" rows="3" name="treatment"></textarea>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-12">
        <div class="form-group">
            <label>Remark & Summary</label>
            <textarea class="form-control" rows="3" name="summary"></textarea>
        </div>
    </div>


</div>



@if(!$patient->patientAdmitted)
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_admitted"> <strong>Patient Admitted ?</strong>
                </label>
            </div>
        </div>
        <div class="callout callout-info"><i class="fa fa-info"></i> To Admit the patient, please check the "Patient
            Admitted" box
        </div>


    </div>
@else

    <input type="hidden" name="in_patient_id" value="{{$patient->patientAdmitted->id}}">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_discharged"> <strong> Discharge Patient ?</strong>
                </label>
            </div>
        </div>

        <div class="callout callout-warning"><i class="fa fa-info"></i> This patient is currently admitted, To discharge,
            check the Discharge Patient box
        </div>
    </div>
@endif

<!-- /.col-lg-6 (nested) -->

<div class="row pull-right">
    <div class="col-md-12" style="margin-top: 20px;">

        <input type="submit" class="btn btn-success btn-lg" value="Save Diagnosis">
        <button type="reset" class="btn btn-defaul btn-lg">Reset Button</button>

    </div>
</div>




