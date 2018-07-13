<?php

namespace App\Http\Controllers\API;

use App\Film;
use App\Http\Requests\Film\StoreRequest;
use App\Http\Requests\Film\UpdateRequest;
use App\Services\FilmService;
use App\Http\Controllers\Controller;

class FilmController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param \App\Services\FilmService $filmService
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilmService $filmService)
    {
        $films = $filmService->paginate();

        return response()->json([
            'status' => true,
            'data' => $films->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     *
     * @param \App\Services\FilmService $filmService
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, FilmService $filmService)
    {
        $film = $filmService->create($request->all());

        return response()->json([
            'status' => true,
            'data' => $film
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Film $film
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return response([
            'status' => true,
            'data' => $film,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Film\UpdateRequest $request
     * @param  Film $film
     *
     * @param \App\Services\FilmService $filmService
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Film $film, FilmService $filmService)
    {
        $film = $filmService->save($film, $request->all());

        return response()->json([
            'status' => true,
            'data' => $film,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Film $film
     * @param \App\Services\FilmService $filmService
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Film $film, FilmService $filmService)
    {
        $filmService->delete($film);

        return response()->json([
            'status' => true,
        ]);
    }
}
