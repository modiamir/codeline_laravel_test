<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['subject', 'body', 'user_id'];

    protected $visible = ['subject', 'body', 'user_id'];

    /**
     * Get the film that owns the comment.
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
