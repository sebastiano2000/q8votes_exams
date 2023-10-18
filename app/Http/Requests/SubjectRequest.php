<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'questions_count' => 'required|numeric',
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'يجب عليك إدخال اسم المادة',
            'questions_count.required' => 'يجب عليك إدخال عدد الأسئلة',
        ];
    }
}
