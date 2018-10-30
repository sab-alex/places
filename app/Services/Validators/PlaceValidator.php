<?php
namespace App\Services\Validators;

class PlaceValidator extends Validator{
    public $searchDefaults=[
        'skip'=>0,
        'limit'=>10,
        'order_by'=>'alphabet',
        'order_sort'=>'asc',
    ];

    public $searchRules=[
        'order_by' => 'in:near_by,alphabet',
        'order_sort' => 'in:desc,asc',
        'skip' => 'integer',
        'limit' => 'integer|max:100',
    ];
    public $searchRulesNearBy=[
        'order_by' => 'in:near_by',
        'order_sort' => 'in:desc,asc',
        'skip' => 'integer',
        'limit' => 'integer|max:100',
        'near_by_lat' => 'required|numeric',
        'near_by_lng' => 'required|numeric',
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
        if(isset($input['order_by']) && $input['order_by'] == "near_by") {
            return $this->validate($input, $this->searchRulesNearBy);
        } else {
            return $this->validate($input, $this->searchRules);
        }

    }
    public function isValidForCreate($input){
        return $this->validate($input, $this->createRules);
    }
    public function isValidForUpdate($input){
        return $this->validate($input, $this->updateRules);
    }


    public function setDefaultsSearch($input) {
        if(isset($input['order_by']) && $input['order_by'] == "near_by") {
            return $this->setParams($input, $this->searchRulesNearBy, $this->searchDefaults);
        } else {
            return $this->setParams($input, $this->searchRules, $this->searchDefaults);
        }

    }

}