<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\Patient;

class EyeController extends Controller
{
    //


    public function show($patient)
    {

        $patient = Patient::findorfail($patient);
        return view('diagnosis.eye', compact('patient'));
    }


    public function update($patient)
    {

        $this->validate(request(),
            [
                'diagnosis' => 'required|min:2',
                'treatment' => 'required|min:2',
            ]
        );


        Diagnosis::create(
            [
                'temperature' => request('temperature'),
                'pressure' => request('pressure'),
                'weight' => request('weight'),
                'pulse' => request('pulse'),
                'complaint' => request('complaint'),
                'drug_history' => request('drug_history'),
                'med_history' => request('med_history'),
                'social_history' => request('social_history'),
                'diagnosis' => request('diagnosis'),
                'treatment' => request('treatment'),
                'summary' => request('summary'),
                'left_eye' => request('left'),
                'right_eye' => request('right'),
                'patient_id' => $patient,
                'user_id' => auth()->user()->id,
                'diag_id' => 2
            ]);


        //return response()->json(array('success' => true,
        //  'message'=> 'Patient Diagnosis Saved'), 200);
        //  return response()->json();
        //echo "<div class='alert alert-success'>Patient Diagnosis Saved</div>";

        session()->flash('message', 'Patient Eye Diagnosis Saved');
        return redirect()->route('eye.show', ['id' => $patient]);
    }
}
