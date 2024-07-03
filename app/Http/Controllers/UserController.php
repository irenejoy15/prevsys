<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCompany;
use App\Models\Department;
use App\Models\Company;
use Uuid;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\File;
use App\Http\Resources\UserResource;
use App\Http\Resources\Companies;
use App\Http\Resources\UserCompanyResource;

// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
// use Imagick;

class UserController extends Controller
{
    public function index(Request $request){
        $search = trim($request->get('search'));
        $users = User::Search($search); 
        $departments =  Department::pluck('department_name','id');
        $companies = Company::all();
        return view('users.index',compact('search','users','departments','companies'));
    }

    public function store(UserCreateRequest $request){
        $uuid = Uuid::generate(4);
        $name = $request->input('name');
        $email = $request->input('email');
        $department_id = $request->input('department_id');
        $photo = $request->file('photo');

        $password_post = trim($request->input('password'));  
        $password = md5($password_post);

        $is_admin = $request->input('is_admin');
        $is_active = $request->input('is_active');
        $is_admin_department = $request->input('is_admin_department');
        $is_maintenance = $request->input('is_maintenance');
        $is_it = $request->input('is_it');

        $company_array = $request->input('company');
        $companies  = Company::all();
        
        $irene = array();
        foreach ($company_array as $x => $y):
            $irene[] = $y; 
        endforeach;

        if (in_array("1", $irene)):
        else:
            return back()->with('danger',"PLEASE INPUT THE USER'S COMPANY ");
        endif;
        
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);    

        $photo_name = time().'.'.$photo->extension();
        $photo->move('user_images', $photo_name);
        $photo_image_post = $photo_name;
        // Image::make(storage::disk('user_images')->get($photo_image_post));
        
        if(!empty($photo_image_post)):
            $data_user = array(
                'id'=>$uuid,
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'is_active'=>$is_active,
                'is_admin' => $is_admin,
                'photo'=> $photo_image_post,
                'department_id'=>$department_id,
                'is_admin_department'=>$is_admin_department,
                'is_maintenance'=>$is_maintenance,
                'is_it'=>$is_it
            );
            User::create($data_user);
        else:
            $data_user = array(
                'id'=>$uuid,
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'is_active'=>$is_active,
                'is_admin' => $is_admin,
                'department_id'=>$department_id,
                'is_admin_department'=>$is_admin_department,
                'is_maintenance'=>$is_maintenance,
                'is_it'=>$is_it
            );
            User::create($data_user);
        endif;

        foreach($companies as $company):
            $check = $company_array[$company->company_name];
            if($check !=0):
                $company_id = $company->id;
                $user_id = $uuid;

                $uuid_user_company = Uuid::generate(4);
                $data_user_company = array(
                    'id' => $uuid_user_company,
                    'company_id' => $company_id,
                    'user_id'=>$user_id
                );
                UserCompany::create($data_user_company);
            endif;
        endforeach;

        return back()->with('success','USER SUCCESSFULLY CREATED!');
    }

    public function update_user(Request $request){
        $user_id = $request->input('update_id');
        $name = $request->input('user_name_update');
        $email = $request->input('email_update');
        $department_id = $request->input('department_id_update');
        $photo = $request->file('photo_update');
        $photo_check = $request->input('photo_update_check');

        $is_admin = $request->input('is_admin_update');
        $is_active = $request->input('is_active_update');
        $is_admin_department = $request->input('is_admin_department_update');
        $is_maintenance = $request->input('is_maintenance_update');
        $is_it = $request->input('is_it_update');

        $company_array = $request->input('company_update');
        $irene = array();
        foreach ($company_array as $x => $y):
            $irene[] = $y; 
        endforeach;

        if (in_array("1", $irene)):
        else:
            return back()->with('danger',"PLEASE INPUT THE USER'S COMPANY ");
        endif;

        foreach ($company_array as $x => $y):
            $company_row = Company::where('company_name',$x)->first();
            $user_company_row = UserCompany::where('user_id',$user_id)->where('company_id',$company_row->id)->first();

            if(empty($user_company_row)):
                if($y == 1):
                    $company_id = $company_row->id;

                    $uuid_user_company = Uuid::generate(4);
                    $data_user_company = array(
                        'id' => $uuid_user_company,
                        'company_id' => $company_id,
                        'user_id'=>$user_id
                    );
                    UserCompany::create($data_user_company);
                endif;
            else:
                if($y == 0):
                    UserCompany::where('id',$user_company_row->id)->delete();
                endif;
            endif;
        endforeach;

        $user_row = User::where('id',$user_id)->first();
        if(empty($photo_check)):
            if(!empty($photo)):
                $photo_name = time().'.'.$photo->extension();
                $photo->move('user_images', $photo_name);
                $photo_image_post = $photo_name;
            else:
                $photo_image_post = '';
            endif;
        else:
            if(!empty($photo)):
                $photo_name = time().'.'.$photo->extension();
                $photo->move('user_images', $photo_name);
                $photo_image_post = $photo_name;

                $image_path = public_path('user_images').'/'.$user_row->photo;
                if(File::exists($image_path)):
                    File::delete($image_path);
                endif;
            else:
                $photo_image_post = $photo_check;
            endif;
        endif;

        $password_post = trim($request->input('password_update'));  
        if(empty($password_post)):
            $password = $user_row->password;
        else:
            $password = md5($password_post);
        endif;
        
        $data_user = array(
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'is_active'=>$is_active,
            'is_admin' => $is_admin,
            'photo'=>$photo_image_post,
            'department_id'=>$department_id,
            'is_admin_department'=>$is_admin_department,
            'is_maintenance'=>$is_maintenance,
            'is_it'=>$is_it
        );

        User::where('id',$user_id)->update($data_user);
        return back()->with('success',"USER SUCCESSFULLY UPDATED!");
    }

    public function get_user($user_id){
        $user = User::where('id',$user_id)->first();
        return new UserResource($user);
    }

    public function get_user_company($user_id){
        $companies = UserCompany::where('user_id',$user_id)->get();
        return UserCompanyResource::collection($companies);
    }

    public function all_company(){
        $companies = Company::all('id','company_name');
        return Companies::collection($companies);
    }

    public function test(){
        $image_path = public_path('user_images').'/'.'1719966916.png';
        echo $image_path;
        if(File::exists($image_path)):
            File::delete($image_path);
        endif;
    }
}
