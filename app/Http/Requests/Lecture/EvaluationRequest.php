<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
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
            'report_id' => 'required',
            'topic_id' => 'required',
            'marks' => 'required|between:0,10',
            'evaluation_content' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'marks.required' => 'Vui lòng nhập điểm',
            'marks.between' => 'Điểm nằm trong khoảng từ 0 -> 10',
            'evaluation_content.required' => 'Vui lòng nhập nhận xét',
            'evaluation_content.max' => 'Nội dung nhận xét không quá 500 ký tự',
        ];
    }
}
