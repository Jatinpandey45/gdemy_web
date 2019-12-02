<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminJobPostTags extends Model
{
    protected $table = 'gk_job_post_tags';

    protected $fillable = [
        'job_tag_id',
        'job_post_id'
    ];

    public function getTags()
    {
        return $this->belongsTo(Tags::class);
    }

    public function getPost()
    {
        return $this->belongsTo(Posts::class);
    }
}
