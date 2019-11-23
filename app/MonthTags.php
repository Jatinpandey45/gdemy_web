<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthTags extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "gk_month_tags";

    protected $fillable = [
        'month_name',
        'month_slug',
        'month_desc'
    ];

    

    
}
