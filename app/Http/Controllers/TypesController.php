<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uuid;
use Carbon\Carbon;
use App\Models\Types;
use App\Http\Requests\TypeCreatRequest;
use App\Http\Requests\TypeEditRequest;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $types = Types::Search($search); 
        return view('types.index',compact('search','types'));
    }

    public function store(TypeCreatRequest $request)
    {
        $uuid = Uuid::generate(4);
        $type_name = $request->input('type_name');
        $data = array(
            'id'=> $uuid,
            'type_name'=> strtoupper($type_name)
        );
        Types::create($data);
        return back()->with('success','TYPE SUCCESSFULLY CREATED!');
    }

    public function update_type(Request $request){
        $id = $request->input('update_id');
        $type_name = strtoupper(trim($request->input('type_name_update')));
        $type = Types::where('type_name',$type_name)->first();
        if(empty($type)):
            $data = array(
                'type_name'=>$type_name
            );
            Types::where('id',$id)->update($data);
            return back()->with('success','TYPE SUCCESSFULLY UPDATED!');
        else:
            return back()->with('danger','TYPE NAME '.$type_name.' Already Exist!');
        endif;
    }   
}
