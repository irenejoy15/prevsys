<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uuid;
use Carbon\Carbon;
use App\Models\Company;
use App\Http\Requests\CompanyCreateRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $companies = Company::Search($search); 
        return view('companies.index',compact('search','companies'));
    }

    
    public function store(CompanyCreateRequest $request)
    {
        $uuid = Uuid::generate(4);
        $company_name = $request->input('company_name');
        $data = array(
            'id'=>$uuid,
            'company_name'=>$company_name,
        );
        Company::create($data);
        return back()->with('success','COMPANY SUCCESSFULLY CREATED!');
    }

   public function update_company(Request $request){
        $update_id = $request->input('update_id');
        $company_name_update = $request->input('company_name_update');

        $data = array(
            'company_name'=>$company_name_update,
        );

        Company::where('id',$update_id)->update($data);
        return back()->with('success','COMPANY SUCCESSFULLY UPDATEF!');
   }
    
}
