<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\MonthTags;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "gk_posts";

    protected $fillable = [
        'post_title',
        'post_desc',
        'category_id',
        'month_id',
        'lang_id',
        'emp_id',
        'featured_image',
        'publish_at',
        'status',
        'publish_status',
        'target_device'
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function getMonth()
    {
        return $this->belongsTo('App\MonthTags','month_id','id');
    }
}
