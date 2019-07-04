<?php

namespace App\Http\Controllers;

use App\Service\DiagnosticService;
use App\Service\DigitalService;
use App\Service\GeneralService;
use App\Service\PatientService;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DiagnosticController extends Controller
{
    //
    /**
     * @var DiagnosticService
     */
    private $diagnosticService;
    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var GeneralService
     */
    private $generalService;
    /**
     * @var DigitalService
     */
    private $digitalService;

    public function __construct(DiagnosticService $diagnosticService, PatientService $patientService,
                                GeneralService $generalService, DigitalService $digitalService)
    {
        $this->middleware('auth');
        $this->diagnosticService = $diagnosticService;
        $this->patientService = $patientService;
        $this->generalService = $generalService;
        $this->digitalService = $digitalService;
    }

    public function index()
    {
        return view('diagnostic.welcome');
    }


    public function indexData(Request $request)
    {

        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $diagnostics = $this->diagnosticService->getAllDiagnostics();

        //  dd($patients);


        return Datatables::of($diagnostics)
            ->addColumn('action', function ($diagnostics) {

                return '<a href="/diagnostics/edit/' . $diagnostics->id . '" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Edit </a>';
            })
            // ->removeColumn('password')
            ->make(true);

    }

    public function create()
    {
        $diagnostics = $this->diagnosticService->getAllDiagnostics();
        return view('diagnostic.create', compact('diagnostics'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2',
                'price' => 'required|numeric',


            ]
        );


        $this->diagnosticService->createDiagnostic($request);
        session()->flash('message', 'New Diagnostic Test Stored');
        return redirect()->back();
    }


    public function edit($test_id)
    {
        $test = $this->diagnosticService->getADiagnosticTestById($test_id);
        if (!$test) {
            abort(404);
        }
        return view('diagnostic.update', compact('test'));
    }

    public function update(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2',
                'price' => 'required|numeric',


            ]
        );


        $this->diagnosticService->updateDiagnostic($request);
        session()->flash('message', 'Selected Diagnostic Test Updated');
        return redirect()->back();
    }

    public function test($patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);
        $diagnostics = $this->diagnosticService->getAllDiagnostics();
        return view('diagnostic.create_test', compact('patient', 'diagnostics'));
    }

    public function getTest(Request $request)
    {
        $tests = $this->diagnosticService->getADiagnosticTest($request->name);

        return json_encode($tests);
    }


    public function storeTest(Request $request, $patient)
    {
        $test_id = $request->test_id;
        $test_name = $request->test_name;
        $discount = $request->discount;
        $checked_test = $request->test;

        if ($checked_test == null || count($checked_test) == 0) {
            return redirect()->back()->withErrors(["No Test Selected, Please Check the test before saving"]);
        }
//        $test_name = $request->itemName;
//        $result = $request->result;
//        $normal_range = $request->quantity;
//        $discount = $request->discount;
//        $files = $request->file('result_file');

        $date = $this->generalService->convertToSQLDDate($request->orderDate);

        foreach ($checked_test as $key => $n) {

            //  if ($checked_test[$key] = "on") {


            $selected_test_id = $test_id[$key];
            $selected_test_name = $test_name[$key];
            $selected_discount = intval($discount[$key]);
            // $price = 0;
            //Get the Test Information


            $test = $this->diagnosticService->getADiagnosticTestById($selected_test_id);

            //Check if the  Test is a child test.

            $price = $test->price;


            $attributes = new Request();

            $attributes->date = $date;
            $attributes->patient_id = $patient;
            $attributes->diagnostic_id = $selected_test_id;
            $attributes->test_name = $selected_test_name;
            $attributes->normal_range = $test->normal_range;
            $attributes->price = $price;
            $attributes->discount = $selected_discount;
            $attributes->is_file = false;
            $attributes->created_by = auth()->user()->getAuthIdentifier();

            $this->diagnosticService->storeDiagnosticResult($attributes);

            //  }

        }
//        foreach ($test_name as $key => $n) {
//
//
//            //Get The Tests Selected ID
//            $test = $this->diagnosticService->getADiagnosticTestByName($test_name[$key]);
//            $attributes = new Request();
//            $attributes->patient_id = $patient;
//            $attributes->diagnostic_id = $test->id;
//            $attributes->date = $date;
//            $attributes->normal_range = $normal_range[$key];
//            $attributes->result = $result[$key];
//            $attributes->price = $test->price;
//            if ($discount[$key] < 0) {
//                //It is a negative discount
//                $attributes->is_subtract_discount = true;
//            } else {
//                $attributes->is_subtract_discount = false;
//            }
//
//            $attributes->discount = abs($discount[$key]);
//            $attributes->created_by = auth()->user()->getAuthIdentifier();
//
//            $attributes->is_file = false;
//            //
//
//
//            //Get The fike if There is a file
//            if (isset($files[$key]) && $files[$key] != null) {
//                $file = $files[$key];
////            //Move Uploaded File
//                $destinationPath = 'DiagnosticFiles';
////
//
//
//                $fileName = $this->digitalService->uploadFile($file, $destinationPath);
//                $attributes->is_file = true;
//
//                $attributes->result = $fileName;
//
//            }
//
//
//            $this->diagnosticService->storeDiagnosticResult($attributes);
//
//
//        }

        session()->flash('message', 'Patient Diagnostic Tests  Saved');
        return redirect()->route('diagnostics.test.list', ['id' => $patient]);
    }


    public function allPatientTests($patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);


        return view('diagnostic.allTests', compact('patient'));
    }

    public function allPatientTestsData(Request $request)
    {

        $patient_id = $request->patient_id;

        $tests = $this->diagnosticService->getADiagnosticResultByPatient($patient_id, true);


        //  dd($patients);


        return Datatables::of($tests)
            ->addColumn('action', function ($tests) {

                return '<a href="/diagnostics/update/tests/' . $tests->date . '/' . $tests->patient_id . '" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Update Result </a>';
            })
            ->editColumn('date', function ($tests) {

                return $tests->date;
            })
            ->editColumn('name', function ($tests) {

                return $tests->diagnostic->name;
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
        $tests = $this->diagnosticService->getADiagnosticResultByPatient($patient_id, true, $date);
        return view('diagnostic.update_test', compact('patient', 'tests'));


    }

    public function storeUpdateTest(Request $request, $patient)
    {

        $test_id = $request->test_id;
        $test_name = $request->itemName;
        $result = $request->result;
        $normal_range = $request->quantity;
        $discount = $request->discount;
        $files = $request->file('result_file');

        $date = $this->generalService->convertToSQLDDate($request->orderDate);


        foreach ($test_name as $key => $n) {


            //Get The Tests Selected ID
            $test = $this->diagnosticService->getADiagnosticTestByName($test_name[$key]);
            $attributes = new Request();
            $attributes->patient_id = $patient;
            $attributes->diagnostic_id = $test->id;
            $attributes->date = $date;
            $attributes->normal_range = $normal_range[$key];
            $attributes->result = $result[$key];
            $attributes->price = $test->price;
            $attributes->test_id = $test_id[$key];

            $attributes->discount = ($discount[$key]);
            $attributes->created_by = auth()->user()->getAuthIdentifier();

            $attributes->is_file = false;
            //


            //Get The fike if There is a file
            if (isset($files[$key]) && $files[$key] != null) {
                $file = $files[$key];
//            //Move Uploaded File
                $destinationPath = 'DiagnosticFiles';
//


                $fileName = $this->digitalService->uploadFile($file, $destinationPath);
                $attributes->is_file = true;

                $attributes->result = $fileName;

            }


            $this->diagnosticService->updateDiagnosticResult($attributes);


        }

        session()->flash('message', 'Patient Diagnostic Test Updated');
        return redirect()->route('diagnostics.test.list', ['id' => $patient]);
    }
}
