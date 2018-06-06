<?php

namespace Modules\Blog\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'slug', 'display_name'];
    protected $fillable = ['name', 'slug', 'display_name'];
    protected $table = 'blog__categories';

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
