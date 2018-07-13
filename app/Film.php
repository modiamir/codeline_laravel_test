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
        'photo',
        'genres',
    ];

    protected $fillable = [
        'id',
        'name',
        'description',
        'release_date',
        'rating',
        'ticket_price',
        'country',
        'photo',
        'genres',
    ];

    protected $perPage = 10;

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
        return $this->belongsToMany(Genre::class, 'films_genres');
    }
}
