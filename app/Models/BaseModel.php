<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = false;

    /**
     * Check if a model exists based on the provided ID.
     *
     * @param int $id
     * @return bool
     */
    public static function existsById($id): bool
    {
        return self::where('id', $id)->exists();
    }
}
