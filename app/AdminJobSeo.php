<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminJobPosts;

class AdminJobSeo extends Model
{
    protected $table = "gk_job_post_seo";

    protected $fillable = [
        'job_post_id',
        'titile',
        'description',
        'keyword'
    ];

    public function getpost()
    {
        return $this->belongsTo(AdminJobPosts::class,'job_post_id','id');
    }
}
