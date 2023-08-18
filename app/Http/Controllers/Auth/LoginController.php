<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $inputVal = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required | max:64 | min:8',
        ]);

        if(auth()->attempt(array('username' => $inputVal['username'], 'password' => $inputVal['password']),
            $request->get('remember'))){

            if (auth()->user()->rule == 'schoolHelp') {
                return redirect()->route('school-help.index');
            }
            elseif (auth()->user()->role == 'SchoolAdmin') {
                return redirect()->route('school-admin.index');
            }
            // elseif (auth()->user()->role == 'SchoolVolunteer') {
            //     return redirect()->route('home');
            // }
            else {
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('error','Email or Password are incorrect.');
        }
    }
}
