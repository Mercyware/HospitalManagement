<?php

namespace App\Http\Controllers;

use App\Drug;
use App\Patient;
use App\Repository\DiagnosisRepository;
use App\Service\DiagnosisService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientHistoryController extends Controller
{
    //
    /**
     * @var DiagnosisService
     */
    private $diagnosisService;

    public function __construct(DiagnosisService $diagnosisService)
    {
        $this->middleware('auth');
        $this->diagnosisService = $diagnosisService;
    }

    public function index(Patient $patient)
    {
        return view('patienthistory.patient', compact('patient'));

    }

    public function dentalhistory(Patient $patient)
    {
        return view('patienthistory.dental', compact('patient'));
    }


    public function eyehistory($patient, $page)
    {

        //Get Patient Eye History


        $patientsHistories = $this->diagnosisService->diagnosisHistory($patient, 2, $page);


        if (!$patientsHistories->isEmpty()) {

            return view('partials.medicalHistory', compact('patientsHistories'));
        }
    }

    public function dentalhistoryajax($patient, $page)
    {



        //Get Patient Eye History


        $patientsHistories = $this->diagnosisService->diagnosisHistory($patient, 1, $page);


        if (!$patientsHistories->isEmpty()) {

            return view('partials.medicalHistory', compact('patientsHistories'));
        }
    }
}
