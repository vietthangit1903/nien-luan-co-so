<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
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
            'email' => 'required|email|unique:students',
            'dateOfBirth' => 'required|date',
            'subject_id' => 'required',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
            'password_confirmation' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/|same:password'
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

            'subject_id.required' => 'Bạn phải chọn bộ môn', 
            
            'password.required' => 'Bạn phải nhập mật khẩu',
            'password.regex' => 'Mật khẩu phải chứa chữ cái IN HOA, số, ký tự đặc biệt và tối thiểu 8 ký tự',

            'password_confirmation.same' => 'Mật khẩu nhập lại không khớp',

        ];
    }


}
