<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSemesterRequest extends FormRequest
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
            'time_start_give_topic' => 'required|date',
            'time_end_give_topic' => 'required|date',
            'time_start_reg_topic' => 'required|date',
            'time_end_reg_topic' => 'required|date',
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
            'time_start_give_topic.required' => 'Bạn phải nhập ngày giảng viên bắt đầu nhập niên luận',
            'time_start_give_topic.date' => 'Ngày sai định dạng',

            'time_end_give_topic.required' => 'Bạn phải nhập ngày giảng viên kết thúc nhập niên luận',
            'time_end_give_topic.date' => 'Ngày sai định dạng',

            'time_start_reg_topic.required' => 'Bạn phải nhập ngày sinh viên bắt đầu đăng ký niên luận',
            'time_start_reg_topic.date' => 'Ngày sai định dạng',

            'time_end_reg_topic.required' => 'Bạn phải nhập ngày sinh viên kết thúc đăng ký niên luận',
            'time_end_reg_topic.date' => 'Ngày sai định dạng',

        ];
    }
}
