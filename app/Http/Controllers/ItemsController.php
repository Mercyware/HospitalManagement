<?php

namespace App\Http\Controllers;

use App\Items;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view($item)
    {
        $item = Store::findorfail($item);
        return view('partials.modal', compact('item'));


    }

    public function store(Request $request)
    {


        $this->validate(request(), [
            'store_id' => 'required',
            'qty' => 'required|numeric',
        ]);

        //    dd($request->qty);
        //Checking iif there is enough Quantity in the Database
        $Item = DB::table('stores')
            ->where('qty', '>=', $request->qty)
            ->where('id', $request->store_id)
            ->get();


        if (!$Item->isEmpty()) {
            $Store = Items::create([
                'store_id' => $request->store_id,
                'qty' => $request->qty,
                'user_id' => auth()->user()->id,
                'description' => $request->description,
            ]);

            //Updating the Store
            $query = DB::table('stores')
                ->where('id', $request->store_id)
                ->decrement('qty', $request->qty);

            session()->flash('message', ' Selected Item Deducted from the Store');
            return redirect()->route('store');
        } else {
            $Error = " You cannot get up to the Selected Quantity";
            return redirect()->route('store')->withErrors($Error);
        }

        //exit;

    }
}
