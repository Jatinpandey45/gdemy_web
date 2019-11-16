<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GkTagPost extends Model
{
    protected $table = 'gk_tag_post';

    protected $fillable = [
        'tag_id',
        'post_id'
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
