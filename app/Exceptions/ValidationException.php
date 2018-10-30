<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends \Illuminate\Validation\ValidationException {
    public $code = 400;
}
