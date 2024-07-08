<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FrequencyCreateRequest;
use Uuid;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Frequency;
use App\Http\Resources\FrequencyResource;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $mondays = $this->getMondays('2024-10-01');

        // // Loop through the mondays and do whatever you want
        // foreach ($mondays as $monday)
        // {   
        //     echo $monday.'<pre>';
        // }
        $search = trim($request->get('search'));
        $frequencies = Frequency::Search($search); 
        return view('frequency.index',compact('search','frequencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FrequencyCreateRequest $request)
    {
        $uuid = Uuid::generate(4);
        $frequency = strtoupper(trim($request->input('frequency')));
        $is_jan = $request->input('is_jan');
        $is_feb = $request->input('is_feb');
        $is_mar = $request->input('is_mar');
        $is_apr = $request->input('is_apr');
        $is_may = $request->input('is_may');
        $is_jun = $request->input('is_jun');
        $is_jul = $request->input('is_jul');
        $is_aug = $request->input('is_aug');
        $is_sept = $request->input('is_sept');
        $is_oct = $request->input('is_oct');
        $is_nov = $request->input('is_nov');
        $is_dec = $request->input('is_dec');
        $year_interval = $request->input('year_interval');

        $data = array(
            'id'=> $uuid,
            'frequency'=>$frequency,
            'is_jan'=>$is_jan,
            'is_feb'=>$is_feb,
            'is_mar'=>$is_mar,
            'is_apr'=>$is_apr,
            'is_may'=>$is_may,
            'is_jun'=>$is_jun,
            'is_jul'=>$is_jul, 
            'is_aug'=>$is_aug,
            'is_sept'=>$is_sept,
            'is_oct'=>$is_oct, 
            'is_nov'=>$is_nov,
            'is_dec'=>$is_dec,
            'year_interval'=>$year_interval
        );

        Frequency::create($data);
        return back()->with('success','FREQUENCY SUCCESSFULLY CREATED!');
    }

    public function update_frequency(Request $request){
        $update_id = $request->input('update_id');
        $frequency_update = strtoupper(trim($request->input('frequency_update')));
        $year_interval_update = $request->input('year_interval_update');
        $is_jan = $request->input('is_jan_update');
        $is_feb = $request->input('is_feb_update');
        $is_mar = $request->input('is_mar_update');
        $is_apr = $request->input('is_apr_update');
        $is_may = $request->input('is_may_update');
        $is_jun = $request->input('is_jun_update');
        $is_jul = $request->input('is_jul_update');
        $is_aug = $request->input('is_aug_update');
        $is_sept = $request->input('is_sept_update');
        $is_oct = $request->input('is_oct_update');
        $is_nov = $request->input('is_nov_update');
        $is_dec = $request->input('is_dec_update');


        $check = Frequency::where('frequency',$frequency_update)->first();
        if(!empty($check)):
            if($check->frequency===$frequency_update):
                $data = array(
                    'is_jan'=>$is_jan,
                    'is_feb'=>$is_feb,
                    'is_mar'=>$is_mar,
                    'is_apr'=>$is_apr,
                    'is_may'=>$is_may,
                    'is_jun'=>$is_jun,
                    'is_jul'=>$is_jul, 
                    'is_aug'=>$is_aug,
                    'is_sept'=>$is_sept,
                    'is_oct'=>$is_oct, 
                    'is_nov'=>$is_nov,
                    'is_dec'=>$is_dec,
                    'year_interval'=>$year_interval_update
                );
                Frequency::where('id',$update_id)->update($data);
                return back()->with('success','FREQUENCY SUCCESSFULLY UPDATED!');
            else:
                $check_duplicate = Frequency::where('frequency',$frequency_update)->first();
                if(!empty($check_duplicate)):
                    return back()->with('danger','FREQUENCY ALREADY EXIST!');
                else:
                    $data = array(
                        'frequency'=>$frequency_update,
                        'is_jan'=>$is_jan,
                        'is_feb'=>$is_feb,
                        'is_mar'=>$is_mar,
                        'is_apr'=>$is_apr,
                        'is_may'=>$is_may,
                        'is_jun'=>$is_jun,
                        'is_jul'=>$is_jul, 
                        'is_aug'=>$is_aug,
                        'is_sept'=>$is_sept,
                        'is_oct'=>$is_oct, 
                        'is_nov'=>$is_nov,
                        'is_dec'=>$is_dec,
                        'year_interval'=>$year_interval_update
                    );
                    Frequency::where('id',$update_id)->update($data);
                    return back()->with('success','FREQUENCY SUCCESSFULLY UPDATED!');
                endif;
            endif;
        else:
            $check_duplicate = Frequency::where('frequency',$frequency_update)->first();
            if(!empty($check_duplicate)):
                return back()->with('danger','FREQUENCY ALREADY EXIST!');
            else:
                $data = array(
                    'frequency'=>$frequency_update,
                    'is_jan'=>$is_jan,
                    'is_feb'=>$is_feb,
                    'is_mar'=>$is_mar,
                    'is_apr'=>$is_apr,
                    'is_may'=>$is_may,
                    'is_jun'=>$is_jun,
                    'is_jul'=>$is_jul, 
                    'is_aug'=>$is_aug,
                    'is_sept'=>$is_sept,
                    'is_oct'=>$is_oct, 
                    'is_nov'=>$is_nov,
                    'is_dec'=>$is_dec,
                    'year_interval'=>$year_interval_update
                );
                Frequency::where('id',$update_id)->update($data);
                return back()->with('success','FREQUENCY SUCCESSFULLY UPDATED!');
            endif;
        endif;
    }

    public function frequency_ajax(Request $request){
        $search = $request->input('search');
        $frequencies = Frequency::AjaxSearch($search);
        return FrequencyResource::collection($frequencies);
    }
}
