<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class ProgressReportRequest extends FormRequest
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
            'progress-report-content' => 'required|max:250'
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
            'progress-report-content.required' => 'Vui lòng nhập nội dung báo cáo tiến độ',
            'progress-report-content.max' => 'Báo cáo tiến độ không vượt quá 250 ký tự',
        ];
    }
}
