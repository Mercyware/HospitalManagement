<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Patient;
use App\Payment;
use App\Service\BillingService;
use App\Service\BranchService;
use App\Service\CompanyService;
use App\Service\DiagnosticService;
use App\Service\GeneralService;
use App\Service\LaboratoryService;
use App\Service\PatientService;
use App\Service\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class PaymentController extends Controller
{
    //

    /**
     * @var CompanyService
     */
    private $companyService;
    /**
     * @var PaymentService
     */
    private $paymentService;
    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var GeneralService
     */
    private $generalService;
    /**
     * @var BillingService
     */
    private $billingService;
    /**
     * @var BranchService
     */
    private $branchService;
    /**
     * @var LaboratoryService
     */
    private $laboratoryService;
    /**
     * @var DiagnosticService
     */
    private $diagnosticService;

    public function __construct(CompanyService $companyService, PaymentService $paymentService,
                                PatientService $patientService, GeneralService $generalService,
                                BillingService $billingService, BranchService $branchService, LaboratoryService $laboratoryService, DiagnosticService $diagnosticService)
    {
        $this->middleware('auth');
        $this->companyService = $companyService;
        $this->paymentService = $paymentService;
        $this->patientService = $patientService;
        $this->generalService = $generalService;
        $this->billingService = $billingService;
        $this->branchService = $branchService;
        $this->laboratoryService = $laboratoryService;
        $this->diagnosticService = $diagnosticService;
    }


    /** Diagnosis Payment */

    /**
     * @param $patient_id
     * @param $invoice_id
     * @param $invoice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makePayment($patient_id, $invoice)
    {


        $patientBill = 0;
        $patientPayment = 0;  //Get All Diagnosis Payent

        //TODO : Check that the user owns the bill
        $patient = $this->patientService->getAPatient($patient_id);

        //Parsing Back Patient Prices

        //Diagnosis Payment
        if ($invoice == 1) {
            //Diagnosis or Medical Care
            $patientBill = $this->billingService->getPatientDiagnosisBilSumTotal($patient->id)->sum('totalPrice'); //Get All Diagnosis Bills
            $patientPayment = $this->paymentService->getPatientDiagnosisPaymentSumTotal($patient->id)->sum('amount');  //Get All Diagnosis Payent


        } elseif ($invoice == 2) { //Laboaratory


            //Laboratory
            $patientBill = $this->laboratoryService->getPatientDiagnosticPaymentSumTotal($patient->id)->sum('price');
            $patientPayment = $this->paymentService->getLaboratoryPaymentByPatient($patient->id)->sum('amount');;
        } elseif ($invoice == 3) { //Diagnostic
            //Diagnostic
            $patientBill = $this->diagnosticService->getPatientDiagnosticPaymentSumTotal($patient->id)->sum('price');;
            $patientPayment = $this->paymentService->getADiagnosticPaymentByPatient($patient->id)->sum('amount');;  //Get All Diagnosis Payent

        }


        /** @var TYPE_NAME $branches */

        $outstanding = $patientBill - $patientPayment;
        $branches = $this->branchService->getAllBranches();
        return view('payment.create', compact('patient', 'invoice', 'branches', 'outstanding'));

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makePaymentSubmit(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'patient_id' => 'required|numeric',
            'pay_type' => 'required',
            'amount' => 'required|numeric'
        ]);

        /** @var TYPE_NAME $this */
        $date = $this->generalService->convertToSQLDDate($request->date);
        $request->collected_by = auth()->user()->getAuthIdentifier();
        $request->date = $date;


        //Diagnosis Payment
        if ($request->invoice == 1) {
            $patientBill = $this->billingService->getPatientDiagnosisBilSumTotal($request->patient_id)->sum('totalPrice'); //Get All Diagnosis Bills
            $patientPayment = $this->paymentService->getPatientDiagnosisPaymentSumTotal($request->patient_id)->sum('amount');  //Get All Diagnosis Payent
            $outstanding = $patientBill - $patientPayment;
            if (intval($request->amount) > $outstanding) {

                return redirect()->back()->withErrors(["Amount payed is more than outstanding total"]);
            }

            //Get The Payment Information
            $this->paymentService->storeDiagnosisPayment($request);
        } elseif ($request->invoice == 2) { //Laboaratory
            $patientBill = $this->laboratoryService->getPatientDiagnosticPaymentSumTotal($request->patient_id)->sum('price');
            $patientPayment = $this->paymentService->getLaboratoryPaymentByPatient($request->patient_id)->sum('amount');;

            $outstanding = $patientBill - $patientPayment;
            if (intval($request->amount) > $outstanding) {

                return redirect()->back()->withErrors(["Amount payed is more than outstanding total"]);
            }

            $request->laboratory_id = $request->invoice_id;
            $this->paymentService->storeLaboratoryPayment($request);

        } elseif ($request->invoice == 3) { //Diagnostic

            $patientBill = $this->diagnosticService->getPatientDiagnosticPaymentSumTotal($request->patient_id)->sum('price');;
            $patientPayment = $this->paymentService->getADiagnosticPaymentByPatient($request->patient_id)->sum('amount');;  //Get All Diagnosis Payent
            $outstanding = $patientBill - $patientPayment;
            if (intval($request->amount) > $outstanding) {

                return redirect()->back()->withErrors(["Amount payed is more than outstanding total"]);
            }

            $this->paymentService->storeDiagnosticPayment($request);
        }


        session()->flash('message', 'Patient Payment Received');
        return redirect()->route('invoiceshow', [$date, $request->patient_id]);

    }


    public function invoiceShow($date, $patient_id)
    {


        $patient = $this->patientService->getAPatient($patient_id);
        $diagnosisPays = $this->paymentService->getPatientDiagnosisPaymentByDate($date, $patient_id);
        $diagnosticPays = $this->paymentService->getPatientDiagnosticPaymentByDate($date, $patient_id);
        $laboratoryPays = $this->paymentService->getPatientLaboratoryPaymentByDate($date, $patient_id);
        $company = $this->companyService->getACompany();

        // $getbranch = Branch::find($mybills[0]->branch_id);


        return view('invoice.view', compact('patient', 'date', 'company', 'diagnosisPays', 'diagnosticPays', 'laboratoryPays'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDiagnosisPayment(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'patient_id' => 'required|numeric',
            'pay_type' => 'required',
            'amount' => 'required|numeric'
        ]);

        // Storing the Payment into the Database now

        $diagnosis_payment = $this->paymentService->storeDiagnosisPayment($request);

        session()->flash('message', 'Patient Payment Received');
        return redirect()->route('invoiceshow', $diagnosis_payment->id);


    }


    public function showPayment($patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);
        return view('payment.allPayments', compact('patient'));
    }

    public function showPaymentData(Request $request)
    {
        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $start = 1;
        $payments = $this->paymentService->getPatientDiagnosisPayment($request->patient_id);


        return Datatables::of($payments)
//            ->addColumn('action', function ($patients) {
//                $patient = $patients->id;
//                return view('shared._actions', compact('patient'));
//            })
            ->editColumn('id', function ($payments) use (&$start) {
                return $start++;
            })
            ->editColumn('date', function ($payments) {
                return $payments->date;
            })

            ->editColumn('amount', function ($payments) {


                return number_format($payments->amount);
            })
            ->make(true);

    }
}
