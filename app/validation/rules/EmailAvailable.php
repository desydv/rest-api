<?php

namespace app\validation\rules;
use Respect\Validation\Rules\AbstractRule;
use app\models\Customer;

class EmailAvailable extends AbstractRule{
    public function validate($input){
        return Customer::where('email', $input)->count() === 0;
    }
}