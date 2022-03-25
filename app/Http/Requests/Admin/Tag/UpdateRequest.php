<?php

namespace App\Http\Requests\Admin\Tag;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:40|unique:tags'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Заголовок обязателен для заполнения',
            'title.min'=>'Минимальная длинна заголовка - 3 символа',
            'title.max'=>'Максимальная длинна заголовка - 50 символов',
            'title.unique'=>'Такой тег уже есть',
        ];
    }
}
