<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $visible = [
        'id',
        'name',
        'description',
        'release_date',
        'rating',
        'ticket_price',
        'country',
        'photo'
    ];

    protected $fillable = [
        'id',
        'name',
        'description',
        'release_date',
        'rating',
        'ticket_price',
        'country',
        'photo'
    ];

    /**
     * Get the comments for the film.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The genres that belong to the film.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
