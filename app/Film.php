<?php

namespace App;

use App\Observers\FilmObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Film extends Model
{
    use HasSlug;
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
        'photo_url',
        'slug',
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

    public function getPhotoUrlAttribute()
    {
        return Storage::url($this->photo);
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), ['photo_url' => $this->photo_url]);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug');
    }
}
