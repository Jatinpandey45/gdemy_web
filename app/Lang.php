<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $table = "gk_lang";

    protected $fillabel  = [
        'lan_name',
        'lang_code'  
    ];

    

}
