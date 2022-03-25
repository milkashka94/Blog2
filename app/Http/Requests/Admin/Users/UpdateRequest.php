<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ((Auth::check()) and (Auth::user()->hasPermission('edit-users'))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|string|email',
            'role_id' => 'nullable|string|exists:roles,id',
            'password' => 'nullable|string|min:8|max:40'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Логин обязателен для заполнения',
            'name.min'=>'Минимальная длинна логина - 3 символа',
            'name.max'=>'Максимальная длинна логина - 40 символов',
            'email.required'=>'Email обязателен для заполнения',
            'email.email'=>'Значения поля не является email-ом',
            'role_id.exists'=>'Такой роли не существует',
            'password.min'=>'Минимальная длинна пароля - 8 символа',
            'password.max'=>'Максимальная длинна пароля - 40 символов',
        ];
    }
}
