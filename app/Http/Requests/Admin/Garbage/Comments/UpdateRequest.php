<?php

namespace App\Http\Requests\Admin\Garbage\Comments;

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
        if ((Auth::check()) and (Auth::user()->hasPermission('basket-access'))) {
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
            'text' => 'required|string|min:5|max:200'
        ];
    }

    public function messages()
    {
        return [
            'text.required'=>'Текст обязателен для заполнения',
            'text.min'=>'Минимальная длинна текста - 3 символа',
            'text.max'=>'Максимальная длинна текста - 50 символов',
        ];
    }
}
