<?php

namespace App\Validator;

use Carbon\Carbon;
use Illuminate\Validation\Validator;


/**
 * Description of CarValidator
 *
 * @author thanhtam
 */
class CustomValidators {

    public function isValidAlphanumeric($attribute, $value, $parameters, $validator) {
        return preg_match('/^[a-zA-Z0-9]+$/i', $value);
    }

    public function isValidPhoneNumber($attribute, $value, $parameters, $validator){
        return preg_match('/^0[0-9]{1,3}-?[0-9]{1,4}-?[0-9]{1,4}$/i', $value);
    }
}
