<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequst;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(LoginRequst $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $check = User::where('email', $request->email)->first();
      
            if($check->status == 1){
                if (Auth::guard('web')->attempt($credentials)) {
                    session()->flash('success', 'Welcome to Banglar Haat');
                    return redirect()->route('admin.dashboard');
                }
                session()->flash('error', 'Invalid credentials');
            }else{
                session()->flash('warning', 'Your account has been disabled. Please contact support.');
            }
        return redirect()->route('login');
    }



    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');

    }
}
