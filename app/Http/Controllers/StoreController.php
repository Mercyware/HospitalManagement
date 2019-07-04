<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Store;
use App\StoreHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function create()
    {
        $branches = Branch::all();
        return view('store.create', compact('branches'));
    }


    public function store()
    {
        $this->validate(request(), [
            'productname' => 'required',
            'qty' => 'required|numeric',
            'branch' => 'required|numeric'

        ]);

        $BranchId = Input::get('branch');


        $results = DB::table('stores')
            ->where('product', Input::get('productname'))
            ->where('branch_id', $BranchId)
            ->get();

        //dd($query);

        if ($results->isEmpty()) {
            // user found
            $Store = Store::create([
                'product' => request('productname'),
                'qty' => request('qty'),
                'branch_id' => $BranchId
            ]);

            $Store_ID = $Store->id;
            // Add to Product History

            StoreHistory::create([
                'store_id' => $Store_ID,
                'operation' => 1,
                'qty' => request('qty'),
                'user_id' => auth()->user()->id,
                'reason' => 'Newly Stocked'

            ]);
            session()->flash('message', 'New Product Added to Store');
            return redirect()->route('createproduct');
        } else {
            $Error = "This Product Name Already Existed for the Branch";
            return redirect()->route('createproduct')->withErrors($Error);


        }
    }


    public function view()
    {
        $branches = Branch::all();
        return view('store.welcome', compact('branches'));
    }


    public function anyData(Request $request)
    {
        //  DB::enableQueryLog();

        // dd($request->branch);
        $items = Store::select(['id', 'product', 'qty']);

        if ($request->stocklevel != null) {
            if ($request->stocklevel == 1) { //Out of Stock
                $items->where('qty', '<=', 5);
            }

        }
        if ($request->branch != null) {

            $BranchId = $request->branch;
            $items->where('branch_id', $BranchId);

        }


        $items->get();

        //  dd(DB::getQueryLog());
        $start = 1;
        return Datatables::of($items)
            ->addColumn('action', function ($items) {
                return ' <a href="#" class="btn btn-xs btn-primary" id="' . $items->id . '" data-toggle="modal" data-target="#itemModal"> <i
                            class="fa fa-hand-o-down" ></i >Use</a > <a href = "/store/update/' . $items->id . '" class="btn btn-xs btn-warning" >
<i class="fa fa-pencil" ></i > Update </a > ';
            })
            ->addColumn('id', function ($items) use (&$start) {
                return $start++;
            })
            // ->removeColumn('password')
            ->make(true);

    }

    public function show($item)
    {
        $branches = Branch::all();
        $item = Store::findorfail($item);
        return view('store.update', compact('branches', 'item'));

    }


    public function update($item)
    {
        $this->validate(request(), [
            'productname' => 'required',
            'qty' => 'required | numeric',
            'branch' => 'required | numeric'

        ]);


        $Operation = 0;

        //Updating the Medication status
        $query = DB::table('stores')
            ->where('id', $item);

        if (request('operation') == 0) {
            $query->update([
                'product' => Input::get('productname'),

            ]);
            $Operation = 0;
        } elseif (request('operation') == 1) {
            $query->increment('qty', Input::get('qty'), [
                'product' => Input::get('productname'),


            ]);
            $Operation = 1;
        } elseif (request('operation') == 2) {
            $query->decrement('qty', Input::get('qty'), [
                'product' => Input::get('productname'),


            ]);

            $Operation = 2;
        }


        StoreHistory::create([
            'store_id' => $item,
            'operation' => $Operation,
            'qty' => request('qty'),
            'user_id' => auth()->user()->id,
            'reason' => request('reason'),


        ]);

        session()->flash('message', ' Product Information Updated');
        return redirect()->route('updateproduct', ['item' => $item]);
    }





}
