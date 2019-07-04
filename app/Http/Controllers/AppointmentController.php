<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Authorizable;
use App\Branch;
use App\Patient;

use App\Service\AppointmentService;
use App\Service\BranchService;
use App\Service\GeneralService;
use App\Service\PatientService;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AppointmentController extends Controller
{

    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var BranchService
     */
    private $branchService;
    /**
     * @var AppointmentRepository
     */
    private $appointmentService;
    /**
     * @var GeneralService
     */
    private $generalService;

    public function __construct(PatientService $patientService, BranchService $branchService,
                                AppointmentService $appointmentService,
                                GeneralService $generalService)
    {
        $this->patientService = $patientService;
        $this->branchService = $branchService;
        $this->appointmentService = $appointmentService;
        $this->generalService = $generalService;
        $this->middleware('auth');
    }
    //
    //   use Authorizable;

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex($patient)
    {
        $patient = $this->patientService->getAPatient($patient);
        return view('appointment.welcome', compact('patient'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function anyData(Request $request)
    {
        //dd($request->patient);
        $start = 1;
        $appointment = $this->appointmentService->getPatientAppointments($request->patient);

        return Datatables::of($appointment)
            ->addColumn('action', function ($appointment) {
                return '<a href="/appointment/view/' . $appointment->id . '" class="btn btn-xs btn-primary">
<i class="fa fa-eye"></i> View </a> ';
            })
            ->addColumn('id', function ($appointment) use (&$start) {
                return $start++;
            })
            ->editColumn('appointment_date', function ($appointment) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $appointment->appointment_date)->format('d/m/Y H:i:s');
            })
            ->editColumn('scheduled', function ($appointment) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $appointment->created_at)->format('d/m/Y ');
            })
            ->editColumn('user', function ($appointment) {
                return $appointment->doctor->name;
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function create($patient)
    {

        // dd(Input::get());
        //  $id = 1;

        $patient = $this->patientService->getAPatient($patient);
        $users = User::all();
        $branches = $this->branchService->getAllBranches();
        return view('appointment.create', compact('patient', 'users', 'branches'));
    }


    public function store($patient, Request $request)
    {
        $this->validate($request,
            [
                'appointment_date' => 'required',
                'user' => 'required',
                'branch' => 'required',
            ]);


        $appointment_date = $this->generalService->convertToSQLDDateTime($request->appointment_date);
        $request->appointment_date = $appointment_date;
        //dd($dateToBeInserted);
        $appointment = $this->appointmentService->createAppointment($patient, $request);

        // $patient = Patient::findorfail($patient);

        // $request->persist();
        session()->flash('message', 'New Appointment Created For  ' . $appointment->patient->name);
        return redirect('/appointment/' . $appointment->patient->id);

        // return view(', compact('patient', 'users', 'branches'));

    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getAppoint()
    {

        $branches = $this->branchService->getAllBranches();
        //dd('aa');
        return view('appointment.appointments', compact('branches'));
    }


    public function getAppointData(Request $request)
    {


        //DB::enableQueryLog();


        // dd($AppoitmentDate);
        $start = 1;

        $appointmentDate = null;
        $branch_id = null;

        //  $appointment = DB::table('appointments');

        if ($request->branch != null) {
            //$appointment->where('branch_id', '=', $request->branch);
            $branch_id = $request->branch;
        }

        if ($request->appointdate != null) {
            $appointmentDate = $this->generalService->convertToSQLDDate($request->appointdate);
//            $var = $request->appointdate;
//            $date = str_replace('/', '-', $var);
//            $AppoitmentDate = date('Y-m-d', strtotime($date));
//            $appointment->whereDate('appointment_date', '=', $AppoitmentDate);
        }


//        $appointment->orderBy('id', 'desc')
//            ->get();


        $appointment = $this->appointmentService->allAppointments($branch_id, $appointmentDate);


        //  dd($appointment);
        // dd(DB::getQueryLog());
        return Datatables::of($appointment)
            ->addColumn('action', function ($appointment) {
                return '<a href="/appointment/view/' . $appointment->id . '" class="btn btn-xs btn-primary">
<i class="fa fa-eye"></i> View </a> ';
            })
            ->addColumn('id', function ($appointment) use (&$start) {
                return $start++;
            })
            ->editColumn('appointment_date', function ($appointment) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $appointment->appointment_date)->format('d/m/Y H:i:s');
            })
            ->editColumn('scheduled', function ($appointment) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $appointment->created_at)->format('d/m/Y');
            })
            ->editColumn('user', function ($appointment) {
                return $appointment->doctor->name;
            })
            ->editColumn('patient', function ($appointment) {
                return $appointment->patient->name;
            })
            // ->removeColumn('password')
            ->make(true);

    }

    public function view_appointment(Appointment $appointment)
    {

//        $patient =$this->patientService->getAPatient($appointment->patient_id);
//        $user = User::findorfail($appointment->user_id);
//        $doctor = User::findorfail($appointment->doc_id);
//        $branch = Branch::findorfail($appointment->branch_id);

        return view('appointment.view', compact('appointment'));
    }

    public function confirm($appointment)
    {
        $this->appointmentService->confirmAppointment($appointment);

        session()->flash('message', ' Patient Appointment Confirmed');
        return redirect()->route('appointmentview', ['appointment' => $appointment]);
    }


    public function cancel($appointment)
    {

        $this->appointmentService->cancelAppointment($appointment);

        session()->flash('message', ' Patient Appointment Canceled');
        return redirect()->route('appointmentview', ['appointment' => $appointment]);
    }


    public function delete($appointment)
    {

        $this->appointmentService->deleteAppointment($appointment);


        session()->flash('message', ' Patient Appointment Deleted');
        return redirect()->route('allappointment');
    }


    public function update2(Appointment $appointment)
    {
        $users = User::all();
        $branches =$this->branchService->getAllBranches();

        return view('appointment.update', compact( 'users', 'branches', 'appointment'));
    }

    public function updatestore($appointment)
    {

        $this->validate(\request(),
            [
                'appointment_date' => 'required',
                'user' => 'required',
                'branch' => 'required',
            ]);

        //  $appointment_date = explode('/', request('appointment_date'));


        //  $appointment_date = Carbon::parse(date_format($appointment_date, 'd/m/Y H:i:s'), 'd/m/Y H:i:s');


        $appointment_date = request('appointment_date');
        $appointment_date = (date_format(date_create($appointment_date), 'Y-m-d H:i:s'));


        //Updating the Medication status
        $update = DB::table('appointments')
            ->where('id', $appointment)
            ->update([
                'appointment_date' => $appointment_date,
                'branch_id' => request('branch'),
                'doc_id' => request('user'),
            ]);


        session()->flash('message', ' Patient Appointment Updated');
        return redirect()->route('appointmentupdate', ['appointment' => $appointment]);
    }


}
