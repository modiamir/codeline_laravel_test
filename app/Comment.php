<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Get the film that owns the comment.
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
