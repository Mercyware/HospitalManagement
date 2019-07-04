<?php

namespace App\Http\Controllers;

use App\Service\LaboratoryService;
use App\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;
use Yajra\Datatables\Datatables;

class TestsController extends Controller
{
    //

    /**
     * @var LaboratoryService
     */
    private $laboratoryService;

    public function __construct(LaboratoryService $laboratoryService)
    {
        $this->middleware('auth');
        $this->laboratoryService = $laboratoryService;
    }

    public function create($parent_id = 0)
    {
        $test = $this->laboratoryService->getATest($parent_id);
        return view('tests.create', compact('parent_id', 'test'));
    }


    public function createtest(Request $request)
    {

        $this->validate($request,
            [
                'name' => 'required|min:2|unique:tests,name',
            ]
        );

        $this->laboratoryService->createTest($request);


        // $request->persist();
        session()->flash('message', 'New Test Added to Database');

        // $branches = Branch::all();
        // return view('users.create',compact('branches'));


        return redirect()->route('tests.all');
    }

    public function viewtest(Tests $test)
    {

        return view('tests.update', compact('test'));
    }


    public function view($parent_id = 0)
    {
        $test = $this->laboratoryService->getATest($parent_id);


        return view('tests.welcome', compact('parent_id', 'test'));
    }


    public function getTestData($parent_id)
    {
        //dd($request->patient);
        //DB::enableQueryLog();


        // dd(1);
        $start = 1;


        $tests = $this->laboratoryService->allTest($parent_id);

        // dd(DB::getQueryLog());
        return Datatables::of($tests)
            ->addColumn('action', function ($tests) {
                return ' <a href="/tests/update/' . $tests->id . '" class="btn btn-xs btn-success">
<i class="fa fa-pencil"></i> Edit </a> <a href="/tests/' . $tests->id . '" class="btn btn-xs btn-success">
<i class="fa fa-pencil"></i> Sub Tests </a>';
            })
            ->addColumn('id', function ($tests) use (&$start) {
                return $start++;
            })
            ->editColumn('normal', function ($tests) {
                return $tests->normal_range;
            })->editColumn('sub_test', function ($tests) {
                return count($tests->sub_tests);
            })
            ->make(true);

    }

    public function update(Request $request, $test)
    {
        // dd($test);
        $this->laboratoryService->updateTest($request);

        // $request->persist();
        session()->flash('message', 'Selected Test Information has been Updated');

        return redirect()->route('tests.all', ['test' => $test]);
    }
}
