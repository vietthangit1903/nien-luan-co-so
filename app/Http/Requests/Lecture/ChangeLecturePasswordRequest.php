<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeLecturePasswordRequest extends FormRequest
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
            'current_password' => 'required|current_password:lecture',
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

            'current_password.required' => 'Bạn phải nhập mật khẩu hiện tại',
            'current_password.current_password' => 'Mật khẩu hiện tại của bạn không đúng',

            'password.required' => 'Bạn phải nhập mật khẩu mới',
            'password.regex' => 'Mật khẩu phải chứa chữ cái IN HOA, số, ký tự đặc biệt và tối thiểu 8 ký tự',

            'password_confirmation.same' => 'Mật khẩu nhập lại không khớp',

        ];
    }
}
