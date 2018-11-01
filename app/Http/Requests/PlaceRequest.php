<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Repositories\PlaceRepository;

class PlaceRequest extends BaseRequest
{

    public $defaultParams = [
        'skip' => 0,
        'limit' => 10,
        'order_by' => PlaceRepository::ORDER_ALPHABET,
        'order_sort' => PlaceRepository::ORDER_SORT,
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     *
     * @return array
     */
    public function rules(Request $request)
    {

        if ($request->input('order_by') == PlaceRepository::ORDER_NEAR_BY) {
            return [
                'order_by' => 'in:'.PlaceRepository::ORDER_NEAR_BY,
                'order_sort' => 'in:desc,asc',
                'skip' => 'integer',
                'limit' => 'integer|max:100',
                'near_by_lat' => 'required|numeric',
                'near_by_lng' => 'required|numeric',
            ];
        } else {
            return [
                'order_by' => 'in:'.PlaceRepository::ORDER_ALPHABET,
                'order_sort' => 'in:desc,asc',
                'skip' => 'integer',
                'limit' => 'integer|max:100',
            ];
        }
    }
}
