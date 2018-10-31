<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class PlaceRequest extends BaseRequest
{
    public $defaultParams = [
        'skip'=>0,
        'limit'=>10,
        'order_by'=>'alphabet',
        'order_sort'=>'asc',
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
        $nearByOrder = config('constants.places.order_near_by');
        if ($request->input('order_by') == $nearByOrder) {
            return [
                'order_by' => 'in:near_by',
                'order_sort' => 'in:desc,asc',
                'skip' => 'integer',
                'limit' => 'integer|max:100',
                'near_by_lat' => 'required|numeric',
                'near_by_lng' => 'required|numeric',
            ];
        } else {
            return [
                'order_by' => 'in:alphabet',
                'order_sort' => 'in:desc,asc',
                'skip' => 'integer',
                'limit' => 'integer|max:100',
            ];
        }
    }
}
