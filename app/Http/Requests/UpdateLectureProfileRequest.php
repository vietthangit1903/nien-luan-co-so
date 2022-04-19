<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLectureProfileRequest extends FormRequest
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
            'fullName' => 'required',
            'email' => 'required|email|unique:lectures',
            'dateOfBirth' => 'required|date'
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
            'fullName.required' => 'Bạn phải nhập họ và tên',

            'email.required' => 'Bạn phải nhập email',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã tồn tại, vui lòng nhập email khác',
            
            'dateOfBirth.required' => 'Bạn phải nhập ngày sinh',
            'dateOfBirth.date' => 'Sai định dạng ngày sinh',
        ];
    }
}
