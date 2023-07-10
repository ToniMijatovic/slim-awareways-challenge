<?php

namespace App\Models;

class Client extends BaseModel
{
    protected $table = 'client';

    protected $fillable = [
        'id',
        'name'
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
