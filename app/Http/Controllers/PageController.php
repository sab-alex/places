<?php

namespace App\Http\Controllers;

use App\Http\Requests\getPlaceRequest;
use App\Repositories\PlaceRepository;

class PageController extends Controller
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function index()
    {
        return view('pages/index');
    }

    public function placesList(getPlaceRequest $request)
    {
        $validated = $request->validated();
        $places = $this->placeRepository->get($validated);
        return view('pages/list', ['places' => $places]);
    }
}
