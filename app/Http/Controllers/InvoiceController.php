<?php

namespace App\Http\Controllers;

use App\DiagnosisBill;
use App\Patient;
use App\Service\BillingService;
use App\Service\CompanyService;
use App\Service\DiagnosticService;
use App\Service\LaboratoryService;
use App\Service\PatientService;
use App\Service\PaymentService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class InvoiceController extends Controller
{

    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * @var PaymentService
     */
    private $paymentService;
    /**
     * @var BillingService
     */
    private $billingService;
    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var DiagnosticService
     */
    private $diagnosticService;
    /**
     * @var LaboratoryService
     */
    private $laboratoryService;

    public function __construct(CompanyService $companyService,
                                PaymentService $paymentService,
                                BillingService $billingService,
                                PatientService $patientService, DiagnosticService $diagnosticService, LaboratoryService $laboratoryService)
    {
        $this->middleware('auth');
        $this->companyService = $companyService;
        $this->paymentService = $paymentService;
        $this->billingService = $billingService;
        $this->patientService = $patientService;
        $this->diagnosticService = $diagnosticService;
        $this->laboratoryService = $laboratoryService;
    }

    public function getAdvanceFilter()
    {
        return view('invoice.welcome');
    }


    public function getinvoice(Patient $patient)
    {
        $company = $this->companyService->getACompany();

        //Diagnosis or Medical Care
        $diagnosisBills = $this->billingService->getPatientDiagnosisBilSumTotal($patient->id); //Get All Diagnosis Bills
        $diagnosisPayment = $this->paymentService->getPatientDiagnosisPaymentSumTotal($patient->id);  //Get All Diagnosis Payent


        //Diagnostic
        $diagnosticBills = $this->diagnosticService->getPatientDiagnosticPaymentSumTotal($patient->id);
        $diagnosticPayment = $this->paymentService->getADiagnosticPaymentByPatient($patient->id);  //Get All Diagnosis Payent


        //Laboratory
        $laboratoryBills = $this->laboratoryService->getPatientDiagnosticPaymentSumTotal($patient->id);
        $laboratoryPayment = $this->paymentService->getLaboratoryPaymentByPatient($patient->id);

        return view('invoice.invoice', compact('patient', 'company', 'diagnosisPayment', 'diagnosisBills',
            'diagnosticBills', 'diagnosticPayment', 'laboratoryBills', 'laboratoryPayment'));

    }


    public function makepayment(Patient $patient, $date_received)
    {
        return view('invoice.makepayment', compact('patient', 'date_received'));

    }


    //============= Patient Diagnosis Invoice =====================//
    public function diagnosisInvoice($patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);
        return view('invoice.diagnosis.patient_bill', compact('patient'));
    }

    public function diagnosisInvoiceData(Request $request, $patient_id)
    {
        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $branch_id = null;

        if ($request->branch != null) {

            $branch_id = $request->branch;


        }
        $start = 1;
        $bills = $this->billingService->getPatientDiagnosisBills($patient_id);
        $totalPrice = 0;
        $paid = 0;


        return Datatables::of($bills)
//            ->addColumn('action', function ($patients) {
//                $patient = $patients->id;
//                return view('shared._actions', compact('patient'));
//            })
            ->editColumn('id', function ($bills) use (&$start) {
                return $start++;
            })
            ->editColumn('date', function ($bills) {
                return $bills->date;
            })
            ->editColumn('name', function ($bills) {


                return $bills->name;
            })
            ->editColumn('amount', function ($bills) {
                $price = $bills->price * $bills->qty;
                $discount = $bills->discount;

                $totalPrice = $price + $discount;

                return number_format($totalPrice);
            })
            ->addColumn('action', function ($bills) {


                return ' <a href="/patient/billing/' . $bills->date . '/' . $bills->patient_id . '/edit" class="btn btn-primary">Edit Invoice</a>';
            })
            // ->removeColumn('password')
            ->make(true);

    }


    //Diagnostic -- 3
    public function diagnosticInvoice($patient_id)
    {

        $patient = $this->patientService->getAPatient($patient_id);

        return view('invoice.diagnostic.patient_bill', compact('patient'));
    }

    public function diagnosticInvoiceData(Request $request, $patient_id)
    {
        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $branch_id = null;

        if ($request->branch != null) {

            $branch_id = $request->branch;


        }
        $start = 1;
        $bills = $this->diagnosticService->getADiagnosticResultByPatient($patient_id);


        return Datatables::of($bills)
            ->editColumn('id', function ($bills) use (&$start) {
                return $start++;
            })
            ->editColumn('date', function ($bills) {
                return $bills->date;
            })
            ->editColumn('name', function ($bills) {


                return $bills->diagnostic->name;
            })
            ->editColumn('amount', function ($bills) {
                $price = $bills->price;
                $discount = $bills->discount;

                $totalPrice = $price + $discount;


                return number_format($totalPrice);
            })
//            ->addColumn('action', function ($bills) {
//
//                return '  <a href="/invoice/makepayment/' . $bills->patient_id . '/' . $bills->id . '/3" class="btn btn-success">Make Payment</a>';
//            })
            // ->removeColumn('password')
            ->make(true);

    }


    //laboratory -- 3
    public function laboratoryInvoice($patient_id)
    {

        $patient = $this->patientService->getAPatient($patient_id);

        return view('invoice.laboratory.patient_bill', compact('patient'));
    }

    public function laboratoryInvoiceData(Request $request, $patient_id)
    {
        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $branch_id = null;

        if ($request->branch != null) {

            $branch_id = $request->branch;


        }
        $start = 1;
        $bills = $this->laboratoryService->getALaboratoryResultByPatient($patient_id);


        return Datatables::of($bills)
//            ->addColumn('action', function ($patients) {
//                $patient = $patients->id;
//                return view('shared._actions', compact('patient'));
//            })
            ->editColumn('id', function ($bills) use (&$start) {
                return $start++;
            })
            ->editColumn('date', function ($bills) {
                return $bills->date;
            })
            ->editColumn('name', function ($bills) {


                return $bills->tests->name;
            })
            ->editColumn('amount', function ($bills) {
                $price = $bills->price;
                $discount = $bills->discount;

                $totalPrice = $price + $discount;

                return number_format($totalPrice);
            })
            ->addColumn('action', function ($bills) {

                return '  <a href="/invoice/makepayment/' . $bills->patient_id . '/' . $bills->id . '/2" class="btn btn-success">Make Payment</a>';
            })
            // ->removeColumn('password')
            ->make(true);

    }


}
