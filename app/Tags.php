<?php

namespace App;
use App\Lang;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = "gk_tags";

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
}