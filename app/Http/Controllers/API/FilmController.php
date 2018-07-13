<?php

namespace App\Http\Controllers\API;

use App\Film;
use App\Http\Requests\FilmRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::query()->paginate(10);

        return response()->json([
            'status' => true,
            'data' => $films->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FilmRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FilmRequest $request)
    {
        $film = new Film();
        $film->fill($request->all());

        /** @var \Illuminate\Http\UploadedFile $photo */
        if ($photo = $film->photo) {
            $uploadedPath = $photo->store('film_photos');

            if (!empty($uploadedPath)) {
                $film->photo = $uploadedPath;
            }
        }

        $film->save();

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
     * @param  FilmRequest  $request
     * @param  Film         $film
     *
     * @return \Illuminate\Http\Response
     */
    public function update(FilmRequest $request, Film $film)
    {
        $film->fill($request->all());

        /** @var \Illuminate\Http\UploadedFile $photo */
        if ($photo = $film->photo) {
            $uploadedPath = $photo->store('film_photos');

            if (!empty($uploadedPath)) {
                $film->photo = $uploadedPath;
            }
        }

        $film->save();

        return response()->json([
            'status' => true,
            'data' => $film,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
