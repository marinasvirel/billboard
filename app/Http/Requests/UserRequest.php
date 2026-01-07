<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha', 'min:2'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:3',],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Обязательное поле',
            'name.alpha' => 'Только буквы',
            'name.min' => 'Не менее 2 символов',
            'email.required' => 'Обязательное поле',
            'email.email' => 'Поле должно содержать E-mail',
            'email.unique' => 'Этот e-mail уже зарегистрирован',
            'password.required' => 'Обязательное поле',
            'password.min' => 'Не менее 3 символов',
        ];
    }
}
