<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCompany;
use App\Models\Company;
use App\Models\PrevHeader;
use App\Models\Frequency;
use Auth;
use App\Http\Requests\HeaderReqeust;
use Uuid;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Http\Resources\CalendarResource;
use Session;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $department_id = $user_auth->department_id;
        $user_company = UserCompany::where('user_id',$user_auth->id)->pluck('company_id');
        $companies = Company::whereIn('id',$user_company)->pluck('company_name','id');
        // print_r($companies);
        return view('headers.index',compact('companies','year','month','department_id'));
    }

   
    public function store(HeaderReqeust $request)
    {
        $user_row = Auth::user();
        $location_id = $request->input('location_id');
        $frequency_id = $request->input('frequency_id');
        $inventory_id = $request->input('inventory_id');
        $company_id = $request->input('company_id');
        $assigned = $request->input('assigned');
        $name = $request->input('name');

        $remarks1 = $request->input('remarks1');
        $remarks2 = $request->input('remarks2');
        $remarks3 = $request->input('remarks3');
        $remarks4 = $request->input('remarks4');
        $remarks5 = $request->input('remarks5');

        $custom_date = $request->input('custom_date');

        $week_from_post =$request->input('week_from');
        $week_to_post =$request->input('week_to');

        $date_form_post = $request->input('date_form');
        $date_to_post = $request->input('date_to');
        $month = $request->input('month');
        $year = $request->input('year');
        $date_check = $year.'-'.$month.'-01';

        if($custom_date==1):
            $date_form = $date_form_post;
            $date_to = $date_to_post;

            $week_from = 99;
            $week_to =99;
            $is_onetime = 1;
        else:
            $week_from = $week_from_post;
            $week_to = $week_to_post;
            if($week_from > $week_to):
                return back()->with('danger','WEEK TO. MUST NOT BE GREATER THAN WEEK FROM!');
            endif;

            $date_form = NULL;
            $date_to = NULL;
            $is_onetime = $request->input('is_onetime');
        endif;  

        $uuid = Uuid::generate(4);
        $data = array(
            'id'=>$uuid,
            'inventory_id'=>$inventory_id,
            'location_id'=>$location_id,
            'frequency_id'=>$frequency_id,
            'company_id'=>$company_id,
            'department_id'=>$user_row->department_id,
            'name'=>$name,
            'week_from'=>$week_from,
            'week_to'=>$week_to,
            'date_from'=>$date_form,
            'date_to'=>$date_to,
            'remarks_1'=>$remarks1,
            'remarks_2'=>$remarks2,
            'remarks_3'=>$remarks3,
            'remarks_4'=>$remarks4,
            'remarks_5'=>$remarks5,
            'assigned'=>$assigned,
            'month'=>$month,
            'year'=>$year,
            'is_onetime'=>$is_onetime,
        );

        PrevHeader::create($data);
        return back()->with('success','SCHEDULE SUCCESSFULLY CREATED!');
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
                $mondays[]=($date->format('Y-m-d'));
            }
        }
        return $mondays;
    }

    public function getSundays($date)
    {
        $dateDay = new Carbon($date);//use your date to get month and year
        $year = $dateDay->year;
        $month = $dateDay->month;
        $days = $dateDay->daysInMonth;
        $sundays=[];
        foreach (range(1, $days) as $day) {
            $date = Carbon::createFromDate($year, $month, $day);
            if ($date->isSaturday()===true) {
                $sundays[]=($date->format('Y-m-d'));
            }
        }
        return $sundays;
    }

    public function weeks($date){
        $f = "Y-m-d";
        $today = Carbon::parse($date);
        $date = $today->copy()->firstOfMonth()->startOfDay();
        $eom = $today->copy()->endOfMonth()->startOfDay();
      
        $date_from = [];
        $date_to = [];
        for($i = 1; $date->lte($eom); $i++){
            
            //record start date 
            $startDate = $date->copy();
            
            //loop to end of the week while not crossing the last date of month
            while($date->dayOfWeek != Carbon::SUNDAY && $date->lte($eom)){
                    $date->addDay(); 
                }
            
            $date_from['date_from'.$i] = $startDate->format($f);
            $date_to['date_to'.$i] = $date->format($f);
            $date->addDay();
        }
        
        return [$date_from,$date_to];
    }

    public function calendar_ajax($month,$year,$company_id,$department_id){
        $user_auth = Auth::user();
        $companies = Session::get('company');
        $user_company = UserCompany::where('user_id',$user_auth->id)->pluck('company_id');
        //where('month',$month)->
        $headers = PrevHeader::where('company_id',$companies)->where('department_id',$department_id)->orderBy('created_at','ASC')->get();
        $data = array();
       
        if(!empty($headers)):
            foreach($headers as $header):
                $frequency = Frequency::where('id',$header->frequency_id)->first();
                if ($year % $frequency->year_interval == 0):
                    $frequency_check =app(HeaderController::class)->frequency_check($month,$header->frequency_id);
                    if($frequency_check=='true'):
                        $date_check = $year.'-'.$month.'-01';
                        $date =app(HeaderController::class)->weeks($date_check);
                        $mondays = app(HeaderController::class)->getMondays($date_check); 
                        $sundays = app(HeaderController::class)->getSundays($date_check); 

                        if($header->week_from == 0):
                            $week_from = $date[0]['date_from1'];
                        elseif($header->week_to == 1):
                            $week_from = $mondays[1];
                        elseif($header->week_to == 2):
                            $week_from = $mondays[2];
                        elseif($header->week_to == 3):
                            $week_from = $mondays[3];   
                        endif;

                        if($header->week_to == 0):
                            $week_to = $sundays[1];
                        elseif($header->week_to == 1):
                            $week_to = $sundays[2];
                        elseif($header->week_to == 2):
                            $week_to = $sundays[3];
                        elseif($header->week_to == 3):
                            $count_week_to = count($date[1]);
                            $week_to = $date[1]['date_to'.$count_week_to];   
                        endif;
                       
                        $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                        
                        $data[]=(object)array(
                            'id'=>$header->id,
                            'title'=>$header->name,
                            'start'=>strval($week_from),
                            'end'=>strval($week_to),
                            // 'description'=>'<p><span class="badge bg-primary">'.$header->Location->location_name.'</span</p>',
                            // 'type'=>'event',
                            'color'=>'#'.$rand,
                            // 'everyYear'=>true
                        );

                    endif;
                endif;
            endforeach;
            // return $mondays;
            return CalendarResource::collection($data);
        else:
            return 'none';
        endif;

    }

    public function frequency_check($month,$frequency_id){
        
        if($month=='01'):
            $boolean = 'is_jan';
        elseif($month=='02'):
            $boolean = 'is_feb'; 
        elseif($month=='03'):
            $boolean = 'is_mar';
        elseif($month=='04'):
            $boolean = 'is_apr';
        elseif($month=='05'):
            $boolean = 'is_may';
        elseif($month=='06'):
            $boolean = 'is_jun';
        elseif($month=='07'):
            $boolean = 'is_jul';
        elseif($month=='08'):
            $boolean = 'is_aug';
        elseif($month=='09'):
            $boolean = 'is_sept';
        elseif($month=='10'):
            $boolean = 'is_oct';
        elseif($month=='11'):
            $boolean = 'is_nov';
        elseif($month=='12'):
            $boolean = 'is_dec';
        endif;

        $frequency = Frequency::where('id',$frequency_id)->first($boolean);
        if($frequency->$boolean ==1):
            return 'true';
        else:
            return 'false';
        endif;
    }
}
