<?php

namespace App\Models;

class Quiz extends BaseModel
{
    protected $table = 'quiz';

    protected $fillable = [
        'id',
        'name',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_questions', 'quiz_id', 'question_id')
            ->using(QuizQuestion::class);
    }
}
