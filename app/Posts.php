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
        'month_id',
        'lang_id',
        'emp_id',
        'post_slug',
        'featured_image',
        'publish_at',
        'status',
        'publish_status',
        'target_device'
    ];

   
    public function Category()
    {
        return $this->belongsToMany('App\Category', 'gk_category_post', 'post_id', 'category_id')->select(['category_name', 'category_id', 'category_slug']);
    }

    public function Month()
    {
        return $this->belongsTo('App\MonthTags', 'month_id', 'id');
    }

    public function Seo()
    {
        return $this->hasOne(PostSeo::class, 'post_id', 'id');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\Tags', 'gk_tag_post', 'post_id', 'tag_id');
    }

    public static function getCompletePostData()
    {
        return Posts::with(['Category', 'Month', 'Seo'])->orderBy('created_at', 'DESC')->paginate(config('constants.PAGINATION_LIMIT'));
    }

    public static function getLatestPost()
    {
        return Posts::with(['Category', 'Month', 'Seo'])->orderBy('id', 'Desc')->take(config('constants.PAGINATION_LIMIT'))->get();
    }

    public static function getPostById($id)
    {
        return Posts::with(['Category', 'Month', 'Seo', 'Tags'])->where(function ($query) use ($id) {
            if (is_numeric($id)) {

                $query->where('id', $id);

            } else {

                $query->where('post_slug', $id);
            }
        })->first();
    }
}
