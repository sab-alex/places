<?php

namespace App\Services;
use App\Services\Validators\PlaceValidator;
use App\Place;

class PlaceService  extends Service{

    public function __construct(){
        $this->validator=new PlaceValidator();
    }


    /**
     * @param array $input
     * @return mixed
     * @throws \App\Exceptions\ValidationException
     */
    public function get(Array $input)
    {

        if(!$this->validator->isValidForSearch($input))
            throw self::ValidationException($this->validator->errors());

        $input = $this->validator->setDefaultsSearch($input);

        $query = (new Place)->newQuery();
        //dd($input);
        if($input['order_by'] == 'alphabet') {
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
     * @return Place
     * @throws \App\Exceptions\ValidationException
     */
    public function store(Array $data)
    {
        if(!$this->validator->isValidForCreate($data))
            throw self::ValidationException($this->validator->errors());

        return Place::create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     * @throws ModelNotFoundException
     * @throws \App\Exceptions\ValidationException
     * @throws \Exception
     */
    public function update(Array $data, $id)
    {
        try
        {
            $place = Place::findOrFail($id);
        }
        catch (ModelNotFoundException $e)
        {
            throw $e;
        }

        if(!$this->validator->isValidForUpdate($data))
            throw self::ValidationException($this->validator->errors());

        $place->update($data);
        return $place->fresh();
    }

    /**
     * @param $id
     * @return array
     * @throws ModelNotFoundException
     * @throws \Exception
     */
    public function destroy($id)
    {
        try
        {
            $place = Place::findOrFail($id);
        }
        catch (ModelNotFoundException $e)
        {
            throw $e;
        }

        $status = $place->delete();
        return ['status' => $status];
    }


}