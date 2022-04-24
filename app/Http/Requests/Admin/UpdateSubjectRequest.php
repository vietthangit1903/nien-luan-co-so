<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required|unique:subject|max:100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'Trường id không tồn tại',
            'name.required' => 'Bạn phải nhập tên bộ môn',
            'name.unique' => 'Bộ môn đã tồn tại, vui lòng nhập tên bộ môn khác',
            'name.max'=>'Tên bộ môn không quá 100 ký tự'
        ];
    }
}
