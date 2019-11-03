<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\MonthTags;

class Posts extends Model
{
    protected $table = "gk_posts";

    protected $fillable = [
        'post_title',
        'post_desc',
        'category_id',
        'month_id',
        'lang_id',
        'featured_image',
        'publish_at',
        'status',
        'publish_status',
        'target_device'
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function getMonth()
    {
        return $this->belongsTo(MonthTags::class);
    }
}
