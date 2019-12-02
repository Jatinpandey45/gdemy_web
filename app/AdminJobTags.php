<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdminJobTags extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = "gk_job_tags";

    protected $fillable = [
        'lang_id',
        'tag_name',
        'tag_slug',
        'tag_desc'
    ];

    public function getLang()
    {
        return $this->belongsTo(Lang::class);
    }

    public static function searchTags($search)
    {
        return AdminJobTags::
        where('tag_name', 'LIKE', "%{$search}%")
        ->orWhere('tag_slug', 'LIKE', "%{$search}%")
        ->get();
    }
}
