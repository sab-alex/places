<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Repositories\PlaceRepository;

class PlaceResourceController extends Controller
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    /**
     * PlaceResourceController constructor.
     *
     * @param PlaceRepository $placeRepository
     */
    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * @param PlaceRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(PlaceRequest $request)
    {
        $data = $this->placeRepository->get($request->validated());
        return response($data);
    }

    /**
     * @param StorePlaceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlaceRequest $request)
    {
        $data = $this->placeRepository->store($request->validated());
        return response($data);
    }

    /**
     * @param UpdatePlaceRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaceRequest $request, $id)
    {
        $data =  $this->placeRepository->update($request->validated(), $id);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->placeRepository->destroy($id);
        return response($data);
    }
}
