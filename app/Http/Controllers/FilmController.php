<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Http\Requests\Film\StoreRequest;
use App\Services\FilmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FilmService $filmService)
    {
        if ($request->ajax()) {
            $films = $filmService->paginate(
                $request->get('per_page'),
                $request->get('page')
            );

            return response()->json([
                'status' => true,
                'data' => $films->toArray(),
            ]);
        } else {
            return view('film/index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::query()->select(['id', 'name'])->get()->toArray();

        return view('film/create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FilmService $filmService)
    {
        $film = $filmService->findBySlug($id);
        $userId = ($user = Auth::user()) ? $user->id : null;

        return view('film/show', compact('film', 'userId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
