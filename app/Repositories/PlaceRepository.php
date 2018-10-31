<?php

namespace App\Repositories;

use App\Place;

class PlaceRepository
{
    /**
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get(Array $input)
    {
        $query = (new Place)->newQuery();
        if ($input['order_by'] == config('constants.places.order_alphabet')) {
            $query->orderBy('name', $input['order_sort']);
        } else {
            $query->selectRaw("*, (6371.4 * acos( cos( radians('".$input['near_by_lat']."') ) *
                                cos( radians( lat ) ) *
                                cos( radians( lng ) -
                                radians('".$input['near_by_lng']."') ) +
                                sin( radians('".$input['near_by_lat']."') ) *
                                sin( radians( lat ) ) ) )
                                AS distance");
            $query->orderBy('distance', $input['order_sort']);
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