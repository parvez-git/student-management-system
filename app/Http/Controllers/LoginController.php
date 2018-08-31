<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Auth;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  protected $username = 'username';
  protected $redirectTo = '/dashboard';
  protected $guard = 'web';

  public function getLogin()
  {
    if ( Auth::guard('web')->check()) {

      return redirect()->route('dashboard');
    }
    return view('login');
  }

  public function postLogin(Request $request)
  {

    if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password,'active'=>1])){

      return redirect()->route('dashboard');
    }

    return redirect()->route('/');

  }

  public function getLogout()
  {
    Auth::guard('web')->logout();
    return redirect()->route('/');

  }

}
