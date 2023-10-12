<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => ['required', 'string', 'exists:users,phone'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'يجب عليك إدخال رقم الهاتف',
            'phone.exists' => 'رقم الهاتف غير مسجل لدينا',
        ];
    }
}
