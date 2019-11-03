<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    protected $table = "gk_activity_logs";

    protected $fillable = ['payload'];
}
