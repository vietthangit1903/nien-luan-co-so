<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class AddTopicRequest extends FormRequest
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
            'topic_type_id' => 'required',
            'name' => 'required|max:250',
            'number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'topic_type_id.required' => 'Bạn phải chọn loại niên luận',
            'name.required' => 'Bạn phải nhập tên niên luận',
            'name.max' => 'Tên niên luận không được vượt quá 250 ký tự',
            'number.required' => 'Bạn phải chọn số lượng sinh viên tối đa',
        ];
    }
}
