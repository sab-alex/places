<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public $defaultParams = [];

    public function validated()
    {
        $validated = $this->getValidatorInstance()->validate();
        foreach ($this->defaultParams as $key => $value) {
            if (!isset($validated[$key])) {
                $validated[$key] = $value;
            }
        }
        return $validated;
    }
}
