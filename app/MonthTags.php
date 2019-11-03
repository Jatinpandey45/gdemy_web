<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthTags extends Model
{
    protected $table = "gk_month_tags";

    protected $fillable = [
        'month_name',
        'month_slug',
        'month_desc'
    ];

    
}
