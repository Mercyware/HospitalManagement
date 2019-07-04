<?php

namespace App\Http\Controllers;

use App\Branch;
use App\DiagnosisPayment;
use App\Patient;
use App\Service\DiagnosisService;
use App\Service\DiagnosticService;
use App\Service\LaboratoryService;
use App\Service\PaymentService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AccountsController extends Controller
{


    /**
     * @var PaymentService
     */
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {

        $this->paymentService = $paymentService;
        $this->middleware('auth');

    }

    //
    public function getIndex()
    {
        $branches = Branch::all();
        return view('account.welcome', compact('branches'));
    }

    public function anyData(Request $request)
    {
        $branch_id = null;
        $start_date = null;
        $end_date = null;
        $account_type = null;

        if ($request->branch && $request->branch != null) {
            $branch_id = $request->branch;
        }

        if ($request->fromdate && $request->fromdate != null) {
            $start_date = $request->fromdate;
            $end_date = $request->todate;

        }

        if ($request->account_type && $request->account_type != null) {
            $account_type = $request->account_type;
        }

        if ($account_type == 2) {
            //Diagnostic
            $account = $this->paymentService->getDiagnosticPayment($branch_id, $start_date, $end_date);
        } elseif ($account_type == 3) {
            $account = $this->paymentService->getLaboratoryPayment($branch_id, $start_date, $end_date);
        } else {
            $account = $this->paymentService->getDiagnosisPayment($branch_id, $start_date, $end_date);
        }





        $start = 1;
        return Datatables::of($account)
            ->addColumn('id', function ($account) use (&$start) {
                return $start++;
            })
            ->editColumn('date_received', function ($account) {
                return Carbon::createFromFormat('Y-m-d', $account->date)->format('d/m/Y');

            })
            ->editColumn('name', function ($account) {
                return Patient::find($account->patient_id)->name;

            })
            ->editColumn('amount', function ($account) {
                return number_format($account->amount);

            })
            ->editColumn('user_id', function ($account) {
                return User::find($account->collected_by)->name;

            })
            // ->removeColumn('password')
            ->make(true);

    }

}
