<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLectureRequest extends FormRequest
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
            'subject' => 'required',
            'academic' => 'required',
            'position' => 'required',
            'role' => 'required'
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

            'subject.required' => 'Bạn phải chọn bộ môn', 

            'academic.required' => 'Bạn phải chọn học hàm', 

            'position.required' => 'Bạn phải chọn chức vụ', 

            'role.required' => 'Bạn phải chọn phân quyền'
        ];
    }
}
