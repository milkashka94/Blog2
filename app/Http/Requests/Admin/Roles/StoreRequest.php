<?php

namespace App\Http\Requests\Admin\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ((Auth::check()) and (Auth::user()->hasPermission('roles-management'))) {
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
            'title' => 'required|string|min:3|max:50|unique:roles'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Заголовок обязателен для заполнения',
            'title.min'=>'Минимальная длинна заголовка - 3 символа',
            'title.max'=>'Максимальная длинна заголовка - 50 символов',
            'title.unique'=>'Такая роль уже есть',
        ];
    }
}
