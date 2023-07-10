<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends BaseModel
{
    protected $table = 'user_answers';

    protected $fillable = [
        'id',
        'submission_id',
        'question_id',
        'answer_id',
        'term_id',
        'topic_id'
    ];
}
