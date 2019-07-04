<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Drug;
use App\DrugsPurchase;
use App\Patient;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class DrugAdministerController extends Controller
{
    //

    public function index(Patient $patient)
    {
        return view('drugs.administer', compact('patient'));
    }

    public function getdrugs(Request $request)
    {

        $DrugName = ($request->input('name_startsWith'));
        $BranchId = auth()->user()->branch_id;

        $drugs = DB::table('drugs')
            ->where('drugname', 'like', $DrugName . '%')
            ->where('branch_id', '=', $BranchId)
            ->limit(5)
            ->get();


        return json_encode($drugs);


    }

    public function store(Patient $patient)
    {

        $drugname = Input::get('itemName');
        $days = Input::get('days');
        $usage = Input::get('quantity');


//        if(count($drugname) <= 0){
//            return redirect()->route('administer',['id' => $patient->id])
//                ->withErrors('Error');
//         //   return redirect()->route('administer', ['id' => $patient->id]);
//        }

        $date = explode('/', Input::get('orderDate'));

        $Date = date('Y-m-d', strtotime(implode('-', array_reverse($date))));

        foreach ($drugname as $key => $n) {
            // $item = Item::find($bill_title[$key]);
            $Drug = DB::table('drugs')
                ->where('drugname', '=', $drugname[$key])
                ->orderBy('id', 'asc')
                ->get();

            $arrData[] = array(

                'patient_id' => $patient->id,
                'drug_id' => $Drug[0]->id,
                'days' => $days[$key],
                'user_id' => auth()->user()->id,
                'usage' => $usage[$key],
                'date_created' => $Date

            );

        }

        // dd($arrData);
        //  Billing::create($arrData);


        // Billing::create($arrData);
        DB::table('drug_administers')->insert($arrData);
        session()->flash('message', 'Patient Drug Administration Saved');
        return redirect()->route('administer', ['id' => $patient->id]);
    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public
    function getIndex()
    {
        return view('drugs.medication');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function anyData()
    {
        //  return Datatables::of(User::query())->make(true);

        // $drugs = DB::select(['id', 'drugname', 'qty', 'price'])->get();


        $Medication = DB::table('drug_administers')->select(
            'patient_id',
            DB::raw('COUNT(*) as medication'),
            DB::raw('(patients.name) as patientname'),
            DB::raw('(drug_administers.date_created) as date_created')
        )
            ->join('patients', 'drug_administers.patient_id', '=', 'patients.id')->groupBy('drug_administers.date_created')
            ->where('drug_administers.status', '=', 0)
            ->get();


        $start = 1;
        return Datatables::of($Medication)
            ->addColumn('action', function ($Medication) {
                return '<a href="/drugs/medication/' . $Medication->patient_id . '/' . $Medication->date_created . '" class="btn btn-xs btn-primary">
<i class="fa fa-pencil"></i> View </a> ';
            })
            ->addColumn('id', function ($Medication) use (&$start) {
                return $start++;
            })
            ->editColumn('date_created', function ($Medication) {
                return Carbon::createFromFormat('Y-m-d', $Medication->date_created)->format('d/m/Y');

            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function show($patient, $date_created)
    {

        $BranchId = auth()->user()->branch_id;

        $medications = DB::table('drug_administers')
            ->where('patient_id', '=', $patient)
            ->where('status', '=', 0)
            ->where('date_created', '=', $date_created)
            ->get();


        //  dd($medications);
        $patient = Patient::find($patient);
        //  $drug = Drug::find($medications[0]->drug_id);
        $user = User::findorfail($medications[0]->user_id);
        return view('drugs.patient', compact('medications', 'patient', 'user'));
    }


    public function storemedication($patient, $date_created)
    {
        $date = explode('/', Input::get('date_created'));

        $Date = date('Y-m-d', strtotime(implode('-', array_reverse($date))));


        //checking For the Quantity
        $drug_id = Input::get('drug_id');
        $qty = Input::get('qty');

        foreach ($drug_id as $key => $n) {
            //Get The Quantity Left in the Database
            $Drug = Drug::find($drug_id[$key]);
            $QtyLeft = intval($Drug->qty) - intval($qty[$key]);
            if ($QtyLeft < 0) {

                $Error = "Only $Drug->qty is left for $Drug->drugname, You can not request more than the quantity left";
                return redirect()->route('showmedication', ['id' => $patient, 'date_created' => $date_created])->withErrors($Error);
                break;
            }
        }


        foreach ($drug_id as $key => $n) {
            //Get The Quantity Left in the Database

            $QuantityRequired = ($qty[$key]);
            $DrugID = ($drug_id[$key]);
            $Drug = Drug::find($DrugID);

            // $QtyLeft = intval($Drug->qty) - intval($QuantityRequired);

            //Updating the Drug Table
            $query = DB::table('drugs')
                ->where('id', $DrugID);

            $query->decrement('qty', $QuantityRequired); // Decrementing the Drug Quantity from the Database


            //Updating the Medication status
            DB::table('drug_administers')
                ->where('drug_id', $DrugID)
                ->where('patient_id', $patient)
                ->where('date_created', $date_created)
                ->update(['status' => 1]);


            //Add to Patient Drug Purchases
            DrugsPurchase::create(
                [
                    'patient_id' => $patient,
                    'qty' => $QuantityRequired,
                    'price' => $Drug->price,
                    'drug_id' => $DrugID,
                    'user_id' => auth()->user()->id,
                ]
            );


            //Updating the Customer Bill
//            Billing::create(
//                [
//                    'patient_id' => $patient,
//                    'bill_title' => $Drug->drugname,
//                    'qty' => $QuantityRequired,
//                    'amount' => $Drug->price,
//                    'drug_id' => $DrugID,
//                    'user_id' => auth()->user()->id,
//                    'date_received' => $Date
//
//
//                ]);

        }


        session()->flash('message', 'Patient Medication Successfully Processed');

        return redirect()->route('medication');

        //dd(Input::get());
    }

}
