<?php

namespace App\Http\Controllers\Admin\Auth;

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
    protected $redirectTo = 'login/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
      {
          $this->middleware('guest:admin');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Admin
     */
     protected function create(Request $request)
 {
     $this->validator($request->all())->validate();
      $admin= Admin::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
     ]);

   return redirect()->intended('login/admin')->with('success', 'Registered successfully, please login...!');
 }


    public function showRegistrationForm()
{
    return view('auth.register', ['url' => 'admin']);
}

/**
  * The user has been registered.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  mixed  $user
  * @return mixed
  */
 protected function registered(Request $request, $user)
 {
     return response()->json([
         'response' => 'success',
         'message' => 'Admin registered',
     ]);
 }

 /**
    * Get the guard to be used during registration.
    *
    * @return \Illuminate\Contracts\Auth\StatefulGuard
    */
   protected function guard()
   {
       return Auth::guard('admin');
   }


}
