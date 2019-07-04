<?php
foreach ($patientsHistories as $history) {

$user = $history->staff;


$Date_Created = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $history->created_at)->format('Y-m-d');

$drugs = DB::table('drug_administers')
    ->where('patient_id', $history->patient_id)
    ->where('date_created', $Date_Created)
    ->orderBy('id', 'desc')
    ->get();


?>
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-heading">
            @if($history->diagnosis_type == 2)
                <div class="col-md-12" style="margin-bottom: 10px">
                    <div class="col-md-3">
                        <div class="circle">

                            <p> <?= $history->left_eye; ?></p>

                        </div>
                    </div>
                    <div class="col-md-3 ">
                    </div>
                    <div class="col-md-3 ">
                    </div>
                    <div class="col-md-3 ">
                        <div class="circle ">
                            <p><?= $history->right_eye; ?></p>
                        </div>
                    </div>


                </div>
            @endif

            <h5 class="text-black"><strong>Visitation Date
                    :</strong> <?php echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $history->created_at)->format('d/m/Y'); ?>
            </h5>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <h6 class="text-black">Doctor Name : <?= $user->name; ?> (<?= $user->position; ?>)</h6>
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="text-black">Patient Pressure : <?= $history->pressure; ?> mm/Hg</h6>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-black">Temperature : <?= $history->temperature; ?> <sup>o</sup>F
                        </h6>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-black">Weight : <?= $history->weight; ?> Kg</h6>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-black">Pulse : <?= $history->pulse; ?> B/min</h6>
                    </div>

                </div>

                <div class="row">
                    <hr/>
                    <div class="col-md-12">
                        <h5 class="text-black"><strong>History of Present Complaint</strong></h5>
                        <h6 class="text-black"><?= $history->complaint; ?></h6>
                    </div>

                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Drug History</strong></h5>
                        <h6 class="text-black"><?= $history->drug_history; ?></h6>
                    </div>

                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Past Medical History</strong></h5>
                        <h6 class="text-black"><?= $history->med_history; ?></h6>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Social History</strong></h5>
                        <h6 class="text-black"><?= $history->social_history; ?></h6>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Diagnosis</strong></h5>
                        <h6 class="text-black"><?= $history->diagnosis; ?></h6>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Treatment</strong></h5>
                        <h6 class="text-black"><?= $history->treatment; ?></h6>
                    </div>

                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Remark & Summary</strong></h5>
                        <h6 class="text-black"><?= $history->summary; ?></h6>
                    </div>

                </div>

                <div class="row">
                    <hr/>
                    <div class="col-md-12">
                        <h5 class="text-black"><strong>Drugs Prescribed</strong></h5>
                        <?php
                        if (!$drugs->isEmpty()) {
                            foreach ($drugs as $drug) {
                                $DrugName = Drug::find($drug->drug_id)->drugname;
                                echo $DrugName . ",";
                            }
                        } else {
                            echo "<div class='callout callout-info'>No Drug Prescription found</div>";
                        }
                        ?>
                    </div>



                </div>




                <div class="row">
                    <hr/>
                    <div class="col-md-12">

                        @if($history->patientAdmitted)

                            <div class="callout-warning callout"><i class="fa fa-hospital-o"></i> Patient was admitted</div>
                        @endif
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
<?php

}