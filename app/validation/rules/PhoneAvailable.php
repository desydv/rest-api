<?php

namespace app\validation\rules;
use Respect\Validation\Rules\AbstractRule;
use app\models\Customer;

class PhoneAvailable extends AbstractRule{
    public function validate($input){
        return Customer::where('phone', $input)->count() === 0;
    }
}