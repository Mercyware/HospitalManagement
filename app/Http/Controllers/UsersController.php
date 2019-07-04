<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\UsersRequest;
use App\Role;
use App\Service\BranchService;
use App\Service\DigitalService;
use App\Service\GeneralService;
use App\Service\RolesService;
use App\Service\StaffService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    //
    //  use Authorizable;

    /**
     * @var StaffService
     */
    private $staffService;
    /**
     * @var BranchService
     */
    private $branchService;
    /**
     * @var RolesService
     */
    private $rolesService;
    /**
     * @var GeneralService
     */
    private $generalService;
    /**
     * @var DigitalService
     */
    private $digitalService;

    public function __construct(StaffService $staffService, BranchService $branchService, RolesService $rolesService,
                                GeneralService $generalService, DigitalService $digitalService)
    {
        $this->middleware('auth');
        $this->staffService = $staffService;
        $this->branchService = $branchService;
        $this->rolesService = $rolesService;
        $this->generalService = $generalService;
        $this->digitalService = $digitalService;
    }


    public function index()
    {
        return view('users.welcome');
    }

    public function create()
    {
        $branches = $this->branchService->getAllBranches();
        //   $roles = Role::pluck('name', 'id');
        $roles = $this->rolesService->getRoles();
        return view('users.create', compact('branches', 'roles'));
    }


    public function update(User $user)
    {
        $branches = $this->branchService->getAllBranches();

        return view('users.update', compact('user', 'branches'));
    }


    public function store(UsersRequest $request)
    {


        $request->date_of_birth = $this->generalService->convertToSQLDDate($request->dob);
        $request->appointment_date = $this->generalService->convertToSQLDDate($request->appointment_date);


        $request->photo = null;

        if ($request->hasFile('Picture')) {
            $file = $request->file('Picture');
            //Move Uploaded File
            $destinationPath = 'UsersPhoto';

            $photo = $this->digitalService->uploadFile($file, $destinationPath);

            $request->photo = $photo;
        }

        $user = $this->staffService->createUser($request);


        if ($user) {
            $this->rolesService->syncPermissions($request, $user);
            // $request->persist();
            session()->flash('message', 'New Staff has been registered');

            // $branches = Branch::all();
            // return view('users.create',compact('branches'));


        } else {
            session()->flash('message', 'Unable to Create User');

        }

        return redirect()->route('createUser');

    }


    public function updateuser(UsersRequest $request, $user)
    {

        $request->date_of_birth = $this->generalService->convertToSQLDDate($request->dob);
        $request->appointment_date = $this->generalService->convertToSQLDDate($request->appointment_date);


        $request->photo = null;

        if ($request->hasFile('Picture')) {
            $file = $request->file('Picture');
            //Move Uploaded File
            $destinationPath = 'UsersPhoto';

            $photo = $this->digitalService->uploadFile($file, $destinationPath);

            $request->photo = $photo;
        }

        $this->staffService->updateUser($user, $request);

        // $request->persist();
        session()->flash('message', 'Selected User Information has been Updated');

        // $branches = Branch::all();
        // return view('users.create',compact('branches'));


        return redirect()->route('user');

    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('users.welcome');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        //  return Datatables::of(User::query())->make(true);

        $users = $this->staffService->getAllUsers();

        $start = 1;
        return Datatables::of($users)
            ->addColumn('action', function ($users) {
                return '<a href="/user/view/' . $users->id . '" class="btn btn-xs btn-primary">
<i class="fa fa-eye"></i> View </a> <a href="/user/update/' . $users->id . '" class="btn btn-xs btn-success">
<i class="fa fa-pencil"></i> Edit </a>';
            })
            ->addColumn('id', function ($users) use (&$start) {
                return $start++;
            })
            ->addColumn('branch', function ($users) use (&$start) {
               return $users->branch->name;
            })
            ->addColumn('position', function ($users) use (&$start) {
               return $users->roles->implode('name', ', ');
            })
            // ->removeColumn('password')
            ->make(true);


    }


    public function view(User $user)
    {


        return view('users.view', compact('user'));
    }


    public function activate($user, $activate)
    {
        $this->staffService->activate($activate, $user);


        session()->flash('message', 'Staff Account Status Changed  ');

        // return redirect('/user/view/' .$user);
        return redirect()->route('viewuser', ['user' => $user]);


    }


}
