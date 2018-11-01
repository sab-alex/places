<?php

namespace App\Repositories;

use App\Exceptions\AppException;
use App\Place;

class PlaceRepository
{
    const ORDER_ALPHABET = 'alphabet';
    const ORDER_NEAR_BY = 'near_by';
    const ORDER_SORT = 'asc';

    /**
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get(Array $input)
    {
        $order_by = array_get($input, 'order_by', self::ORDER_ALPHABET);
        $order_sort = array_get($input, 'order_sort', self::ORDER_SORT);
        $near_by_lat = array_get($input, 'near_by_lat');
        $near_by_lng = array_get($input, 'near_by_lng');

        $query = (new Place)->newQuery();

        if ($order_by == self::ORDER_ALPHABET) {
            $query->orderBy('name', $order_sort);
        } elseif ($order_by == self::ORDER_NEAR_BY && $near_by_lat && $near_by_lng) {
            $query->selectRaw("*, (6371.4 * acos( cos( radians('".$near_by_lat."') ) *
                                cos( radians( lat ) ) *
                                cos( radians( lng ) -
                                radians('".$near_by_lng."') ) +
                                sin( radians('".$near_by_lat."') ) *
                                sin( radians( lat ) ) ) )
                                AS distance");
            $query->orderBy('distance', $order_sort);
        } else {
            throw new AppException('Doesn\'t have all params for request');
        }

        return $query->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(Array $data)
    {
        return Place::create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(Array $data, $id)
    {
        $place = Place::findOrFail($id);
        $place->update($data);
        return $place->fresh();
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $status = $place->delete();
        return ['status' => $status];
    }
}