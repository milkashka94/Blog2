<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title'];    //установка поля title доступным для заполнения

    public function posts()
    {
        //установка связи тегов с постами
        return $this->belongsToMany(Post::class);
    }
}
