<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;

class Category extends Model
{
    protected $table = "gk_category";

    protected $fillable = [
        'lang_id',
        'category_name',
        'category_slug',
        'category_description',
        'category_icon',
        'status'
    ];

    public function post()
    {
        return $this->hasOne(Posts::class);
    }
}
