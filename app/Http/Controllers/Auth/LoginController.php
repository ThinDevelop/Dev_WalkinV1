<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

        /**
     * determine the redirect URL after login
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function redirectTo()
    {

        $user = Auth::user();
        $redirect_to = route('login');

        if ($user->hasRole('root')) {
            $redirect_to = route('root.dashboard');
        }elseif($user->hasRole('super-admin')){
            $redirect_to = route('superadmin.dashboard');
        }elseif($user->hasRole('admin')){
            $redirect_to = route('admin.dashboard');
        }

        return $redirect_to;
    }
    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
}
