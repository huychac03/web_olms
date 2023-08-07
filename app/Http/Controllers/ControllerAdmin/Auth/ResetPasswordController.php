<?php

namespace App\Http\Controllers\ControllerAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function changePassword()
    {
        return view('admin.auth.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $user = User::find(\Auth::user()->id);
        $checkPass = \Hash::check($request->currentPassword, $user->password);

        if(!$checkPass) {
            return redirect()->back()->with('danger', 'Mật khẩu hiện tại không đúng');
        }

        $data = [
            'password' => \Hash::make($request->txtPassword_confirmation),
        ];
        $user->update($data);
        \Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Mật khẩu của bạn đã thay đổi. Vui lòng đăng nhập để bắt đầu phiên làm việc !');

    }
}
