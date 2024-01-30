<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\studentuser;
use App\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
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
    protected $redirectTo = 'login/student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
  //$this->middleware('guest:admin,student,web');
$this->middleware('auth.deny:admin,student,web');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:studentusers'],
            'student_code'=>['required','string', 'unique:studentusers','regex:/^[0-9]+(\.[0-9]+)+$/'],
            'class' => ['required','max:255'],
            'section' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\studentuser
     */
     protected function create(Request $request)
 {
     $this->validator($request->all())->validate();

     studentuser::create([
         'name' => $request->name,
         'email' => $request->email,
         'student_code'=> $request->student_code,
         'class'=> $request->class,
          'section'=> $request->section,
          'password' => Hash::make($request->password),
     ]);
     return redirect()->intended('login/student')->with('success', 'Registered successfully, please login...!');
 }


    public function showRegistrationForm()
{
    return view('auth.registerstudent', ['url' => 'student']);
}



}
