<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuthorRequest extends Request
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
            'name' => 'required|unique:authors,name,'.$this->id,
            'keyword' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên vào',
            'name.unique'   => 'Tác giả này đã tồn tại',
            'keyword.required' => 'Vui lòng nhập từ khóa tìm kiếm',
        ];
    }
}
