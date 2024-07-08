<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCompany;
use App\Models\Company;
use Auth;
class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $user_company = UserCompany::where('user_id',$user_auth->id)->pluck('company_id');
        $companies = Company::whereIn('id',$user_company)->get();
        // print_r($companies);
        return view('headers.index',compact('companies'));
    }

   
    public function store(Request $request)
    {
        //
    }
    
    public function getMondays($date)
    {
        $dateDay = new Carbon($date);//use your date to get month and year
        $year = $dateDay->year;
        $month = $dateDay->month;
        $days = $dateDay->daysInMonth;
        $mondays=[];
        foreach (range(1, $days) as $day) {
            $date = Carbon::createFromDate($year, $month, $day);
            if ($date->isMonday()===true) {
                $mondays[]=($date->day);
            }
        }
        return $mondays;
    }

   

}
