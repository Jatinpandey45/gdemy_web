<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
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
        return $this->belongsToMany('App\Posts','gk_category_post','category_id','post_id');
    }


}
