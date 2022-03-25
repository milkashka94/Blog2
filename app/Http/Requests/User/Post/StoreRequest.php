<?php

namespace App\Http\Requests\User\Post;

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
        if ((Auth::check()) and (Auth::user()->hasPermission('creation-posts'))) {
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
            'title' => 'required|string|min:3|max:80',
            'description' => 'required|string|min:3',
            'text' => 'required|string|min:3',
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Заголовок обязателен для заполнения',
            'title.min'=>'Минимальная длинна заголовка - 3 символа',
            'title.max'=>'Максимальная длинна заголовка - 80 символов',
            'description.required'=>'Краткое содержания обязательно для заполнения',
            'description.min'=>'Минимальная длинна краткого содержания - 3 символа',
            'text.required'=>'Текст обязателен для заполнения',
            'text.min'=>'Минимальная длинна текста - 3 символа',
            'category_id.required'=>'Обязательно указывать категорию',
            'category_id.exists'=>'Такой категории не существует',
            'image.image'=>'Обложка должна быть изображением',
        ];
    }
}
