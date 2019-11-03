<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;

class PostSeo extends Model
{
    protected $table = "gk_post_seo";

    protected $fillable = [
        'post_id',
        'titile',
        'description',
        'keyword'
    ];

    public function getpost()
    {
        return $this->belongsTo(Posts::class);
    }
}
