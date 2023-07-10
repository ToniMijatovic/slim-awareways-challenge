<?php

namespace App\Models;

class Question extends BaseModel
{
    protected $table = 'question';

    protected $fillable = [
        'id',
        'quiz_id',
        'text',
        'type'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'question_answers', 'question_id', 'answer_id')
            ->using(QuestionAnswer::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }
}
