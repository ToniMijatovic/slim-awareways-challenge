<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends BaseModel
{
    protected $table = 'submission';

    protected $fillable = [
        'id',
        'quiz_id',
        'client_id',
        'date'
    ];
}
