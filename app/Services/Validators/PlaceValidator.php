<?php
namespace App\Services\Validators;

class PlaceValidator extends Validator{
    public $searchDefaults=[
        'skip'=>0,
        'limit'=>10,
        'order_by'=>'near_by',
        'order_sort'=>'desc',
    ];

    public $searchRules=[
        'order_by' => 'in:near_by,alphabet',
        'order_sort' => 'in:desc,asc',
        'skip' => 'integer',
        'limit' => 'integer|max:100',
    ];
    public $createRules=[
        'name'  => 'required|string|max:255',
        'lat'   => 'required|numeric',
        'lng'   => 'required|numeric',
    ];
    public $updateRules=[
        'name'  => 'string|max:255',
        'lat'   => 'numeric',
        'lng'   => 'numeric',
    ];
   
    public function isValidForSearch($input){
        return $this->validate($input, $this->searchRules);
    }
    public function isValidForCreate($input){
        return $this->validate($input, $this->createRules);
    }
    public function isValidForUpdate($input){
        return $this->validate($input, $this->updateRules);
    }


    public function setDefaultsSearch($input){
        return $this->setParams($input, $this->searchRules, $this->searchDefaults);
    }

}