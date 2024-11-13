<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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


    public function showLoginForm()
    {
        if(!auth()->check()){
            if(request()->is('admin/login')){
                return view('auth.admin-login');
            }else{
                return view('auth.login');
            }
        }
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            session()->regenerate();
            $this->clearLoginAttempts($request);

            $user = auth()->user();

            if ($user->is_super_admin) {
                // Admin login route check
                if(url()->previous() == route('admin.login')) {
                    session()->flash('success', 'You are logged in with administrator rights.');
                    return redirect()->intended('admin/dashboard');
                } else {
                    // Redirect to admin login if accessed from user login route
                    auth()->logout();
                    session()->flash('error', 'Access Denied.');
                    return redirect()->route('admin.login');
                }
            } else {
                // Normal user login route check gareko
                if(url()->previous() == route('login')) {
                    session()->flash('success', 'You are logged in successfully.');
                    return redirect()->intended('user/dashboard');
                } else {
                    // Redirect to user login if accessed from admin login route
                    auth()->logout();
                    session()->flash('error', 'Access Denied.');
                    return redirect()->route('login');
                }
            }
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

}
