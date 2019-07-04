<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Expenses;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ExpensesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $branches = Branch::all();
        return view('expenses.welcome', compact('branches'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(Request $request)
    {
        //  return Datatables::of(User::query())->make(true);

        // $drugs = DB::select(['id', 'drugname', 'qty', 'price'])->get();

        // $fromdate = request('fromdate');


        //   dd( $request->fromdate);
        $query = DB::table('expenses');


        if ($request->branch && $request->branch != null) {
            $query->where('branch_id', $request->branch);
        }

        if ($request->fromdate && $request->fromdate != null) {


            $fromdate = \DateTime::createFromFormat('d/m/Y', $request->fromdate);
            $fromdate = $fromdate->format('Y-m-d');

            $todate = \DateTime::createFromFormat('d/m/Y', $request->todate);
            $todate = $todate->format('Y-m-d');
            $query->whereBetween('date_received', [date('Y-m-d', strtotime($fromdate)), date('Y-m-d', strtotime($todate))]);
        }


        $account = $query->get();


        $start = 1;
        return Datatables::of($account)
            ->addColumn('id', function ($account) use (&$start) {
                return $start++;
            })
            ->editColumn('date_received', function ($account) {
                return Carbon::createFromFormat('Y-m-d', $account->date_received)->format('d/m/Y');

            })
            ->editColumn('amount', function ($account) {
                return number_format($account->amount);

            })
            ->editColumn('user_id', function ($account) {
                return User::find($account->user_id)->name;

            })
            // ->removeColumn('password')
            ->make(true);

    }

    public function create()
    {

        //  dd('aa');
        $branches = Branch::all();
        return view('expenses.create', compact('branches'));
    }

    public function store()
    {

        $this->validate(\request(), [
            'title' => 'required',
            'amount' => 'required',
            'branch' => 'required',
            'date' => 'required',
        ]);

        $DateReceived = request('date');


        $DateReceived = \DateTime::createFromFormat('d/m/Y', $DateReceived);
        $DateReceived = $DateReceived->format('Y-m-d');

        Expenses::create([
            'date_received' => $DateReceived,
            'branch_id' => \request('branch'),
            'user_id' => auth()->id(),
            'tittle' => \request('title'),
            'amount' => \request('amount')
        ]);

        // $request->persist();
        session()->flash('message', 'New Expenses Created');
        return redirect('/expenses/create');
    }

}
