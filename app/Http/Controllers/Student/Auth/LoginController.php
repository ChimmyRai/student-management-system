<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
Use App\studentuser;
class LoginController extends Controller
{

  use AuthenticatesUsers;

protected $redirectTo = '/student'; //Redirect after authenticate

public function __construct()
{
// //Notice this middleware
$this->middleware('auth.deny:admin,student,web')->except('logout');
}

public function showLoginForm() //Go web.php then you will find this route
{
  return view('auth.login', ['url' => 'student']);
}

public function login(Request $request) //Go web.php then you will find this route
{
     $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        return $this->sendLoginResponse($request);
    }

    return $this->sendFailedLoginResponse($request);

}

 public function logout(Request $request)
{
    $this->guard('student')->logout();

    $request->session()->invalidate();

    return redirect('/');
}

 protected function guard() // And now finally this is our custom guard name
{
    return Auth::guard('student');
}


}
