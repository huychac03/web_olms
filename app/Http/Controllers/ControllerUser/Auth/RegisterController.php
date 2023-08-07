<?php

namespace App\Http\Controllers\ControllerUser\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register()
    {
        return view('user.auth.register');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ], [
            'name.required' => 'Bạn chưa điền tên',
            'name.max' => 'Tên chỉ tối đa 255 ký tự',
            'email.required' => 'Bạn chưa điền Email',
            'email.unique' => 'Email này đã được sử dụng',
            'email.max' => 'Email chỉ tối đa 255 ký tự',
            'email.email' => 'Không đúng định dạng Email',
            'password.required' => 'Bạn chưa điền mật khẩu',
            'password.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'password.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 0,
            'status' => 1
        ]);

        return redirect()->route('register')->with('success', 'Đăng ký thành công! Chúng tôi sẽ xem sét cấp quyền truy cập cho ban');
    }
}
