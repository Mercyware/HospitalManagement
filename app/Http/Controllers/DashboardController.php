<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\DiagnosticResults;
use App\laboratory;
use App\Patient;
use App\Service\DiagnosisService;
use App\Service\DiagnosticService;
use App\Service\GeneralService;
use App\Service\LaboratoryService;
use App\Service\PatientService;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //

    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var DiagnosisService
     */
    private $diagnosisService;
    /**
     * @var LaboratoryService
     */
    private $laboratoryService;
    /**
     * @var DiagnosticService
     */
    private $diagnosticService;
    /**
     * @var GeneralService
     */
    private $generalService;

    public function __construct(PatientService $patientService, DiagnosisService $diagnosisService,
                                LaboratoryService $laboratoryService,
                                DiagnosticService $diagnosticService, GeneralService $generalService)
    {
        $this->patientService = $patientService;
        $this->diagnosisService = $diagnosisService;
        $this->laboratoryService = $laboratoryService;
        $this->diagnosticService = $diagnosticService;
        $this->middleware('auth');
        $this->generalService = $generalService;
    }

    private function patient($date_from = null, $date_to = null)
    {
        $patients = Patient::where('id', "<>", null);


        if ($date_from != null && $date_to != null) {
            $date_from = $this->generalService->convertToSQLDDate($date_from);
            $date_to = $this->generalService->convertToSQLDDate($date_to);

            $patients = $patients->whereBetween('created_at', [$date_from, $date_to]);

        } else {
            $patients = $patients->whereDate('created_at', Carbon::today()->toDateString());

        }
        return $patients;
    }


    private function medicalCare($date_from = null, $date_to = null)
    {
        $medicalCare = Diagnosis::where('id', "<>", null);


        if ($date_from != null && $date_to != null) {
            $date_from = $this->generalService->convertToSQLDDate($date_from);
            $date_to = $this->generalService->convertToSQLDDate($date_to);

            $medicalCare = $medicalCare->whereBetween('created_at', [$date_from, $date_to]);

        } else {
            $medicalCare = $medicalCare->whereDate('created_at', Carbon::today()->toDateString());

        }
        return $medicalCare;
    }


    private function laboratory($date_from = null, $date_to = null)
    {
        $laboratory = laboratory::where('id', "<>", null);


        if ($date_from != null && $date_to != null) {
            $date_from = $this->generalService->convertToSQLDDate($date_from);
            $date_to = $this->generalService->convertToSQLDDate($date_to);

            $laboratory = $laboratory->whereBetween('created_at', [$date_from, $date_to]);

        } else {
            $laboratory = $laboratory->whereDate('created_at', Carbon::today()->toDateString());

        }
        return $laboratory;
    }

    private function diagnostic($date_from = null, $date_to = null)
    {
        $diagnostic = DiagnosticResults::where('id', "<>", null);


        if ($date_from != null && $date_to != null) {
            $date_from = $this->generalService->convertToSQLDDate($date_from);
            $date_to = $this->generalService->convertToSQLDDate($date_to);

            $diagnostic = $diagnostic->whereBetween('created_at', [$date_from, $date_to]);

        } else {
            $diagnostic = $diagnostic->whereDate('created_at', Carbon::today()->toDateString());

        }
        return $diagnostic;
    }

    private function visits($date_from = null, $date_to = null)
    {
        DB::enableQueryLog();


        $patient = $this->patient($date_from, $date_to)->select('id as id')->get();
        $medicalCare = $this->medicalCare($date_from, $date_to)->select('patient_id as id')->get();
        $laboratory = $this->laboratory($date_from, $date_to)->select('patient_id as id')->get();
        $diagnostics = $this->diagnostic($date_from, $date_to)->select('patient_id as id')->get();


        $new = array_merge($patient->toArray(), $medicalCare->toArray(), $laboratory->toArray(), $diagnostics->toArray());
        $visits = array_map("unserialize", array_unique(array_map("serialize", $new)));

        return $visits;
    }

    public function dashboard($date_from = null, $date_to = null, Request $request)
    {
        if (isset($request->date_from)) {
            $date_from = $request->date_from;
        }

        if (isset($request->date_to)) {
            $date_to = $request->date_to;
        }


        $patients = $this->patient($date_from, $date_to)->get();
        $medicalCare = $this->medicalCare($date_from, $date_to)->get();
        $laboratoryTests = $this->laboratory($date_from, $date_to)->get();
        $diagnosticTests = $this->diagnostic($date_from, $date_to)->get();
        $visits = $this->visits($date_from, $date_to);

        //Convert Date From and Date To

        if ($date_from != null && $date_to != null) {
            $date_from = $this->generalService->convertToSQLDDate($date_from);
            $date_to = $this->generalService->convertToSQLDDate($date_to);
        }
        
        return view('dashboard', compact('patients', 'medicalCare', 'laboratoryTests', 'diagnosticTests', 'date_from', 'date_to', 'visits'));
    }


    //Chart Loader

    public function patientByGenderPie($date_from = null, $date_to = null)
    {
       // $patients = ;

        $male = $this->patient($date_from, $date_to)->where('sex', 1)->get();
        $female = $this->patient($date_from, $date_to)->where('sex', 2)->get();

        $data[] = array(
            'Status' => "Male Patients",
            'Data' => count($male),

        );

        $data[] = array(
            'Status' => "Female Patients",
            'Data' => count($female),

        );

        return array_merge($data);

    }


    public function patientsAnalytics($date_from = null, $date_to = null)
    {


        $data = array();
        $patients = $this->patient($date_from, $date_to)->get();
        $medicalCare = $this->medicalCare($date_from, $date_to)->get();
        $laboratoryTests = $this->laboratory($date_from, $date_to)->get();
        $diagnosticTests = $this->diagnostic($date_from, $date_to)->get();


        $data[] = array(
            'Title' => "Registered Patients",
            'Data' => count($patients),

        );


        $data[] = array(
            'Title' => "Medical Care Visits",
            'Data' => count($medicalCare),

        );

        $data[] = array(
            'Title' => "Laboratory Visits",
            'Data' => count($laboratoryTests),

        );

        $data[] = array(
            'Title' => "Diagnostics Visits",
            'Data' => count($diagnosticTests),

        );


        return array_merge($data);


    }


}
