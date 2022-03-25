<?php

namespace App\Http\Requests\User\Comment;

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
        if ((Auth::check()) and (Auth::user()->hasPermission('update-comments'))) {
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
            'text.min'=>'Минимальная длинна текста - 5 символа',
            'text.max'=>'Максимальная длинна текста - 200 символов',
        ];
    }
}
