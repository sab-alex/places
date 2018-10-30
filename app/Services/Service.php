<?php
namespace App\Services;

use App\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Service{
    
    public static function ValidationException($errors){
        return new ValidationException($errors);
    }
}