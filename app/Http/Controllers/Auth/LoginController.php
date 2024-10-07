<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        $login = request()->input('login');

        // Verificar si es email
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $login_type = 'email';
        } 
        // Verificar si es DUI (asumiendo un formato específico, ajusta según tu necesidad)
        elseif (preg_match('/^\d{8}-\d{1}$/', $login)) {
            $login_type = 'dui';
        } 
        // Verificar si es NIT (asumiendo un formato específico, ajusta según tu necesidad)
        else {
            $login_type = 'minoridad';
        } 
    
        
        
        request()->merge([
            $login_type => request()->input('login')
        ]);

        return $login_type;
    }
}
