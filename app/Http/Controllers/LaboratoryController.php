<?php

namespace App\Http\Controllers;

use App\laboratory;
use App\Patient;
use App\Service\CompanyService;
use App\Service\GeneralService;
use App\Service\LaboratoryService;
use App\Service\PatientService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class LaboratoryController extends Controller
{
    //

    /**
     * @var CompanyService
     */
    private $companyService;
    /**
     * @var LaboratoryService
     */
    private $laboratoryService;
    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var GeneralService
     */
    private $generalService;

    public function __construct(CompanyService $companyService, LaboratoryService $laboratoryService,
                                PatientService $patientService, GeneralService $generalService)
    {
        $this->middleware('auth');
        $this->companyService = $companyService;
        $this->laboratoryService = $laboratoryService;
        $this->patientService = $patientService;
        $this->generalService = $generalService;
    }

    public function create($patient)
    {
        $patient = $this->patientService->getAPatient($patient);
        $tests = $this->laboratoryService->allParentTest();
        return view('laboratory.create_test', compact('patient', 'tests'));
    }

    public function store(Request $request, Patient $patient)
    {

        $test_id = $request->test_id;
        $test_name = $request->test_name;
        $discount = $request->discount;
        $checked_test = $request->test;

        // dd($checked_test);
//        if (count($test_id) <= 0) {
//            return redirect()->route('laboratory.patient.test', $patient->id)
//                ->withErrors('Error');
//
//        }

        $date = $this->generalService->convertToSQLDDate($request->orderDate);


        foreach ($checked_test as $key => $n) {

            //  if ($checked_test[$key] = "on") {


            $selected_test_id = $test_id[$key];
            $selected_test_name = $test_name[$key];
            $selected_discount = intval($discount[$key]);
            // $price = 0;
            //Get the Test Information
            $test = $this->laboratoryService->getATest($selected_test_id);

            //Check if the  Test is a child test.
            $parent_id = $test->parent_id;
            $price = $test->price;
            if ($parent_id > 0) {

                //This is a child test
                if (array_key_exists($parent_id, $checked_test)) {


                    $price = 0;
                }
                //Check if the Parent of the test is selected

            }




            $attributes = new Request();

            $attributes->date = $date;
            $attributes->patient_id = $patient->id;
            $attributes->test_id = $selected_test_id;
            $attributes->test_name = $selected_test_name;
            $attributes->normal_range = $test->normal_range;
            $attributes->price = $price;
            $attributes->discount = $selected_discount;
            $attributes->charged_by = auth()->user()->getAuthIdentifier();

            $this->laboratoryService->createPatientTest($attributes);

            //  }

        }

        session()->flash('message', 'Patient laboratory Tests  Saved');
        return redirect()->route('laboratory.patient.test', ['id' => $patient->id]);
    }


    public function allPatientTests($patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);


        return view('laboratory.allTests', compact('patient'));
    }

    public function allPatientTestsData(Request $request)
    {

        $patient_id = $request->patient_id;

        $tests = $this->laboratoryService->getALaboratoryResultByPatient($patient_id, true);


        //  dd($patients);


        return Datatables::of($tests)
            ->addColumn('action', function ($tests) {

                return '
                <a href="/laboratory/update/tests/' . $tests->date . '/' . $tests->patient_id . '" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Update Result </a>
         <a href="/laboratory/result/' . $tests->patient_id . '/' . $tests->date . '" class="btn btn-xs btn-success">
        <i class="fa fa-pencil"></i> Print Result </a>';
            })
            ->editColumn('date', function ($tests) {

                return $tests->date;
            })
            ->editColumn('name', function ($tests) {

                return $tests->test_name;
            })
            ->editColumn('price', function ($tests) {

                return number_format($tests->price);
            })
            ->editColumn('status', function ($tests) {
                $result = "Not Uploaded";
                if ($tests->result != null) {
                    $result = "Uploaded";
                }
                return "Result  $result";
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function updateTest($date, $patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);
        $tests = $this->laboratoryService->getALaboratoryResultByPatient($patient_id, true, $date);
        return view('laboratory.update_test', compact('patient', 'tests'));


    }

    public function storeUpdateTest(Request $request, $patient)
    {

        $test_id = $request->result_id;
        // $test_id = $request->test_id;
        $test_name = $request->itemName;
        $result = $request->result;
        $normal_range = $request->quantity;
        $discount = $request->discount;


        $date = $this->generalService->convertToSQLDDate($request->orderDate);


        foreach ($test_name as $key => $n) {


            $attributes = new Request();

            $attributes->patient_id = $patient;

            // $attributes->test_id = $test_id[$key];

            $attributes->date = $date;
            $attributes->normal_range = $normal_range[$key];
            $attributes->result = $result[$key];


            //$attributes->price = $test->price;


            $attributes->test_id = $test_id[$key];


            $attributes->discount = $discount[$key];
            $attributes->created_by = auth()->user()->getAuthIdentifier();


            $this->laboratoryService->updateLaboratoryResult($attributes);


        }

        session()->flash('message', 'Patient Laboratory Test Updated');
        return redirect()->route('laboratory.patient.test.result', [$patient, $date]);
    }


    public function result($patient, $date)
    {

        $company = $this->companyService->getACompany();
        // dd($testdate);

        $laboratories = $this->laboratoryService->getALaboratoryResultByPatient($patient, false, $date);


        $patient = $this->patientService->getAPatient($patient);


        //  $test = Tests::with('id')->first();
        //  dd($patient);
        return view('laboratory.view', compact('laboratories', 'patient', 'company'));
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(Request $request)
    {

        DB::enableQueryLog();
        $query = DB::table('laboratories')
            ->select('test_date', 'id', 'patient_id', 'test_id', 'user_id', DB::raw('count(*) as tests'));

        if ($request->fromdate && $request->fromdate != null) {
            $query->whereBetween('test_date', [date('Y-m-d', strtotime($request->fromdate)), date('Y-m-d', strtotime($request->todate))]);
        }

        $query->groupBy('patient_id');
        $query->groupBy('test_date');

        $laboratory = $query->get();

        // dd(DB::getQueryLog());
        $start = 1;
        return Datatables::of($laboratory)
            ->addColumn('id', function ($laboratory) use (&$start) {
                return $start++;
            })
            ->editColumn('date_received', function ($laboratory) {
                return Carbon::createFromFormat('Y-m-d', $laboratory->test_date)->format('d/m/Y');

            })
            ->editColumn('name', function ($laboratory) {
                return Patient::find($laboratory->patient_id)->name;

            })
            ->editColumn('test', function ($laboratory) {
                return number_format(($laboratory->tests));

            })
            ->editColumn('user', function ($laboratory) {
                return User::find($laboratory->user_id)->name;

            })
            ->addColumn('action', function ($laboratory) {
                return '<a href="/laboratory/result/' . $laboratory->patient_id . '/' . $laboratory->test_date . '" class="btn btn-xs btn-primary">
<i class="fa fa-eye"></i> View Result </a> ';
            })
            // ->removeColumn('password')
            ->make(true);

    }


}
