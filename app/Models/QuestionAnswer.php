<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionAnswer extends Pivot
{
    protected $table = 'question_answers';

    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'answer_id'
    ];
}
