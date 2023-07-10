<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuizQuestion extends Pivot
{
    protected $table = 'quiz_questions';

    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'question_id'
    ];
}
