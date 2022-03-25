<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'post_id', 'text', 'updated_by'];   //установка полей доступными для заполнения

    public function user()
    {
        //установка связи комментов и пользователя
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function editor()
    {
        //установка связи комментов и пользователя
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function post()
    {
        //установка связи комментов и поста
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
