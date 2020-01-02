<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\AdminJobSeo;
use App\AdminJobTags;

class AdminJobPosts extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "gk_job_posts";

    protected $fillable = [
        'post_title',
        'post_desc',
        'lang_id',
        'emp_id',
        'post_slug',
        'featured_image',
        'publish_at',
        'status',
        'publish_status',
        'target_device'
    ];


    public function Seo()
    {
        return $this->hasOne(AdminJobSeo::class, 'job_post_id', 'id');
    }

    public function Tags()
    {
        return $this->belongsToMany(AdminJobTags::class, 'gk_job_post_tags', 'job_post_id', 'job_tag_id');
    }

    public static function getLatestPost()
    {
        return AdminJobPosts::with(['Seo','Tags'])->orderBy('id', 'Desc')->take(config('constants.PAGINATION_LIMIT'))->get();
    }

    public static function getPostById($id)
    {
        return AdminJobPosts::with(['Seo', 'Tags'])->where(function ($query) use ($id) {
            if (is_numeric($id)) {

                $query->where('id', $id);

            } else {

                $query->where('post_slug', $id);
            }
        })->first();
    }
}
