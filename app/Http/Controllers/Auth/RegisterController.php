<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'dui' => ['required', 'max:10', 'unique:usuarios'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => 'required|unique:usuarios|string|size:10',
            'telefono' => 'required|string|size:8',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
            'sexo' => 'required',
            'id_rol' => 'required',
            'usuario' => 'required|unique:usuarios|alpha_dash',
            'estado' => 'required',
            'fecha_nacimiento' => 'required',
            


        ]);
        return usuario::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'dui' => $request['dui'],
            'id_rol' => 1,
            'telefono' => $request['telefono'],
            'sexo' => $request['sexo'],
            'usuario' => $request['Usuario'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'email' => $request['email'],
            'estado' => "Activo",
            'password' => Hash::make($request['fecha_nacimiento']),
        ]);
    }
}
