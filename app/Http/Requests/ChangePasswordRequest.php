<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'currentPassword'  =>'required',
            'txtPassword'  =>'required',
            'txtPassword_confirmation' => 'required|same:txtPassword'
        ];
    }

    public function  messages(){
        return [

            'currentPassword.required'            => 'Nhập vào mật khẩu hiện tại ',
            'txtPassword.required'                => 'Nhập vào mật khẩu mới',
            'txtPassword_confirmation.required'   => 'Nhập lại mật khẩu',
            'txtPassword_confirmation.same'       => 'Mật khẩu không trùng khớp',
        ];
    }
}
