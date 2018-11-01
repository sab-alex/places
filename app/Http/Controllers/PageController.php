<?php

namespace App\Http\Controllers;

use App\Http\Requests\getPlaceRequest;
use App\Http\Requests\PlaceRequest;
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

    public function placesList(PlaceRequest $request)
    {
        $places = [];
        try {
            $places = $this->placeRepository->get($request->validated());
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
        return view('pages/list', ['places' => $places]);
    }
}
