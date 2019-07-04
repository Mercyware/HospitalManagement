<?php

namespace App\Http\Controllers;

use App\Service\BillingService;
use App\Service\DiagnosisService;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DiagnosisPricesController extends Controller
{
    //

    /**
     * @var DiagnosisService
     */
    private $billingService;

    function __construct(BillingService $billingService)
    {
        $this->middleware('auth');
        $this->billingService = $billingService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pricing.diagnosis.welcome');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function indexData(Request $request)
    {

        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $bloodGroups = $this->billingService->diagnosisPrices();

        //  dd($patients);


        return Datatables::of($bloodGroups)
            ->addColumn('action', function ($bloodGroups) {

                return '<a href="/blood/bank/edit/' . $bloodGroups->id . '" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Edit </a>';
            })
            ->editColumn('id', function ($bloodGroups) {
                return sprintf('%03d', $bloodGroups->id);
            })
            // ->removeColumn('password')
            ->make(true);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createDiagnosis()
    {
        return view('pricing.diagnosis.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeDiagnosisPrice(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2|unique:diagnosis_prices,name',
                'price' => 'required|numeric',
            ]
        );


        $this->billingService->createDiagnosisPrice($request);

        session()->flash('message', 'New Diagnosis Price Added');
        return redirect()->route('pricing.diagnosis.price');
    }
}
