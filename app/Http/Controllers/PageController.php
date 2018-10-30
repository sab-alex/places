<?php

namespace App\Http\Controllers;

use App\Services\PlaceService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct() {
        $this->service = new PlaceService();
    }

    public function index()
    {
        return view('pages/index');
    }

    public function placesList(Request $request)
    {
        $places = $this->service->get($request->all());
        return view('pages/list', ['places'=>$places]);
    }
}
