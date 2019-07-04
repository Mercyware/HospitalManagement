<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\Patient;
use App\Service\DiagnosisService;
use App\Service\GeneralService;
use App\Service\InPatientService;
use App\Service\PatientService;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Http\Request;


class DentalController extends Controller
{

    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var DiagnosisService
     */
    private $diagnosisService;
    /**
     * @var InPatientService
     */
    private $inPatientService;
    /**
     * @var GeneralService
     */
    private $generalService;

    public function __construct(PatientService $patientService, DiagnosisService $diagnosisService,
                                InPatientService $inPatientService, GeneralService $generalService)
    {
        $this->middleware('auth');
        $this->patientService = $patientService;
        $this->diagnosisService = $diagnosisService;
        $this->inPatientService = $inPatientService;
        $this->generalService = $generalService;
    }

    //
    public function show($patient)
    {

        $patient = $this->patientService->getAPatient($patient);

        return view('diagnosis.create', compact('patient'));
    }


    //Create New Diagnosis
    public function update(Request $request, $patient)
    {

        //dd($patient);

        $this->validate(request(),
            [
                'diagnosis' => 'required|min:2',
                'treatment' => 'required|min:2',
            ]
        );


        $request->diagnosis_date = $this->generalService->convertToSQLDDate($request->diagnosis_date);

        $diagnosis = $this->diagnosisService->createDiagnosis($request, $patient);

        //If Patient is Admitted
        if (isset($request->is_admitted) && ($request->is_admitted == 'on')) {
            $request->date_admitted = $request->diagnosis_date;
            $this->inPatientService->admitPatient($patient, $diagnosis->id, $request);
        }

        if (isset($request->is_discharged)) {
            $request->date_discharged = $request->diagnosis_date;
            $this->inPatientService->dischargePatient($request->in_patient_id, $request);
        }

        //return response()->json(array('success' => true,
        //  'message'=> 'Patient Diagnosis Saved'), 200);
        //  return response()->json();
        //echo "<div class='alert alert-success'>Patient Diagnosis Saved</div>";

        session()->flash('message', 'Patient Diagnosis Saved');
        return redirect()->route('dental.show', ['id' => $patient]);
    }



}
