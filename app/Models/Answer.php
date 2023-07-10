<?php

namespace App\Models;

class Answer extends BaseModel
{
    protected $table = 'answer';

    protected $fillable = [
        'question_id',
        'text',
        'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
