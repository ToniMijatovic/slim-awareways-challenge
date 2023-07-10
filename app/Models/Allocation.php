<?php

namespace App\Models;

class Allocation extends BaseModel
{
    protected $table = 'allocation';

    protected $fillable = [
        'question_id',
        'term_id',
        'topic_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
