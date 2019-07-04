<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Drug;
use App\Drugs_History;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use Yajra\Datatables\Datatables;

class DrugController extends Controller
{
    //
    public function index()
    {
        return view('drugs.welcome');
    }

    public function create()
    {
        $branches = Branch::all();

        return view('drugs.create', compact('branches'));
    }

    public function store()


    {
        $this->validate(\request(), [
            'drugname' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'branch' => 'required|numeric'
        ]);


        $BranchId = Input::get('branch');


        $results = DB::table('drugs')
            ->where('drugname', Input::get('drugname'))
            ->where('branch_id', $BranchId)
            ->get();

        //dd($query);

        if ($results->isEmpty()) {
            // user found
            $drug = Drug::create([
                'drugname' => \request('drugname'),
                'qty' => \request('qty'),
                'price' => \request('price'),
                'branch_id' => $BranchId
            ]);


            $drug_id = $drug->id;

// 1 is adding Pproduct to the Database
            Drugs_History::create([
                'drug_id' => $drug_id,
                'operation' => 1,
                'qty' => request('qty'),
                'user_id' => auth()->user()->id,
                'reason' => 'Newly Stocked'

            ]);

            session()->flash('message', 'New Drug Added');
            return redirect()->route('createdrug');
        } else {
            $Error = "This DrugName Already Existed for the Branch";
            return redirect()->route('createdrug')->withErrors($Error);


        }


    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {

        return view('drugs.welcome');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(Request $request)
    {
        //  return Datatables::of(User::query())->make(true);


        //  dd($request->stocklevel);

        $BranchId = auth()->user()->branch_id;
        $drugs = Drug::select(['id', 'drugname', 'qty', 'price']);

        if ($request->stocklevel != null) {
            if ($request->stocklevel == 1) { //Out of Stock
                $drugs->where('qty', '<=', 5);
            }

        }

        $drugs->where('branch_id', $BranchId)
            ->get();


        $start = 1;
        return Datatables::of($drugs)
            ->addColumn('action', function ($drugs) {
                return '<a href="drugs/update/' . $drugs->id . '" class="btn btn-xs btn-warning">
<i class="fa fa-pencil"></i> Update </a>';
            })
            ->editColumn('price', function ($drugs) {
                return number_format($drugs->price);
            })
            ->addColumn('id', function ($drugs) use (&$start) {
                return $start++;
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function drugupdate(Drug $drug)
    {
        return view('drugs.update', compact('drug'));
    }


    public function storeupdate($drug, Request $request)
    {


        $this->validate(request(), [
            'drugname' => 'required',
            'qty' => 'required | numeric',
            'price' => 'required | numeric',


        ]);
        //Updating the Medication status
        $query = DB::table('drugs')
            ->where('id', $drug);


        $Operation = 0;

        if (request('operation') == 0) {
            $query->update([
                'drugname' => Input::get('drugname'),
                'price' => Input::get('price')
            ]);
            $Operation = 0;
        } elseif (request('operation') == 1) {
            $query->increment('qty', Input::get('qty'), [
                'drugname' => Input::get('drugname'),
                'price' => Input::get('price'),


            ]);
            $Operation = 1;
        } elseif (request('operation') == 2) {
            $query->decrement('qty', Input::get('qty'), [
                'drugname' => Input::get('drugname'),
                'price' => Input::get('price'),

            ]);

            $Operation = 2;
        }


        Drugs_History::create([
            'drug_id' => $drug,
            'operation' => $Operation,
            'qty' => request('qty'),
            'user_id' => auth()->user()->id,
            'reason' => 'Newly Stocked'


        ]);

        //    $query->decrement('qty', ); // Decrementing the Drug Quantity from the Database


        session()->flash('message', ' Drug Information Updated');
        return redirect()->route('updatedrug', ['drug' => $drug]);
    }


    public function history()
    {
        $branches = Branch::all();

        return view('drugs.history', compact('branches'));

    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function histories(Request $request)
    {
        //  return Datatables::of(User::query())->make(true);


        //  dd($request->stocklevel);

        // $BranchId = auth()->user()->branch_id;
//        $drugs = Drugs_History::select(['id', 'drug_id', 'qty', 'operation', 'created_at']);
//
//
//        //$drugs->where('branch_id', $BranchId)
//        $drugs->get();


        $drugs = DB::table('drugs__histories')
            ->join('drugs', 'drugs.id', '=', 'drugs__histories.drug_id');

        if ($request->branch != null) {
            $BranchID = $request->branch;
            $drugs->where('drugs.branch_id', $BranchID);


        }

        $drugs->select('drugs.drugname', 'drugs.branch_id', 'drugs__histories.*')
            ->get();


        $start = 1;
        return Datatables::of($drugs)
            ->addColumn('id', function ($drugs) use (&$start) {
                return $start++;
            })
            ->editColumn('user', function ($drugs) {
                return (User::findorfail($drugs->user_id)->name);
            })
            ->editColumn('date', function ($drugs) {
                return (date('d/m/Y H:i:s', strtotime($drugs->created_at)));
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function report()
    {
        $branches = Branch::all();

        return view('drugs.reports', compact('branches'));

    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reports(Request $request)
    {
        //  return Datatables::of(User::query())->make(true);


        //  dd($request->stocklevel);

        // $BranchId = auth()->user()->branch_id;
//        $drugs = Drugs_History::select(['id', 'drug_id', 'qty', 'operation', 'created_at']);
//
//
//        //$drugs->where('branch_id', $BranchId)
//        $drugs->get();


        $drugs = DB::table('drugs_purchases')
            ->join('drugs', 'drugs.id', '=', 'drugs_purchases.drug_id');

        if ($request->branch != null) {
            $BranchID = $request->branch;
            $drugs->where('drugs.branch_id', $BranchID);


        }


        if ($request->fromdate && $request->fromdate != null) {


            $fromdate = \DateTime::createFromFormat('d/m/Y', $request->fromdate);
            $fromdate = $fromdate->format('Y-m-d');

            $todate = \DateTime::createFromFormat('d/m/Y', $request->todate);
            $todate = $todate->format('Y-m-d');
            $drugs->whereBetween('drugs_purchases.created_at', [date('Y-m-d', strtotime($fromdate)), date('Y-m-d', strtotime($todate))]);
        }

        $drugs->select('drugs.drugname', 'drugs.branch_id', 'drugs_purchases.*')
            ->get();


        $start = 1;
        return Datatables::of($drugs)
            ->addColumn('id', function ($drugs) use (&$start) {
                return $start++;
            })
            ->editColumn('patient', function ($drugs) {
                return (Patient::findorfail($drugs->patient_id)->name);
            })
            ->editColumn('user', function ($drugs) {
                return (User::findorfail($drugs->user_id)->name);
            })
            ->editColumn('tprice', function ($drugs) {
                return number_format($drugs->qty * $drugs->price);
            })
            ->editColumn('date', function ($drugs) {
                return (date('d/m/Y H:i:s', strtotime($drugs->created_at)));
            })
            // ->removeColumn('password')
            ->make(true);

    }


}
