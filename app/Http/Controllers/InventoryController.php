<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Inventory;
use App\Models\Types;
use App\Models\Department;
use Uuid;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $types =  Types::pluck('type_name','id');
        $departments =  Department::pluck('department_name','id');
       
        $search = trim($request->get('search'));
        $inventories = Inventory::Search($search); 
        return view('inventories.index',compact('search','inventories','departments','types'));
    }

    public function store(Request $request)
    {
        $inventory_name = $request->input('inventory_name');
        $type_id = $request->input('type_id');
        $department_id = $request->input('department_id');

        $check = Inventory::where('inventory_name',$inventory_name)->where('type_id',$type_id)->where('department_id',$department_id)->first();

        if(!empty($check)):
            return back()->with('danger','INVENTORY '.$inventory_name.' Already Exist!');
        else:
            $uuid = Uuid::generate(4);
            $data = array(
                'id'=>$uuid,
                'inventory_name'=>$inventory_name,
                'type_id'=>$type_id,
                'department_id'=>$department_id
            );
            Inventory::create($data);
            return back()->with('success','INVENTORY SUCCESSFULLY CREATED!');
        endif;


    }

    public function update_inventory(Request $request){
        $id = $request->input('update_id');
        $inventory_name = trim(strtoupper($request->input('inventory_name_update')));
        $type_id = $request->input('type_id_update');
        $department_id = $request->input('department_id_update');
        $check = Inventory::where('inventory_name',$inventory_name)->where('type_id',$type_id)->where('department_id',$department_id)->first();

        if($inventory_name == trim(strtoupper($check->inventory_name))):
            $data = array(
                'type_id'=>$type_id,
                'department_id'=>$department_id
            );
            Inventory::where('id',$id)->update($data);
            return back()->with('SUCCESS','INVENTORY SUCCESSFULLY UPDATED!');
        else:
            $check_inventory = Inventory::where('inventory_name',$inventory_name)->where('type_id',$type_id)->where('department_id',$department_id)->first();

            if(!empty($check_inventory)):
                return back()->with('DANGER','INVENTORY SUCCESSFULLY EXIST!');
            else:
                $data = array(
                    'inventory_name'=>$inventory_name,
                    'type_id'=>$type_id,
                    'department_id'=>$department_id
                );
                Inventory::where('id',$id)->update($data);
                return back()->with('SUCCESS','INVENTORY SUCCESSFULLY UPDATED!');
            endif;
        endif;

    }
}
