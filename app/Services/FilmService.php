<?php

namespace App\Services;

use App\Film;
use Illuminate\Http\UploadedFile;

class FilmService
{

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = null, $page = null)
    {
        return Film::query()->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param int $id
     *
     * @return Film
     */
    public function find(int $id)
    {
        return Film::find($id);
    }

    public function findBySlug($slug)
    {
        return Film::query()->where('slug', '=', $slug)->firstOrFail();
    }

    /**
     * @param \App\Film $film
     * @param array $data
     *
     * @return \App\Film
     */
    public function save(Film $film, array $data)
    {
        $genres = null;
        if (isset($data['genres'])) {
            $genres = $data['genres'];
            unset($data['genres']);
        }

        $film->fill($data);

        /** @var \Illuminate\Http\UploadedFile $photo */
        if ($film->photo instanceof UploadedFile) {
            $photo = $film->photo;
            $uploadedPath = $photo->store('film_photos', ['disk' => 'public']);

            if (!empty($uploadedPath)) {
                $film->photo = $uploadedPath;
            }
        }

        $film->save();

        if ($genres) {
            $film->genres()->sync($genres);
        }

        return $film;
    }

    /**
     * @param array $data
     *
     * @return \App\Film
     */
    public function create(array $data)
    {
        $film = new Film();

        return $this->save($film, $data);
    }

    /**
     * @param $film
     *
     * @return bool|null
     */
    public function delete($film)
    {
        if (!$film instanceof Film) {
            $film = $this->find($film);
        }

        return $film->delete();
    }
}