<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uuid;
use Carbon\Carbon;
use App\Models\Location;
use App\Http\Requests\LocationCreateRequest;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $locations = Location::Search($search); 
        return view('locations.index',compact('search','locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationCreateRequest $request)
    {
        $uuid = Uuid::generate(4);
        $location_name = $request->input('location_name');
        $data = array(
            'id'=>$uuid,
            'location_name'=>$location_name
        );
        Location::create($data);
        return back()->with('success','LOCATION SUCCESSFULLY CREATED!');
    }

    public function update_location(Request $request)
    {
        $id = $request->input('update_id');
        $location_name = strtoupper(trim($request->input('location_name_update')));
        $location = Location::where('location_name',$location_name)->first();
        if(empty($location)):
            $data = array(
                'location_name'=>$location_name
            );
            Location::where('id',$id)->update($data);
            return back()->with('success','LOCATION SUCCESSFULLY UPDATED!');
        else:
            return back()->with('danger','LOCATION NAME '.$location_name.' Already Exist!');
        endif;
    }

    public function location_ajax(Request $request){
        $search = $request->input('search');
        $locations = Location::AjaxSearch($search);
        return LocationResource::collection($locations);
    }
  
}
