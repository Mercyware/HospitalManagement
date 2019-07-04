<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Tooth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToothController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Patient $patient)
    {
        return view('tooth.welcome', compact('patient'));
    }


    public function store($patient, $position, $tooth, $part)
    {

//get the Patient Tooth Status for this Postion
        $toothStatus = DB::table('teeth')
            ->where('patient_id', '=', $patient)
            ->where('tooth_position', '=', $position)
            ->where('tooth_number', '=', $tooth)
            ->where('tooth_part', '=', $part)
            ->get();

        //dd($toothStatus);
        if (!$toothStatus->isEmpty()) { // If there is a Current Tooth Status
            $PatientTooth = $toothStatus[0]->part_value;


            if ($PatientTooth == 2) {
                $PatientTooth = 0;
            } else {
                $PatientTooth = $PatientTooth + 1;
            }

            DB::table('teeth')
                ->where('patient_id', '=', $patient)
                ->where('tooth_position', '=', $position)
                ->where('tooth_number', '=', $tooth)
                ->where('tooth_part', '=', $part)
                ->update(['part_value' => $PatientTooth, 'user_id' => auth()->user()->id]);


            // return "Updated";

        } else {
            $PatientTooth = 0;
            $Newtooth = new Tooth();
            $Newtooth->patient_id = $patient;
            $Newtooth->tooth_position = $position;
            $Newtooth->tooth_number = $tooth;
            $Newtooth->tooth_status = $PatientTooth;
            $Newtooth->tooth_part = $part;
            $Newtooth->part_value = 1;
            $Newtooth->user_id = auth()->user()->id;

            $Newtooth->save();

        }


        $this->gettooth($patient, $position, $tooth);

    }


    public function storetooth($patient, $position, $tooth)
    {

        /*
         * 0 - Tooth
         * 1- TO Be Extracted
         * 2-  Extracted
         * 3 - Empty
         */

//get the Patient Tooth Status for this Position
        $toothStatus = DB::table('teeth')
            ->where('patient_id', '=', $patient)
            ->where('tooth_position', '=', $position)
            ->where('tooth_number', '=', $tooth)
            ->get();

        //dd($toothStatus);
        if (!$toothStatus->isEmpty()) { // If there is a Current Tooth Status
            $PatientTooth = $toothStatus[0]->tooth_status;


            if ($PatientTooth == 3) {
                $PatientTooth = 0;
            } else {
                $PatientTooth = $PatientTooth + 1;
            }

            DB::table('teeth')
                ->where('patient_id', '=', $patient)
                ->where('tooth_position', '=', $position)
                ->where('tooth_number', '=', $tooth)
                ->update(['tooth_status' => $PatientTooth, 'user_id' => auth()->user()->id]);


            // return "Updated";

        } else {
            $PatientTooth = 1;
            $Newtooth = new Tooth();
            $Newtooth->patient_id = $patient;
            $Newtooth->tooth_position = $position;
            $Newtooth->tooth_number = $tooth;
            $Newtooth->tooth_status = $PatientTooth;
            $Newtooth->user_id = auth()->user()->id;

            $Newtooth->save();

        }


        $patienttooth = DB::table('teeth')
            ->where('patient_id', '=', $patient)
            ->where('tooth_position', '=', $position)
            ->where('tooth_number', '=', $tooth)
            ->get();

        //foreach ($patienttooth as $patientteeth) {
        $Status = $patienttooth[0]->tooth_status;


        //This is the Top Value fro the Teach
        $Image = getToothStatusPhoto($Status, $tooth);

        if ($Status == 0 && $tooth > 3) {
            $MapName = '#tooth' . $tooth;
        } else if ($Status == 0 && $tooth <= 3) {
            $MapName = '#tooth2' . $tooth;
        } else {
            $MapName = "";
        }


        return response()->json(array('status' => $Status,
            'img' => '<img src="/Images/' . $Image . '" class="ParentImage" usemap="' . $MapName . '"/>'), 200);
        // return response()->json();

        //        echo ' ';


        //   }


    }


    public function gettooth($patient, $position, $tooth)
    {
        $patienttooth = DB::table('teeth')
            ->where('patient_id', '=', $patient)
            ->where('tooth_position', '=', $position)
            ->where('tooth_number', '=', $tooth)
            ->get();
        if (!$patienttooth->isEmpty()) {
            foreach ($patienttooth as $patientteeth) {
                $Status = $patientteeth->part_value;

                if ($patientteeth->tooth_part == "T") {
                    //This is the Top Value fro the Teach
                    $Image = getPhotoName($Status);
                    $Classname = 'TopImage';
                    echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $position . ',' . $tooth . ',\'T\');"/>';


                }
                if ($patientteeth->tooth_part == "B") {
                    //This is the Top Value fro the Teach
                    $Image = getPhotoName($Status);
                    $Classname = 'BottomImage';
                    echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $position . ',' . $tooth . ',\'B\');"/>';


                }

                if ($patientteeth->tooth_part == "C") {
                    //This is the Top Value fro the Teach
                    $Image = getPhotoName($Status);
                    $Classname = 'CenterImage';
                    echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $position . ',' . $tooth . ',\'C\');"/>';


                }
                if ($patientteeth->tooth_part == "L") {
                    //This is the Top Value fro the Teach
                    $Image = getPhotoName($Status);
                    $Classname = 'LeftImage';
                    echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $position . ',' . $tooth . ',\'L\');"/>';


                }

                if ($patientteeth->tooth_part == "R") {
                    //This is the Top Value fro the Teach
                    $Image = getPhotoName($Status);
                    $Classname = 'RightImage';
                    echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $position . ',' . $tooth . ',\'R\');"/>';


                }
            }
        }

    }
}
