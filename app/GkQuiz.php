<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GkQuiz extends Model
{

    use SoftDeletes;

    protected $table = "gk_quiz";

    protected $fillable = [
        'title',
        'question',
        'question_slug',
        'schedule_type',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_option',
        'code_sniff',
        'explanation',
        'publish_at',
        'category_id',
        'target_device'
    ];


    
}
