<?php

namespace App\Http\Controllers;

use App\Service\CompanyService;
use App\Service\DigitalService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    /**
     * @var CompanyService
     */
    private $companyService;
    /**
     * @var DigitalService
     */
    private $digitalService;

    public function __construct(CompanyService $companyService, DigitalService $digitalService)
    {
        $this->companyService = $companyService;
        $this->digitalService = $digitalService;
        $this->middleware('auth');
    }

    public function contactView()
    {
        //Get registered Company
        $company = $this->companyService->getACompany();
        return view('settings.company.create', compact('company'));
    }

    public function updateContactView()
    {
        //Get registered Company

        return view('settings.company.update');
    }


    public function storeContact(Request $request)
    {
        //Upload photo if logo if there is a logo
        $photoName = "";
        if ($request->hasFile('file')) {
            $file = $request->file('file');
//            //Move Uploaded File
            $destinationPath = 'CompanyLogo';
//
//            $NewName = Carbon::now()->timestamp . ".png";
//            $move = $file->move($destinationPath, $NewName);

            // $path = $request->Picture->storeAs($destinationPath, 'filename.jpg');

            $photoName = $this->digitalService->uploadFile($file, $destinationPath);

        }
        $request->photo = $photoName;

        if ($request->company_id != null && $request->company_id != "") {
            //Update
            $this->companyService->updateCompany($request, $request->company_id);
        } else {
            $this->companyService->createContact($request);
        }
        session()->flash('message', 'New company has been registered');
        return redirect()->back();
    }
}
