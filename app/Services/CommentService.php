<?php

namespace App\Services;

use App\Comment;
use App\Film;
use App\User;
use Illuminate\Http\UploadedFile;

class CommentService
{

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateByFilm(Film $film, $perPage = null, $page = null)
    {
        return $film->comments()->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param int $id
     *
     * @return Film
     */
    public function find(int $id)
    {
        return Comment::find($id);
    }

    /**
     * @param \App\Film $film
     * @param array $data
     *
     * @return \App\Film
     */
    public function save(Film $film, User $user, array $data)
    {
        $comment = $film->comments()->create(array_merge($data, [
            'user_id' => $user->id
        ]));

        return $comment;
    }
}