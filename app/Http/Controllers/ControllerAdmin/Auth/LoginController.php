<?php

namespace App\Http\Controllers\ControllerAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    /*
     * hien thi giao dien trang login
     */

    public function login()
    {
        return view('admin.auth.login');
    }

    /*
     * kiểm tra thông tin người dùng đăng nhập
     */
    public function postLogin(LoginRequest $request)
    {
        $user = $request->except('_token');
        $dataUser = User::where('email', $request->email)->first();
        if (!$dataUser) {
            return redirect()->back()->with('danger', 'Tên tài khoản hoặc mật khẩu không chính xác');
        }
        // kiểm tra quyền truy cập
        if ($dataUser->level == 0 ) {
            return redirect()->route('admin.login')->with('danger', 'Bạn không có quyền truy cập trang này');
        }
        // trạng thái người dùng
        if ($dataUser->status == User::STATUS_LOCKED) {
            return redirect()->back()->with('danger', 'Tài khoản của bạn đã bị khóa vui lòng liên hệ quản trị viên.');
        }

        if (Auth::attempt($user)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with('danger', 'Tên tài khoản hoặc mật khẩu không chính xác');
        }
    }

    /*
     * logout
     */
    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
