<?php

namespace App\Http\Controllers;

use App\Film;
use App\Http\Requests\Comment\StoreRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FilmCommentController extends Controller
{
    public function index(Film $film, Request $request, CommentService $commentService)
    {
        $comments = $commentService->paginateByFilm(
            $film,
            $request->get('per_page'),
            $request->get('page')
        );

        return response()->json([
            'status' => true,
            'data' => $comments->toArray(),
        ]);
    }

    public function store(Film $film, StoreRequest $request, CommentService $commentService)
    {
        $comment = $commentService->save($film, Auth::user(), $request->all());

        return response()->json([
            'status' => true,
            'data' => $comment,
        ]);
    }
}
