<?php
namespace App\Services\Validators;
use Validator as V;
abstract class Validator{

    protected $errors;

    public function validate($input, $rules){
        $validator=V::make($input,$rules);
        if($validator->fails()){
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    public function errors(){
        return $this->errors;
    }



    protected function setParams($input, $rules, $defaults){
        $output = [];
        foreach ($rules as $key => $value) {
            if (isset($input[$key])) {
                $output[$key] = $input[$key];
            } else if (isset($defaults[$key])) {
                $output[$key] = $defaults[$key];
            }
        }
        return $output;
    }
}