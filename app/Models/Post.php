<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'text',
        'category_id',
        'image',
        'author_id',
        'is_published',
        'updated_by'];

    public function category()
    {
        //установка связи поста и категории
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags()
    {
        //установка связи поста и тегов
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function author()
    {
        //установка связи поста и пользователя
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function editor()
    {
        //установка связи поста и пользователя
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function comments()
    {
        //установка связи поста и комментов
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

}
