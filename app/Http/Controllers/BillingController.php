<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Patient;
use App\Service\BillingService;
use App\Service\DiagnosisService;
use App\Service\GeneralService;
use App\Service\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class BillingController extends Controller
{

    /**
     * @var PatientService
     */
    private $patientService;
    /**
     * @var DiagnosisService
     */
    private $billingService;
    /**
     * @var GeneralService
     */
    private $generalService;

    function __construct(PatientService $patientService, BillingService $billingService, GeneralService $generalService)
    {
        $this->patientService = $patientService;
        $this->billingService = $billingService;
        $this->generalService = $generalService;
        $this->middleware('auth');
    }

    //
//    public function store(Patient $patient)
//    {
//
//        //Looping tTHroug the Data and Saving to The Datababe
//
//        $bill_title = Input::get('FeeName');
//        $amount = Input::get('Amount');
//        // $Date = (Carbon::parse(Input::get('BillDate'))->format('Y-m-d'));
//        //  $Date = Input::get('BillDate')->format('Y-m-d');
//
//        //$date = DateTime::createFromFormat('d/m/Y', Input::get('BillDate'));
//
//
//        $date = explode('/', Input::get('BillDate'));
//
//        $Date = date('Y-m-d', strtotime(implode('-', array_reverse($date))));
//
//        foreach ($bill_title as $key => $n) {
//            // $item = Item::find($bill_title[$key]);
//
//            $arrData[] = array(
//
//                'patient_id' => $patient->id,
//                'bill_title' => $bill_title[$key],
//                'qty' => 1,
//                'amount' => $amount[$key],
//                'user_id' => auth()->user()->id,
//                'date_received' => $Date
//
//            );
//
//        }
//
//        //   dd($arrData);
//        //  Billing::create($arrData);
//
//
//        // Billing::create($arrData);
//        DB::table('billings')->insert($arrData);
//
//
//        echo "<div class='alert alert-success'>Patient Bill Received and Saved</div>";
//    }


    public function billing($patient)
    {
        $patient = $this->patientService->getAPatient($patient);

        $prices = $this->billingService->diagnosisPrices();
        $sn = 0;
        return view('billings.diagnosis', compact('patient', 'prices', 'sn'));

    }

    public function storeBilling(Request $request)
    {
        if (!isset($request->price)) {
            return redirect()->back()->withErrors("Please add at least a charge name");
        }

        $prices = $request->price;
        $attributes = new Request();
        foreach ($prices as $key => $price) {
            //   dd($request->amount[$key]);
            if ($price == "on") {
                //The price is Selected

                $amount = $request->amount[$key];
                $discount = $request->discount[$key];
                $discount_type = $request->discount_type[$key];
//
                $attributes->date = $this->generalService->convertToSQLDDate($request->date);
                $attributes->patient_id = $request->patient_id;
                $attributes->price = $amount;
                $attributes->name = $request->price_name[$key];
                $attributes->qty = $request->qty[$key];


                $attributes->charged_by = auth()->user()->getAuthIdentifier();


                //  dd($attributes->discount);


                $attributes->discount = ($discount);

                $this->billingService->storePrices($attributes); //

                //Store in Billing
                $attributes->qty = 1;
                $attributes->title = $attributes->name;
                $attributes->amount = $amount;
                $attributes->user_id = auth()->user()->getAuthIdentifier();
                $attributes->discount = $discount;
                //  $this->billingService->storeBillings($attributes);

            }
        }


//        return view('billings.diagnosis', compact('patient', 'prices', 'sn'));

        session()->flash("message", "Patient Billing Stored");
        return redirect()->route("getinvoice", $request->patient_id);


    }


    public function editBilling($bill_date, $patient_id)
    {
        $patient = $this->patientService->getAPatient($patient_id);
        $prices = $this->billingService->getPatientDiagnosisBillByDate($patient_id, $bill_date);

        // $prices = $this->billingService->diagnosisPrices();
        $sn = 0;
        return view('billings.update_diagnosis', compact('patient', 'prices', 'sn'));

    }

    public function updateBilling(Request $request)
    {

        $prices = $request->price_id;


        $attributes = new Request();
        foreach ($prices as $key => $price) {
            //   dd($request->amount[$key]);

            //The price is Selected


            $discount = $request->discount[$key];
            $discount_type = $request->discount_type[$key];
            $price_id = $request->price_id[$key];


//


            $attributes->charged_by = auth()->user()->getAuthIdentifier();

            $attributes->discount = ($discount);
            $attributes->bill_id = $price_id;
            $this->billingService->updatePrices($attributes); //


        }


//        return view('billings.diagnosis', compact('patient', 'prices', 'sn'));

        session()->flash("message", "Patient Billing Updated");
        return redirect()->route("getinvoice", $request->patient_id);

    }
}
