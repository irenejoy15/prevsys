<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uuid;
use Carbon\Carbon;
use App\Models\Department;
use App\Http\Requests\DepartmentCreateRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $departments = Department::Search($search); 
        return view('departments.index',compact('search','departments'));
    }

    
    public function store(DepartmentCreateRequest $request)
    {
        $uuid = Uuid::generate(4);
        $department_name = $request->input('department_name');
        $data = array(
            'id'=>$uuid,
            'department_name'=>$department_name
        );
        Department::create($data);
        return back()->with('success','DEPARTMENT SUCCESSFULLY CREATED!');
    }

   public function update_department(Request $request){
        $id = $request->input('update_id');
        $department_name = strtoupper(trim($request->input('department_name_update')));
        $department = Department::where('department_name',$department_name)->first();
        if(empty($department)):
            $data = array(
                'department_name'=>$department_name
            );
            Department::where('id',$id)->update($data);
            return back()->with('success','DEPARTMENT SUCCESSFULLY UPDATED!');
        else:
            return back()->with('danger','DEPARTMENT NAME '.$department_name.' Already Exist!');
        endif;
   }
}
