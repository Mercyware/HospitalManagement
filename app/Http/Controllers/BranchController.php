<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Repository\BranchRepository;
use App\Service\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //

    /**
     * @var BranchService
     */
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
        $this->middleware('auth');
    }

    public function create()
    {
        return view('branch.create');
    }

    public function store(Request $request)
    {

        //Validating Request
        $this->validate($request,
            [
                'name' => 'required|min:2|unique:branches,name',
                'phone' => 'required|min:2',
                'address' => 'required|min:2'
            ]
        );




//Saving to Database
        $this->branchService->createbranch($request);


        // $request->persist();
        session()->flash('message', 'New Branch has been registered');
        return view('branch.create');
    }
}
