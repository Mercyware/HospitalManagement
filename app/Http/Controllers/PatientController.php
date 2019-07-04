<?php

namespace App\Http\Controllers;


use App\Http\Requests\PatientRequest;

use App\Service\BloodBankService;
use App\Service\BranchService;
use App\Service\GeneralService;
use App\Service\PatientService;

use App\Service\DigitalService;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;


class PatientController extends Controller
{
    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var DigitalService
     */
    private $digitalService;
    /**
     * @var BranchService
     */
    private $branchService;
    /**
     * @var GeneralService
     */
    private $generalService;
    /**
     * @var BloodBankService
     */
    private $bloodBankService;


    public function __construct(PatientService $patientService, DigitalService $digitalService,
                                BranchService $branchService, GeneralService $generalService, BloodBankService $bloodBankService)
    {
        $this->middleware('auth');
        $this->patientService = $patientService;
        $this->digitalService = $digitalService;
        $this->branchService = $branchService;
        $this->generalService = $generalService;
        $this->bloodBankService = $bloodBankService;
    }
    //

    //use Authorizable;

    // public function __construct()
    // {
    //   $this->middleware('auth');
    //   }

    public function index()
    {
        $branches = $this->branchService->getAllBranches();

        return view('patients.welcome', compact('branches'));
    }

    public function edit($patient_id)
    {
        //dd('Here');
        $branches = $this->branchService->getAllBranches();
        $patient = $this->patientService->getAPatient($patient_id);
        $bloodgroups = $this->bloodBankService->getBloodGroups();
        return view('patients.update', compact('patient', 'branches', 'bloodgroups'));
    }

    public function create()
    {
        $branches = $this->branchService->getAllBranches();
        $bloodgroups = $this->bloodBankService->getBloodGroups();
        return view('patients.create', compact('branches', 'bloodgroups'));
    }


    public function show($patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);
        return view('patients.patient', compact('patient'));
    }


    public function store(PatientRequest $request)
    {


        $photoName = "";
        if ($request->hasFile('Picture')) {
            $file = $request->file('Picture');
//            //Move Uploaded File
            $destinationPath = 'PatientPhoto';
//
//            $NewName = Carbon::now()->timestamp . ".png";
//            $move = $file->move($destinationPath, $NewName);

            // $path = $request->Picture->storeAs($destinationPath, 'filename.jpg');

            $photoName = $this->digitalService->uploadFile($file, $destinationPath);
        }
        $date_of_birth = null;
        if ($request->dob != null) {
            $date_of_birth = $this->generalService->convertToSQLDDate($request->dob);
        }


        $request->photo = $photoName;
        $request->date_of_birth = $date_of_birth;


        //TODO: Create Patient Here
        $this->patientService->createPatient($request);

        // $request->persist();
        session()->flash('message', 'New patient has been registered');
        return redirect()->route('patients.create');
        // return redirect()->route('patients');

    }


    public function update(Request $request, $patient)
    {
        //$DoB = request('dob');


        $photoName = "";
        if ($request->hasFile('Picture')) {
            $file = $request->file('Picture');
//            //Move Uploaded File
            $destinationPath = 'PatientPhoto';
//
//            $NewName = Carbon::now()->timestamp . ".png";
//            $move = $file->move($destinationPath, $NewName);

            // $path = $request->Picture->storeAs($destinationPath, 'filename.jpg');

            $photoName = $this->digitalService->uploadFile($file, $destinationPath);
        }

        $request->photo = $photoName;
        if ($request->date_of_birth != null && $request->date_of_birth != "") {
            $request->date_of_birth = $this->generalService->convertToSQLDDate($request->dob);

        }else{
            $request->date_of_birth = null;
        }

        $this->patientService->updatePatient($request, $patient);

        // $request->persist();
        session()->flash('message', 'Selected Patient Information has been Updated');
        return redirect()->route('patients.index');

    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */


    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function anyData(Request $request)
    {

        $branch_id = null;
        $patient_name = null;

        if ($request->branch_id != null) {

            $branch_id = $request->branch_id;


        }

        if ($request->patient_name != null) {

            $patient_name = $request->patient_name;


        }


        $page = $request->page;

        //     $search = Input::get('search');

        $bgColors = ['red', 'green'];
        $count = 0;
        $patients = $this->patientService->getAllPatient($branch_id, $page, $patient_name);

        // dd($patients);
        return view('partials.patient_modal', compact('patients', 'bgColors', 'count'));


    }


}
