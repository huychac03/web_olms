<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if (isset($request->action)) {
            return [
                'txtName' => 'required|unique:stories,name,'.$this->id,
                'intCategory' => 'required',
                'intAuthor'   => 'required',
                'txtSource'   => 'required',
                'txtContent'   => 'required',
                'fImages' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:9072'],

            ];
        }
        return [
            'txtName' => 'required|unique:stories,name,'.$this->id,
            'intCategory' => 'required',
            'intAuthor'   => 'required',
            'txtSource'   => 'required',
            'txtContent'   => 'required',
            'fImages' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:9072'],

        ];
    }

    public function messages()
    {
        return [
            'txtName.required'    => 'Bạn phải nhập tên truyện !',
            'txtName.unique'    => 'Bài viết này đã tồn tại !',
            'intCategory.required'=> 'Bạn phải chọn chuyên mục !',
            'txtSource.required'=> 'Bạn phải cần nhập vào nguồn gốc truyện !',
            'txtContent.required'=> 'Bạn phải cần nhập vào nội dung mô tả truyện !',
            'intAuthor.required'  => 'Bạn phải chọn tác giả !',
            'fImages.required' => 'Ảnh đại diện không được phép trống',
            'fImages.image' => 'Định dạng hình ảnh không đúng',
            'fImages.mimes' => 'Dung lượng ảnh quá lớn',
        ];
    }
}
