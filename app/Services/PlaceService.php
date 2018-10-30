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