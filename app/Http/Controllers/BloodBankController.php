<?php

namespace App\Http\Controllers;


use App\Service\BloodBankService;
use App\Service\GeneralService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Yajra\Datatables\Datatables;

class BloodBankController extends Controller
{
    //

    /**
     * @var BloodBankService
     */
    private $bloodBankService;
    /**
     * @var GeneralService
     */
    private $generalService;

    public function __construct(BloodBankService $bloodBankService, GeneralService $generalService)
    {
        $this->bloodBankService = $bloodBankService;
        $this->generalService = $generalService;
        $this->middleware('auth');
    }


    public function bloodBank()
    {
        return view('blood.bank.welcome');
    }

    public function bloodBankData(Request $request)
    {

        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $bloodGroups = $this->bloodBankService->getBloodGroups();

        //  dd($patients);


        return Datatables::of($bloodGroups)
            ->addColumn('action', function ($bloodGroups) {

                return '<a href="/blood/bank/edit/' . $bloodGroups->id . '" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Edit </a>';
            })
            ->editColumn('id', function ($bloodGroups) {
                return sprintf('%03d', $bloodGroups->id);
            })
            ->editColumn('name', function ($bloodGroups) {
                return $bloodGroups->name . " " . $bloodGroups->rh_factor;
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function bloodBankCreateView()
    {
        return view('blood.bank.create');
    }

    public function bloodBankCreateStore(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'qty' => 'required|numeric',
                'rh_factor' => 'required',
                'price' => 'required|numeric',
            ]
        );

        $request->created_by = auth()->user()->getAuthIdentifier();
        $this->bloodBankService->addBloodGroup($request);

        session()->flash('message', 'New Blood Group Added');
        return redirect()->route('blood.bank');
    }

    public function bloodBankEditView($blood_group_id)
    {
        $blood = $this->bloodBankService->getABloodGroup($blood_group_id);
        if (!$blood) {
            abort(404);
        }
        return view('blood.bank.update', compact('blood'));
    }

    public function bloodBankEditStore(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2',
                'qty' => 'required|numeric',
                'price' => 'required|numeric',
            ]
        );

        $this->bloodBankService->updateBloodGroup($request, $request->blood_group_id);

        session()->flash('message', 'New Blood Group Updated');
        return redirect()->route('blood.bank');
    }


    //Blood Donation Methods


    public function bloodDonation()
    {


        return view('blood.donations.welcome');
    }

    public function bloodDonationData(Request $request)
    {

        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $blood = $this->bloodBankService->getBloodBankDetails();

        //  dd($patients);


        return Datatables::of($blood)
            ->addColumn('action', function ($blood) {

                return '<a href="/blood/bank/edit/' . $blood->id . '" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Edit </a>';
            })
            ->editColumn('blood_group', function ($blood) {
                return $blood->bloodGroup->name . " " . $blood->bloodGroup->rh_factor;
            })
            ->editColumn('date_donated', function ($blood) {
                return $blood->donationHistory[0]->date_created->format('d/m/Y');
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function bloodDonationCreateView()
    {
        $bloodGroups = $this->bloodBankService->getBloodGroups();
        return view('blood.donations.create', compact('bloodGroups'));
    }

    public function bloodDonationCreateStore($donor_id)
    {
        $bloodgroup = $this->bloodBankService->getABloodDonory($donor_id);
        if (!$bloodgroup) {
            abort(404);
        }
        $request = new Request();

        $request->donor_id = $donor_id;
        $request->created_by = auth()->user()->getAuthIdentifier();

        //Get the Blood Group of the User

        $bloodgroup = $this->bloodBankService->getABloodDonory($donor_id);
        $this->bloodBankService->addBloodBank($request);

        $this->bloodBankService->increaseBloodBankQty($bloodgroup->blood_group_id, 1);

        session()->flash('message', 'New Blood Donation Added');
        return redirect()->route('blood.bank');
    }


    //Blod Bank History
    public function bloodHistory()
    {


        return view('blood.history.welcome');
    }

    public function bloodHistoryData(Request $request)
    {

        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $blood = $this->bloodBankService->getBloodBankHistory();

        //  dd($patients);


        return Datatables::of($blood)
//            ->addColumn('action', function ($blood) {
//
//                return '<a href="/blood/bank/edit/' . $blood->id . '" class="btn btn-xs btn-info">
//        <i class="fa fa-pencil"></i> Edit </a>';
//            })
            ->editColumn('blood_group', function ($blood) {
                return $blood->bloodGroup->name . " " . $blood->bloodGroup->rh_factor;
            })
            ->editColumn('date_donated', function ($blood) {
                return $blood->created_at->format('d/m/Y');;
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function bloodHistoryCreateView()
    {
        $bloodGroups = $this->bloodBankService->getBloodGroups();
        return view('blood.history.create', compact('bloodGroups'));
    }

    public function bloodHistoryCreateStore(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2',

            ]
        );
//Get The Blood Group Infor
        $blood = $this->bloodBankService->getABloodGroup($request->blood_group_id);
        $request->price = $blood->price;
        $request->created_by = auth()->user()->getAuthIdentifier();
        $this->bloodBankService->addBloodBankHistory($request);


        $this->bloodBankService->decreaseBloodBankQty($request->blood_group_id, 1);

        session()->flash('message', 'New Blood Request Stored');
        return redirect()->route('blood.bank.history');
    }


    public function bloodDonors()
    {

        return view('blood.donors.welcome');
    }


    public function bloodDonorsData(Request $request)
    {

        //  return Datatables::of(User::query())->make(true);
        //  $patients = Patient::select(['id', 'name', 'email']);


        $blood = $this->bloodBankService->getDonors();

        //  dd($patients);


        return Datatables::of($blood)
            ->addColumn('action', function ($blood) {

                return '<a href="/blood/donation/create/' . $blood->id . '" class="btn btn-xs btn-info">
        <i class="fa fa-blood"></i> Donate </a>';
            })
            ->editColumn('blood_group', function ($blood) {
                return $blood->bloodGroup->name . " " . $blood->bloodGroup->rh_factor;
            })
            ->editColumn('date_donated', function ($blood) {
                return $blood->created_at->format('d/m/Y');
            })
            // ->removeColumn('password')
            ->make(true);

    }


    public function bloodDonorCreateView()
    {
        $bloodGroups = $this->bloodBankService->getBloodGroups();
        return view('blood.donors.create', compact('bloodGroups'));
    }

    public function bloodDonorsCreateStore(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2',

            ]
        );

        $request->date_of_birth = $this->generalService->convertToSQLDDate($request->dob);


        $donor = $this->bloodBankService->addBloodDonor($request);

        //  $this->bloodBankService->increaseBloodBankQty($request->blood_group_id, 1);

        session()->flash('message', 'New Blood Donor Added ');
        return redirect()->route('blood.bank.donors');
    }

}
