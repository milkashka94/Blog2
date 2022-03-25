<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:40|unique:users',
            'email' => 'required|string|email|unique:users',
            'role_id' => 'nullable|string|exists:roles,id',
            'password' => 'required|string|min:8|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Логин обязателен для заполнения',
            'name.min'=>'Минимальная длинна логина - 3 символа',
            'name.max'=>'Максимальная длинна логина - 40 символов',
            'name.unique'=>'Такой логин уже есть',
            'email.required'=>'Email обязателен для заполнения',
            'email.email'=>'Значения поля не является email-ом',
            'email.unique'=>'Такой email уже есть',
            'role_id.exists'=>'Такой роли не существует',
            'password.min'=>'Минимальная длинна пароля - 8 символа',
            'password.max'=>'Максимальная длинна пароля - 40 символов',
            'password.required'=>'Пароль обязателен для заполнения',
        ];
    }
}
