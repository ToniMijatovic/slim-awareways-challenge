<?php

namespace App\Models;

class Term extends BaseModel
{
    protected $table = 'term';

    protected $fillable = [
        'id',
        'text'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
