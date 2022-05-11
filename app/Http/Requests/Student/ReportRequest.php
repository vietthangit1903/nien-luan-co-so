<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'topic_id' => 'required',
            'wordFile' => 'required|mimes:doc,docx|max:4096',
            'powerPointFile' => 'required|mimes:ppt,pptx',
        ];
    }

    public function messages()
    {
        return [
            'wordFile.required' => 'Bạn phải tải file lên',
            'wordFile.mimes' => 'File bạn chọn phải là file word',
            'wordFile.max' => 'Kích thước file không vượt quá 4MB',

            'powerPointFile.required' => 'Bạn phải tải file lên',
            'powerPointFile.mimes' => 'File bạn chọn phải là file PowerPoint',

        ];
    }
}
