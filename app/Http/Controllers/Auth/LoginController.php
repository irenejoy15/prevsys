<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {   
        if (Auth::check()):
            return redirect('/users')->with('danger','YOUR ARE ALREADY LOG IN');
        else:

            $user = User::where('email', $request->email)
                    ->where('password',md5($request->password))
                    ->first();
            if($user!=NULL):
                $company_id = $request->company;

                $user_company = UserCompany::where('company_id',$company_id)->where('user_id',$user->id)->first();

                if($user_company!=NULL):
                    if($user->is_active=='1'):
                        Auth::login($user, $remember = false);
                        Session::put('company', $company_id);
                        return redirect('/inventories')->with('success','SUCCESSFULLY LOGIN');
                    else:
                        return redirect('/login')->with('danger','YOUR ACCOUNT IS ALREADY INACTIVE!');
                    endif;
                else:
                    return redirect('/login')->with('danger','YOUR ACCOUNT DOES NOT HAVE ACCESS TO THIS COMPANY');
                endif;
            else:
                return redirect('/login')->with('danger','Please input the correct credentials!');
            endif;
        endif;
        
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect('/login');
    }
}
