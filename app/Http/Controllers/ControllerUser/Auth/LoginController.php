<?php

namespace App\Http\Controllers\ControllerUser\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('user.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Bạn chưa điền Email',
            'email.email' => 'Không đúng định dạng Email',
            'password.required' => 'Bạn chưa điền mật khẩu',
        ]);

        $user = $request->except('_token');
        if (\Auth::guard('nd')->attempt($user)) {
            return redirect()->route('user.home');
        } else {
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể đăng nhập');
        }
    }

    public function logout()
    {
        \Auth::guard('nd')->logout();
        return redirect()->to('/');
    }
}
