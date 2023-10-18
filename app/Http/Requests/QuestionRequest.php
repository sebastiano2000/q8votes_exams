<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'title.0' => 'required',
            'title.1' => 'required',
            'title.2' => 'required',
            'title.3' => 'required',
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'يجب عليك إدخال رأس السؤال',
            'title.0.required' => 'يجب عليك إدخال الاجابة 1',
            'title.1.required' => 'يجب عليك إدخال الاجابة 2',
            'title.2.required' => 'يجب عليك إدخال الاجابة 3',
            'title.3.required' => 'يجب عليك إدخال الاجابة 4',
        ];
    }
}
