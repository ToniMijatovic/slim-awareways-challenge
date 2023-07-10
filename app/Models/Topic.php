<?php

namespace App\Models;

class Topic extends BaseModel
{
    protected $table = 'topic';

    protected $fillable = [
        'id',
        'text'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
